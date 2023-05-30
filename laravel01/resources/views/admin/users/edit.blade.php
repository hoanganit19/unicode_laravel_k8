@extends('layouts.backend')
@section('content')
    <h1>{{ $pageTitle }}</h1>
    <form action="{{ route('admin.users.update', $id) }}" method="post">
        @include('admin.users.form')
        @csrf
        @method('PUT')
    </form>
@endsection
