@extends('layouts.backend')
@section('content')
    @if (session('msg'))
        {{ session('msg') }}
    @endif
    <h1>{{ $pageTitle }}</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
                <th colspan="2">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @if ($users->count())
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status == 1 ? 'Kích hoạt' : 'Chưa kích hoạt' }}</td>
                        <td>{{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</td>
                        <td>
                            <a href="{{ route('admin.users.trashed.restore', $user) }}">Khôi phục</a>
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn?')"
                                href="{{ route('admin.users.trashed.delete', $user) }}">Xóa vĩnh viễn</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
@include('admin.users.delete')
