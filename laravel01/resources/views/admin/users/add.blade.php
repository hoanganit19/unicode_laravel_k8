@extends('layouts.backend')
@section('content')
    <h1>{{ $pageTitle }}</h1>
    <form action="{{ route('admin.users.store') }}" method="post">
        @include('admin.users.form_add')
        @csrf
    </form>
@endsection
