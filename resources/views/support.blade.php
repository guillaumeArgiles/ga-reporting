@extends('layout.master')
@section('title')
	{{ trans('app.support') }}
@endsection

@section('content')
	<div id="hero" class="static-header light clearfix">
        <div class="text-heading">
            <h1 class="animated hiding" data-animation="bounceInDown" data-delay="0"> {{ trans('app.support_title') }} </h1>
            <p class="animated hiding" data-animation="fadeInDown" data-delay="500"> {{ trans('app.support_description') }}</p>
            <ul class="list-inline">
                <li><a href="mailto:support-ga-reporting@ga-creation.fr" class="btn btn-primary animated hiding" data-animation="bounceIn" data-delay="700" target="_blank">support-ga-reporting@ga-creation.fr</a></li>
            </ul>
        </div>
    </div>
@endsection