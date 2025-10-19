@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Chỉnh sửa giáo viên') }}</span>
                    <a href="{{ route('teachers.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ __('Quay lại') }}
                    </a>
                </div>

                <div class="card-body">
                    @include('partials.alerts')
                    @include('partials.instructions', ['guideline' => 'Chỉnh sửa thông tin và nhấn Cập nhật để lưu thay đổi.'])

                    <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="teacher_id" class="form-label">{{ __('Mã giáo viên') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('teacher_id') is-invalid @enderror" id="teacher_id" name="teacher_id" value="{{ old('teacher_id', $teacher->teacher_id) }}" required>
                                @error('teacher_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Mã giáo viên phải là duy nhất...</div>
                            </div>
                            <div class="col-md-4">
                                <label for="faculty_id" class="form-label">{{ __('Khoa') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('faculty_id') is-invalid @enderror" id="faculty_id" name="faculty_id" required>
                                    <option value="">{{ __('-- Chọn khoa --') }}</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->id }}" {{ (old('faculty_id', $teacher->faculty_id) == $faculty->id) ? 'selected' : '' }}>
                                            {{ $faculty->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('faculty_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="degree_id" class="form-label">{{ __('Học vị') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('degree_id') is-invalid @enderror" id="degree_id" name="degree_id" required>
                                    <option value="">{{ __('-- Chọn học vị --') }}</option>
                                    @foreach($degrees as $degree)
                                        <option value="{{ $degree->id }}" {{ (old('degree_id', $teacher->degree_id) == $degree->id) ? 'selected' : '' }}>
                                            {{ $degree->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('degree_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">{{ __('Họ') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $teacher->first_name) }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">{{ __('Tên') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $teacher->last_name) }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gender" class="form-label">{{ __('Giới tính') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                    <option value="">{{ __('-- Chọn giới tính --') }}</option>
                                    <option value="Nam" {{ old('gender', $teacher->gender) == 'Nam' ? 'selected' : '' }}>{{ __('Nam') }}</option>
                                    <option value="Nữ" {{ old('gender', $teacher->gender) == 'Nữ' ? 'selected' : '' }}>{{ __('Nữ') }}</option>
                                    <option value="Khác" {{ old('gender', $teacher->gender) == 'Khác' ? 'selected' : '' }}>{{ __('Khác') }}</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label">{{ __('Ngày sinh') }} <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $teacher->date_of_birth->format('Y-m-d')) }}" required>
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $teacher->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">{{ __('Số điện thoại') }}</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">{{ __('Địa chỉ') }}</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $teacher->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ __('Cập nhật') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 