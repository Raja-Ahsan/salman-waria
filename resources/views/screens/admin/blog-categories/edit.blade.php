@extends('layouts.admin.master')

@section('page_title', 'Edit Category')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('blog-categories.index') }}">Blog Categories</a></li>
@endsection

@section('content')
    @include('screens.admin.blog-categories.partials.form', ['blogCategory' => $blogCategory])
@endsection
