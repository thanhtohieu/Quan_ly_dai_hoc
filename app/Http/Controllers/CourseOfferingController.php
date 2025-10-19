<?php

namespace App\Http\Controllers;

use App\Models\CourseOffering;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseOfferingController extends Controller
{
    public function index()
    {
        $courseOfferings = CourseOffering::with(['subject', 'semester.academicYear'])->paginate(10);
        return view('course_offerings.index', compact('courseOfferings'));
    }

    public function create(Request $request)
    {
        $subjectsQuery = Subject::query();
        if ($request->filled('faculty_id')) {
            $subjectsQuery->where('faculty_id', $request->faculty_id);
        }
        $subjects = $subjectsQuery->get();

        $semestersQuery = Semester::with('academicYear');
        if ($request->filled('academic_year_id')) {
            $semestersQuery->where('academic_year_id', $request->academic_year_id);
        }
        $semesters = $semestersQuery->get();

        $faculties = Faculty::all();
        $academicYears = \App\Models\AcademicYear::all();

        return view('course_offerings.create', compact('subjects', 'semesters', 'faculties', 'academicYears'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
            'semester_id' => 'required|exists:semesters,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->subject_ids as $subjectId) {
            CourseOffering::firstOrCreate([
                'subject_id' => $subjectId,
                'semester_id' => $request->semester_id,
            ]);
        }

        return redirect()->route('course-offerings.index')->with('success', 'Đã lưu thông tin.');
    }

    public function edit(CourseOffering $courseOffering, Request $request)
    {
        $subjectsQuery = Subject::query();
        if ($request->has('faculty_id') && $request->faculty_id) {
            $subjectsQuery->where('faculty_id', $request->faculty_id);
        }
        $subjects = $subjectsQuery->get();
        $semesters = Semester::with('academicYear')->get();
        $faculties = Faculty::all();
        return view('course_offerings.edit', compact('courseOffering', 'subjects', 'semesters', 'faculties'));
    }

    public function update(Request $request, CourseOffering $courseOffering)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|exists:subjects,id',
            'semester_id' => 'required|exists:semesters,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $courseOffering->update($request->only('subject_id', 'semester_id'));
        return redirect()->route('course-offerings.index')->with('success', 'Đã cập nhật thông tin.');
    }

    public function destroy(CourseOffering $courseOffering)
    {
        $courseOffering->delete();
        return redirect()->route('course-offerings.index')->with('success', 'Đã xóa thành công.');
    }
}
