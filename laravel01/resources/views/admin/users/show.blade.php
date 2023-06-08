@extends('layouts.backend')
@section('content')
    @if (session('msg'))
        {{ session('msg') }}
    @endif
    <h1>{{ $pageTitle }}</h1>
    <p>Tên: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Trạng thái: {{ $user->status == 1 ? 'Kích hoạt' : 'Chưa kích hoạt' }}</p>
@endsection
