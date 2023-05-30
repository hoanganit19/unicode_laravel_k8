@extends('layouts.backend')
@section('content')
    @if (session('msg'))
        {{ session('msg') }}
    @endif
    <h1>{{ $pageTitle }}</h1>

    <x-message content="Xin chào Unicode" />

    @forelse ($users as $user)
        <p>{{ $user }}</p>
    @empty
        <p>Không có data</p>
    @endforelse

    @verbatim
        <script>
            const a = `Xin chào {{ name }}`;
            const b = `Tôi tên là {{ email }}`
        </script>
    @endverbatim
@endsection
