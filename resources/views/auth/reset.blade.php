@extends('layout.master')
@section('title')
    Création du mot de passe
@endsection

@section('content')
    <div id="hero" class="static-header light">
        <div class="text-heading">
            <h1>Redéfinissez votre mot de passe</h1>
            <p>Vous avez effectué une demande de mot de passe, changez le maintenant</p>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                    <form method="POST" action="#"  class="form form-register dark">
                        {!! csrf_field() !!}
                        <input type="hidden" name="token" value="{{ $token }}">

                        @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>Une erreur est survenue</strong> {{ $error }}
                                        <i class="icon icon-badges-votes-11"></i>
                                    </div>
                                @endforeach
                        @endif

                        <div class="form-group">
                            <label for="email" class="col-sm-3 col-xs-12 control-label">Email</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-3 col-xs-12 control-label">Mot de passe</label>
                            <div class="col-sm-9 col-xs-12">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm" class="col-sm-3 col-xs-12 control-label">Confirmation</label>
                            <div class="col-sm-9 col-xs-12">
                                <input id="password_confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Sauvegarder le mot de passe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection