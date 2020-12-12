@extends('layout.master')
@section('title')
    {{ trans('app.google_myaccounts') }}
@endsection

@section('content')

    <div id="body">
        <section id="sc-heading" class="section text-center">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                        <h1> {{ trans('app.google_myaccounts') }} </h1>


                        @if (count($accounts))
                            <ul class="list-box">
                        	@foreach($accounts as $account)
                                <li>
                                    <b>{{ $account->webProperty_name}} -> {{ $account->profile_name }}  </b>
                                    <ul class="button-list-centered">
                                        <li>
                                            <a href="{{ URL::route('ga-account-test', ['id_google_account' => $account->id]) }}"><button class="btn btn-info">{{ trans('app.button_test') }}</button></a> 
                                        </li>
                                        <li>
                                            <a href="{{ URL::route('ga-account-delete', ['id_google_account' => $account->id]) }}"><button class="btn btn-danger">{{ trans('app.button_delete') }}</button></a>
                                        </li>
                                    </ul>
                                </li>
                        	@endforeach
                            </ul>

                        @else
                             <p> {{ trans('app.google_noaccount') }}</p>
                        @endif
                        <a href="{{ URL::route('ga-login') }}">
                            <button class="btn btn-primary btn-addtoslack"> <i class="fa fa-google"></i> <div> {{ trans('app.google_addaccount') }} </div></button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
