@extends('layout.master')
@section('title')
    {{ trans('app.register') }}
@endsection

@section('content')
    <div id="hero" class="static-header light">
        <div class="text-heading">
            <h1>{{ trans('app.register') }}</h1>
            <p>{{ trans('app.register_description') }}</p>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">

                    <form method="POST" action="#"  class="form form-register dark">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="nom" class="col-sm-3 col-xs-12 control-label">{{ trans('app.name') }}</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" id="nom" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-3 col-xs-12 control-label">Email</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label for="password" class="col-sm-3 col-xs-12 control-label">{{ trans('app.password') }}</label>
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

                        
                        <button type="submit" class="btn btn-primary btn-lg btn-block">{{ trans('app.register') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
