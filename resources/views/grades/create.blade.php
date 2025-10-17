@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Thêm điểm mới') }}</span>
                    <a href="{{ route('grades.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ __('Quay lại') }}
                    </a>
                </div>

                <div class="card-body">
                    @include('partials.alerts')
                    @include('partials.instructions', ['guideline' => 'Nhập đầy đủ thông tin và nhấn Lưu để tạo mới.'])

                    <form method="POST" action="{{ route('grades.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="student_id" class="form-label">{{ __('Sinh viên') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                                    <option value="">{{ __('-- Chọn sinh viên --') }}</option>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->student_id }} - {{ $student->first_name }} {{ $student->last_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="subject_id" class="form-label">{{ __('Môn học') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
                                    <option value="">{{ __('-- Chọn môn học --') }}</option>
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->code }} - {{ $subject->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="midterm_score" class="form-label">{{ __('Điểm giữa kỳ') }} <span class="text-danger">*</span></label>
                                <input type="number" step="0.1" min="0" max="10" class="form-control @error('midterm_score') is-invalid @enderror" id="midterm_score" name="midterm_score" value="{{ old('midterm_score') }}" required>
                                @error('midterm_score')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="final_score" class="form-label">{{ __('Điểm cuối kỳ') }} <span class="text-danger">*</span></label>
                                <input type="number" step="0.1" min="0" max="10" class="form-control @error('final_score') is-invalid @enderror" id="final_score" name="final_score" value="{{ old('final_score') }}" required>
                                @error('final_score')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="semester_id" class="form-label">{{ __('Học kỳ') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('semester_id') is-invalid @enderror" id="semester_id" name="semester_id" required>
                                    <option value="">{{ __('-- Chọn học kỳ --') }}</option>
                                    @foreach($semesters as $semester)
                                    <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                                        {{ $semester->name }} ({{ $semester->academicYear->name }})
                                    </option>
                                    @endforeach
                                </select>
                                @error('semester_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">{{ __('Ghi chú') }}</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3">{{ old('note') }}</textarea>
                            @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ __('Lưu') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection