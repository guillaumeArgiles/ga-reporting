@extends('layout.master')
@section('title')
    {{ trans('app.channels_mychannels')}}
@endsection

@section('content')

    <div id="body">
        <section id="sc-heading" class="section text-center">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                        <h1> {{ trans('app.channels_mychannels')}} </h1>
                             
                        @if (count($channels))
                            <ul class="list-box">
                            @foreach($channels as $channel)
                                <li> 
                                    <b>{{ $channel->channel_name}} </b>
                                    <ul class="button-list-centered">
                                        <li>
                                            <a href="{{ URL::route('channel-test', ['id_channel' => $channel->id]) }}"> <button class="btn btn-info">{{trans('app.button_test')}}</button></a> 
                                        </li>
                                        <li>
                                            <a href="{{ URL::route('channel-delete', ['id_channel' => $channel->id]) }}"> <button class="btn btn-danger">{{trans('app.button_delete')}}</button></a>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                            </ul>
                        @else
                            <p>{{ trans('app.channels_nochannel')}} </p>
                        @endif
                        <a href="https://slack.com/oauth/authorize?scope=incoming-webhook,commands&client_id=###CLIENTID###&state={{ $state }}">
                            <button class="btn btn-primary btn-addtoslack"> <i class="fa fa-slack"></i> <div>{{ trans('app.channels_addchannel')}}</div></button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
