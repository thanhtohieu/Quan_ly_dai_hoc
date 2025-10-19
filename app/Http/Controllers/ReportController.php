<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use App\Models\Faculty;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Dashboard showing multiple report charts.
     */
    public function index()
    {
        $semesters = Semester::with('academicYear')->get();

        // Sections by semester data
        $sectionsData = [];
        foreach ($semesters as $semester) {
            $count = ClassSection::whereHas('courseOffering', function ($q) use ($semester) {
                    $q->where('semester_id', $semester->id);
                })
                ->count();
            $sectionsData[] = [
                'name' => $semester->name . ' ' . $semester->academicYear->name,
                'count' => $count,
            ];
        }

        // Teacher workload data
        $teachers = Teacher::all();
        $workloadData = [];
        foreach ($teachers as $teacher) {
            $rows = [];
            foreach ($semesters as $semester) {
                $periods = ClassSection::where('teacher_id', $teacher->id)
                    ->whereHas('subject.courseOfferings', function ($q) use ($semester) {
                        $q->where('semester_id', $semester->id);
                    })
                    ->sum('period_count');
                $payment = ClassSection::where('teacher_id', $teacher->id)
                    ->whereHas('subject.courseOfferings', function ($q) use ($semester) {
                        $q->where('semester_id', $semester->id);
                    })
                    ->join('subjects', 'class_sections.subject_id', '=', 'subjects.id')
                    ->sum(DB::raw('class_sections.period_count * subjects.coefficient'));
                $rows[] = [
                    'semester' => $semester->name . ' ' . $semester->academicYear->name,
                    'periods' => $periods,
                    'payment' => $payment,
                ];
            }
            $workloadData[] = [
                'teacher' => $teacher->full_name,
                'rows' => $rows,
            ];
        }

        // Subject open rate data
        $faculties = Faculty::all();
        $totalSubjects = Subject::count();
        $openRateData = [];
        foreach ($faculties as $faculty) {
            foreach ($semesters as $semester) {
                $opened = Subject::whereHas('courseOfferings', function ($q) use ($semester) {
                        $q->where('semester_id', $semester->id);
                    })
                    ->whereHas('classSections.teacher', function ($q) use ($faculty) {
                        $q->where('faculty_id', $faculty->id);
                    })
                    ->distinct('subjects.id')
                    ->count('subjects.id');
                $percent = $totalSubjects > 0 ? ($opened / $totalSubjects) * 100 : 0;
                $openRateData[] = [
                    'faculty' => $faculty->name,
                    'semester' => $semester->name . ' ' . $semester->academicYear->name,
                    'percent' => round($percent, 2),
                ];
            }
        }

        return view('reports.index', [
            'sectionsData' => $sectionsData,
            'workloadData' => $workloadData,
            'openRateData' => $openRateData,
            'semesters' => $semesters,
        ]);
    }

    /**
     * Number of class sections by semester.
     */
    public function sectionsBySemester()
    {
        $semesters = Semester::with('academicYear')->get();
        $data = [];
        foreach ($semesters as $semester) {
            $count = ClassSection::whereHas('courseOffering', function ($q) use ($semester) {
                    $q->where('semester_id', $semester->id);
                })
                ->count();
            $data[] = [
                'name' => $semester->name . ' ' . $semester->academicYear->name,
                'count' => $count,
            ];
        }
        return view('reports.sections_by_semester', ['data' => $data]);
    }

    /**
     * Teaching periods and payment by teacher per semester.
     */
    public function teacherWorkload()
    {
        $semesters = Semester::with('academicYear')->get();
        $teachers = Teacher::all();
        $result = [];
        foreach ($teachers as $teacher) {
            $rows = [];
            foreach ($semesters as $semester) {
                $periods = ClassSection::where('teacher_id', $teacher->id)
                    ->whereHas('subject.courseOfferings', function ($q) use ($semester) {
                        $q->where('semester_id', $semester->id);
                    })
                    ->sum('period_count');
                $payment = ClassSection::where('teacher_id', $teacher->id)
                    ->whereHas('subject.courseOfferings', function ($q) use ($semester) {
                        $q->where('semester_id', $semester->id);
                    })
                    ->join('subjects', 'class_sections.subject_id', '=', 'subjects.id')
                    ->sum(DB::raw('class_sections.period_count * subjects.coefficient'));
                $rows[] = [
                    'semester' => $semester->name . ' ' . $semester->academicYear->name,
                    'periods' => $periods,
                    'payment' => $payment,
                ];
            }
            $result[] = [
                'teacher' => $teacher->full_name,
                'rows' => $rows,
            ];
        }
        return view('reports.teacher_workload', ['data' => $result, 'semesters' => $semesters]);
    }

    /**
     * Percentage of subjects opened per faculty and semester.
     */
    public function subjectOpenRate()
    {
        $semesters = Semester::with('academicYear')->get();
        $faculties = Faculty::all();
        $totalSubjects = Subject::count();
        $data = [];
        foreach ($faculties as $faculty) {
            foreach ($semesters as $semester) {
                $opened = Subject::whereHas('courseOfferings', function ($q) use ($semester) {
                        $q->where('semester_id', $semester->id);
                    })
                    ->whereHas('classSections.teacher', function ($q) use ($faculty) {
                        $q->where('faculty_id', $faculty->id);
                    })
                    ->distinct('subjects.id')
                    ->count('subjects.id');
                $percent = $totalSubjects > 0 ? ($opened / $totalSubjects) * 100 : 0;
                $data[] = [
                    'faculty' => $faculty->name,
                    'semester' => $semester->name . ' ' . $semester->academicYear->name,
                    'percent' => round($percent, 2),
                ];
            }
        }
        return view('reports.subject_open_rate', ['data' => $data]);
    }
}
