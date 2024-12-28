@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Danh sách khách hàng</h1>
        <a href="{{ route('customers.create') }}" class="btn btn-success">+ Thêm khách hàng</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th class="text-center">Mã khách hàng</th>
                    <th>Email</th>
                    <th class="text-center">Loại tài khoản</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Đăng nhập lần cuối</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                <tr>
                    <td class="text-center">{{ $customer->id }}</td>
                    <td>{{ $customer->email }}</td>
                    <td class="text-center">{{ $customer->account_type }}</td>
                    <td class="text-center">
                        <span class="badge {{ $customer->status == 'active' ? 'bg-success' : ($customer->status == 'inactive' ? 'bg-secondary' : 'bg-danger') }}">
                            {{ $customer->status == 'active' ? 'Hoạt động' : ($customer->status == 'inactive' ? 'Không hoạt động' : 'Bị cấm') }}
                        </span>
                    </td>
                    <td class="text-center">{{ $customer->last_login }}</td>
                    <td class="text-center">
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Không có khách hàng nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $customers->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection