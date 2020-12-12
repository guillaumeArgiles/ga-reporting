@extends('layout.master')
@section('title')
    {{ trans('app.change_password') }}
@endsection

@section('content')
    <div id="hero" class="static-header light">
        <div class="text-heading">
            <h1>{{ trans('app.forget_password') }}</h1>
            <p>{{ trans('app.change_password') }}</p>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                   
                    <form method="POST" action="{{ url('password/reset') }}" class="form form-register dark">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">


                        <div class="form-group">
                            <label for="email" class="col-sm-3 col-xs-12 control-label">Email</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                            </div>
                        </div>


                        
                        <div class="form-group">
                            <label for="password" class="col-sm-3 col-xs-12 control-label">{{ trans('app.password')}}</label>
                            <div class="col-sm-9 col-xs-12">
                                <input id="password" class="form-control" type="password" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm" class="col-sm-3 col-xs-12 control-label">Confirmation</label>
                            <div class="col-sm-9 col-xs-12">
                                <input id="password_confirm" class="form-control" type="password" name="password_confirmation">
                            </div>
                        </div>

                        <button type="submit"  class="btn btn-primary btn-lg btn-block">
                            {{ trans('app.change_password_resend_button') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
