@extends('layout.master')
@section('title')
    {{ trans('app.reportings_editreporting') }} 
@endsection

@section('content')

    <div id="body">
        <section id="sc-heading" class="section text-center">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                        <h1> {{ trans('app.reportings_editreporting') }} </h1>

                        <form method="POST" action="{{ URL::route('reporting-post-edit', array('reporting_id' => $reporting->id)) }}" class="form form-register dark">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label for="name" class="col-sm-3 col-xs-12 control-label">{{ trans('app.name') }}</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $reporting->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="color" class="col-sm-3 col-xs-12 control-label">{{ trans('app.color') }}</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="color" id="color" class="form-control" name="color" value="{{ $reporting->color }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="channel_id" class="col-sm-3 col-xs-12 control-label">{{ trans('app.channel') }}</label>
                                <div class="col-sm-9 col-xs-12">
                                    @if (count($channels))
                                        <select id="channel_id" name="channel_id" class="form-control">
                                            <option value="0"> {{ trans('app.reportings_selectchannel') }}</option>
                                            @foreach($channels as $channel)
                                                @if($reporting->channel_id == $channel->id )
                                                    <option value="{{ $channel->id }}" selected> {{ $channel->channel_name }} </option>
                                                @else
                                                    <option value="{{ $channel->id }}"> {{ $channel->channel_name }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <a href="https://slack.com/oauth/authorize?scope=incoming-webhook,commands&client_id=###CLIENTID###&state={{ $state }}">
                                            <button class="btn btn-primary btn-addtoslack" type="button"> <i class="fa fa-slack"></i> <div>{{ trans('app.channels_addchannel')}} </div></button>
                                         </a>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="channel_id" class="col-sm-3 col-xs-12 control-label">{{ trans('app.google_accounts')}}</label>
                                <div class="col-sm-9 col-xs-12">
                                    @if (count($googleaccounts))
                                        <select id="google_account_id" name="google_account_id" class="form-control">
                                            <option value="0"> {{ trans('app.reportings_selectgoogleaccount') }}</option>
                                             @foreach($googleaccounts as $email => $googleaccount )
                                                <optgroup label="{{ $email }}" >
                                                    @foreach($googleaccount as $webpropertie => $properties )
                                                        <optgroup label="&nbsp;&nbsp;&nbsp;{{ $webpropertie }}" >
                                                            @foreach($properties as $id => $name)
                                                                @if($reporting->google_account_id == $id)
                                                                    <option value="{{ $id }}" selected> &nbsp;&nbsp;&nbsp;&nbsp;{{ $name }} </option>
                                                                @else
                                                                    <option value="{{ $id }}"> &nbsp;&nbsp;&nbsp;&nbsp;{{ $name }} </option>
                                                                @endif
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    @else
                                        <a href="{{ URL::route('ga-login') }}">
                                            <button class="btn btn-primary btn-addtoslack" type="button"> <i class="fa fa-google"></i> <div>{{ trans('app.google_addaccount')}} </div></button>
                                        </a> 
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="notification_id" class="col-sm-3 col-xs-12 control-label">{{ trans('app.notifications') }}</label>
                                <div class="col-sm-9 col-xs-12">
                                    <select class="form-control" id="notification_id" name="notification_id">
                                        <option value="0"> {{ trans('app.reportings_selectnotifications') }}</option>
                                        @foreach($notifications as $notification)
                                            @if($reporting->notification_id == $notification->id)
                                                <option value="{{ $notification->id }}" selected> {{ trans('app.notification_'.$notification->id) }}</option>
                                            @else
                                                <option value="{{ $notification->id }}"> {{ trans('app.notification_'.$notification->id) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="timezone" class="col-sm-3 col-xs-12 control-label"> {{ trans('app.timezone') }} </label>
                                <div class="col-sm-9 col-xs-12">
                                    <select class="form-control" id="timezone" name="timezone">
                                        <option value="0"> {{ trans('app.reportings_selecttimezone') }} </option>
                                        @foreach($timezones as $timezone)
                                            @if($timezone == $reporting->timezone)
                                                <option value="{{ $timezone }}" selected> {{ $timezone }} </option>
                                            @else
                                                <option value="{{ $timezone }}"> {{ $timezone }} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">{{ trans('app.metrics') }}</label>
                                <div class="col-sm-9 col-xs-12">
                                    
                                     <select class="select-multiple form-control" multiple="multiple" name="metrics[]">
                                            @foreach($metrics as $metric)
                                                @if(in_array($metric->id, $reporting->metrics))
                                                    <option value="{{ $metric->id }}" selected> {{ $metric->metric }} </option>
                                                @else    
                                                    <option value="{{ $metric->id }}"> {{ $metric->metric }} </option>
                                                @endif 
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                        <button type="submit" class="btn btn-primary btn-addtoslack"><i class="fa fa-list-alt"></i> {{ trans('app.button_editreporting') }} </button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

