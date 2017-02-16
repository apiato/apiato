@extends('admin::layouts.box-middle')

@section('content')
    <h3 class="text-center">{{ trans('authentication::views.login-title') }}</h3>

    <form class="login-form" action="{{route('admin_login')}}" method="post">
        {{ csrf_field() }}

        @if(session('status'))
            <div class="text-red">{{ session('status') }}</div>
        @endif
        
        <div class="form-group has-feedback">
            <input type="text"  placeholder="{{ trans('authentication::views.form-fields.email') }}" id="email" name="email" class="form-control" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        
        <div class="form-group has-feedback">
        <input type="password" placeholder="{{ trans('authentication::views.form-fields.password') }}" id="password" name="password"  class="form-control"/>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ trans('authentication::views.form-fields.login-btn') }}</button>
        </div>
    </form>
@endsection
