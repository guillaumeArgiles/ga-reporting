@extends('layout.master')
@section('title')
    Ajouter un rapport
@endsection

@section('content')

    <div id="body">
        <section id="sc-heading" class="section text-center">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                        <h1> Ajouter un rapport</h1>

                		<form method="POST" action="{{ URL::route('summaries-post-add') }}" class="form form-register dark">
                            {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="name" class="col-sm-3 col-xs-12 control-label">Nom</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" id="name" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="color" class="col-sm-3 col-xs-12 control-label">Couleur</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="color" id="color" class="form-control" name="color" value="#346fb7">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="channel_id" class="col-sm-3 col-xs-12 control-label">Channel</label>
                            <div class="col-sm-9 col-xs-12">
                                @if (count($channels))
                                    <select id="channel_id" name="channel_id" class="form-control">
                                        <option value="0"> Sélectionner un channel</option>
                                        @foreach($channels as $channel)
                                            <option value="{{ $channel->id }}"> {{ $channel->channel_name }} </option>
                                        @endforeach
                                    </select>
                                @else
                                    <a href="https://slack.com/oauth/authorize?scope=incoming-webhook,commands&client_id=###CLIENTID###&state={{ $state }}">
                                        <button class="btn btn-primary btn-addtoslack" type="button"> <i class="fa fa-slack"></i> <div>Ajouter un channel slack </div></button>
                                     </a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="channel_id" class="col-sm-3 col-xs-12 control-label">Compte google</label>
                            <div class="col-sm-9 col-xs-12">
                                @if (count($googleaccounts))
                                    <select id="google_account_id" name="google_account_id" class="form-control">
                                        <option value="0"> Sélectionner un compte</option>
                                         @foreach($googleaccounts as $email => $googleaccount )
                                            <optgroup label="{{ $email }}" >
                                                @foreach($googleaccount as $webpropertie => $properties )
                                                    <optgroup label="&nbsp;&nbsp;&nbsp;{{ $webpropertie }}" >
                                                        @foreach($properties as $id => $name)
                                                            <option value="{{ $id }}"> &nbsp;&nbsp;&nbsp;{{ $name }} </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                @else
                                    <a href="{{ URL::route('ga-login') }}">
                                        <button class="btn btn-primary btn-addtoslack" type="button"> <i class="fa fa-google"></i> <div>Ajouter un compte google </div></button>
                                    </a> 
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="notification_id" class="col-sm-3 col-xs-12 control-label">Notifications</label>
                            <div class="col-sm-9 col-xs-12">
                                <select class="form-control" id="notification_id" name="notification_id">
                                    <option value="0"> Sélectionner la fréquence des notifications</option>
                                    @foreach($notifications as $notification)
                                        <option value="{{ $notification->id }}"> {{ $notification->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 col-xs-12 control-label">Métriques</label>
                            <div class="col-sm-9 col-xs-12">
                                <ul class="row metric-list">
                                    @foreach($metrics as $metric)
                                        <li class="col-sm-6 col-xs-12"> <input id="metric-{{$metric->id}}" type="checkbox" name="metrics[{{ $metric->id }}]" value="{{ $metric->id }}"> <label for="metric-{{$metric->id}}">{{ $metric->name }}</label> </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                            <button type="submit" class="btn btn-primary btn-addtoslack"><i class="fa fa-list-alt"></i> Ajouter le rapport </button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
