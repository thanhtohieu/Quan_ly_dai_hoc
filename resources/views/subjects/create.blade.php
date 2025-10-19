@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Thêm môn học mới') }}</span>
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ __('Quay lại') }}
                    </a>
                </div>

                <div class="card-body">
                    @include('partials.alerts')
                    @include('partials.instructions', ['guideline' => 'Nhập đầy đủ thông tin và nhấn Lưu để tạo mới.'])

                    <form method="POST" action="{{ route('subjects.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="faculty_id" class="form-label">{{ __('Khoa') }} <span class="text-danger">*</span></label>
                            <select class="form-select @error('faculty_id') is-invalid @enderror" id="faculty_id" name="faculty_id" required>
                                <option value="">{{ __('-- Chọn khoa --') }}</option>
                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                @endforeach
                            </select>
                            @error('faculty_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Tên môn học') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="code" class="form-label">{{ __('Mã môn học') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">{{ __('Mã môn học phải là duy nhất và không có khoảng trắng.') }}</div>
                        </div>

                        <div class="mb-3">
                            <label for="credits" class="form-label">{{ __('Số tín chỉ') }} <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('credits') is-invalid @enderror" id="credits" name="credits" value="{{ old('credits', 3) }}" min="1" max="10" required>
                            @error('credits')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="coefficient" class="form-label">{{ __('Hệ số học phần') }}</label>
                            <input type="number" step="0.1" class="form-control @error('coefficient') is-invalid @enderror" id="coefficient" name="coefficient" value="{{ old('coefficient') }}">
                            @error('coefficient')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('Mô tả') }}</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
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