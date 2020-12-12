@extends('layout.master')
@section('title')
    {{ trans('app.reportings_myreportings') }}
@endsection

@section('content')

    <div id="body">
        <section id="sc-heading" class="section text-center">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                        <h1> {{ trans('app.reportings_myreportings') }} </h1>
                        @if (count($reportings))
                        	<ul class="list-box">
                        	@foreach($reportings as $reporting)
                                <li> 
                                    <b>{{ $reporting->name}}  </b>
                                    <ul class="button-list-centered">
                                        <li>
                                            <a href="{{ URL::route('reporting-test', ['id_reporting' => $reporting->id]) }}"> <button class="btn btn-info">{{ trans('app.button_test') }} </button></a>
                                        </li>
                                        <li>
                                            <a href="{{ URL::route('reporting-edit', ['id_reporting' => $reporting->id]) }}"> <button class="btn btn-warning">{{ trans('app.button_edit') }} </button></a> 
                                        </li>
                                        <li>
                                            <a href="{{ URL::route('reporting-delete', ['id_reporting' => $reporting->id]) }}"> <button class="btn btn-danger">{{ trans('app.button_delete') }} </button> </a>
                                        </li>
                                    </ul>
                                </li>

                        	@endforeach
                        	</ul>
                        @else
                        	<p> {{ trans('app.reportings_noreporting') }} </p>
                        @endif
                        <a href="{{ URL::route('reporting-add') }}"> 
                            <button class="btn btn-primary btn-addtoslack"> <i class="fa fa-list-alt"></i> <div> {{ trans('app.reportings_createreporting') }} </div></button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
