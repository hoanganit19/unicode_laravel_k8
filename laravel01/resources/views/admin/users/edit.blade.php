@extends('layouts.backend')
@section('content')
    @if (session('msg'))
        {{ session('msg') }}
    @endif
    <h1>{{ $pageTitle }}</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="post">
        @include('admin.users.form')
        @csrf
        @method('PUT')
    </form>
@endsection
