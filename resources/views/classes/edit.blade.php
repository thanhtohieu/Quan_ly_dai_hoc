@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Chỉnh sửa lớp học') }}</span>
                    <a href="{{ route('classes.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ __('Quay lại') }}
                    </a>
                </div>

                <div class="card-body">
                    @include('partials.alerts')
                    @include('partials.instructions', ['guideline' => 'Chỉnh sửa thông tin và nhấn Cập nhật để lưu thay đổi.'])

                    <form method="POST" action="{{ route('classes.update', $class->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="major_id" class="form-label">{{ __('Ngành học') }} <span class="text-danger">*</span></label>
                            <select class="form-select @error('major_id') is-invalid @enderror" id="major_id" name="major_id" required>
                                <option value="">{{ __('-- Chọn ngành học --') }}</option>
                                @foreach($majors as $major)
                                <option value="{{ $major->id }}" {{ (old('major_id', $class->major_id) == $major->id) ? 'selected' : '' }}>
                                    {{ $major->name }} ({{ $major->faculty->name }})
                                </option>
                                @endforeach
                            </select>
                            @error('major_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Tên lớp học') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $class->name) }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="code" class="form-label">{{ __('Mã lớp học') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $class->code) }}" required>
                            @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">{{ __('Mã lớp học phải là duy nhất và không có khoảng trắng.') }}</div>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">{{ __('Năm học') }} <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year', $class->year) }}" min="2000" max="{{ date('Y') + 10 }}" required>
                            @error('year')
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