@extends('layout.master')

@section('content')
    
        <h1> Accueil </h1>
        <a href="https://slack.com/oauth/authorize?scope=incoming-webhook,commands&client_id=###CLIENTID###&state={{ $state }}"><img alt="Add to Slack" height="40" width="139" src="https://platform.slack-edge.com/img/add_to_slack.png" srcset="https://platform.slack-edge.com/img/add_to_slack.png 1x, https://platform.slack-edge.com/img/add_to_slack@2x.png 2x" /></a>
@endsection
