@extends('admin::layouts.right-sidebar')

@section('content')
<div class="content animated fadeIn">
    <div class="jumbotron">
        <div class="container">
        	<h1 class="text-center">{{ trans('authentication::views.welcome-user', ['user' => auth()->user()->name]) }}</h1>
        </div>
    </div>
</div>
@endsection
