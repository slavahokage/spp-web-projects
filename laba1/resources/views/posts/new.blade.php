@section('title', 'New Post')
@extends('layout')

@section('content')

<h1 class="title">Create a new post</h1>

<form enctype="multipart/form-data" method="post" action="{{ route('create') }}">

    @csrf
    @include('partials.errors')

    @include('partials.form_content')
</form>

@endsection
