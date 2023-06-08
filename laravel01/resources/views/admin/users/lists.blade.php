@extends('layouts.backend')
@section('content')
    @if (session('msg'))
        {{ session('msg') }}
    @endif
    <h1>{{ $pageTitle }}</h1>
    <table border="1" width="100%">
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
                            <a href="{{ route('admin.users.edit', $user->id) }}">Sửa</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.destroy', $user->id) }}"
                                onclick="
                                event.preventDefault();
                                if (confirm('Bạn có chắc chắn?')){
                                    
                                document.querySelector('.delete-form').action = event.target.href;
                                document.querySelector('.delete-form').submit();
                                }
                                ">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
@include('admin.users.delete')
