@extends('layouts.admin.master')

@section('page_title', 'Create Post')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blogs</a></li>
@endsection

@section('content')
    @include('screens.admin.blogs.partials.form', ['categories' => $categories])
@endsection

@include('screens.admin.blogs.partials.form-assets')
