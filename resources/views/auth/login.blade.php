@extends('layout.master')
@section('title')
    {{ trans('app.login') }}
@endsection

@section('content')
    <div id="hero" class="static-header light">
        <div class="text-heading">
            <h1>{{ trans('app.login') }}</h1>
            <p>{{ trans('app.login_description') }}</p>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                    <form method="POST" action="#" class="form form-register dark">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="email" class="col-sm-3 col-xs-12 control-label">Email</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-3 col-xs-12 control-label">{{ trans('app.password')}}</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="password" id="password" class="form-control" name="password" id="password">
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="hidden">
                                <input type="checkbox" name="remember" checked> {{ trans('app.login_keep_login') }}
                            </div>
                        <i class="pull-right"> <a href="{{ URL::route('password-forget') }}" > {{ trans('app.forget_password') }} ? </a></i>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">{{ trans('app.login') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
