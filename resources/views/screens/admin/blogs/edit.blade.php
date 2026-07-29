@extends('layouts.admin.master')

@section('page_title', 'Edit Post')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blogs</a></li>
@endsection

@section('content')
    @include('screens.admin.blogs.partials.form', ['blog' => $blog, 'categories' => $categories])
@endsection

@include('screens.admin.blogs.partials.form-assets')
