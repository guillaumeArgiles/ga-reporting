@extends('layout.master')
@section('title')
    {{ trans('app.forget_password') }}
@endsection

@section('content')
    <div id="hero" class="static-header light">
        <div class="text-heading">
            <h1> {{ trans('app.forget_password') }}</h1>
            <p> {{ trans('app.forget_password_description') }}</p>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                   
                    @if (session('status'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>{{ session('status') }}</strong>
                            <i class="icon icon-badges-votes-10"></i>
                        </div>
                    @endif 
                    <form method="POST" action="#" class="form form-register dark">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="email" class="col-sm-3 col-xs-12 control-label">Email</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                            </div>
                        </div>

                        <button type="submit"  class="btn btn-primary btn-lg btn-block">
                            {{ trans('app.forget_password_resend_button') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection