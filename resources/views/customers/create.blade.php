@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Thêm khách hàng mới</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="account_type" class="form-label">Loại tài khoản</label>
                            <select name="account_type" id="account_type" class="form-select @error('account_type') is-invalid @enderror" required>
                                <option value="">-- Chọn loại tài khoản --</option>
                                <option value="basic" {{ old('account_type') == 'basic' ? 'selected' : '' }}>Cơ bản</option>
                                <option value="premium" {{ old('account_type') == 'premium' ? 'selected' : '' }}>Cao cấp</option>
                                <option value="enterprise" {{ old('account_type') == 'enterprise' ? 'selected' : '' }}>Công việc</option>
                            </select>
                            @error('account_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                                <option value="banned" {{ old('status') == 'banned' ? 'selected' : '' }}>Bị cấm</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Quay lại</a>
                            <button type="submit" class="btn btn-success">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
