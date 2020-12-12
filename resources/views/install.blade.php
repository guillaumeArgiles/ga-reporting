@extends('layout.master')
@section('title')
    {{ trans('app.install') }}
@endsection

@section('content')
    <div id="hero" class="static-header plain-version light clearfix">
        <div class="text-heading">
            <h1 class="animated hiding" data-animation="bounceInDown" data-delay="0">{{ trans('app.install_title1') }} <span class="highlight">{{ trans('app.install_title2') }}</span> {{ trans('app.install_title3') }}</h1>
            <p class="animated hiding" data-animation="fadeInDown" data-delay="500">{{ trans('app.install_description') }}</p>
            <ul class="list-inline">
                <li><a href="{{ URL::route('login') }}" class="btn btn-primary animated hiding" data-animation="bounceIn" data-delay="700">{{ trans('app.login') }}</a></li>
                <li><a href="{{ URL::route('register') }}" class="btn btn-default animated hiding" data-animation="bounceIn" data-delay="900">{{ trans('app.register') }}</a></li>
            </ul>
        </div>
    </div>
        <hr class="no-margin" />
    
    <section id="process" class="section dark">
        <div class="container">
            <div class="section-content row"> 
                <div class="col-sm-12 animated hiding" data-animation="fadeInLeft">
                    <article>
                        <h3>1 - {{ trans('app.install_step1_title1') }} <span class="highlight">{{ trans('app.install_step1_title2') }}</span></h3>
                        <div class="sub-title">{{ trans('app.install_step1_subtitle') }}</div>
                        <p>{{ trans('app.install_step1_description') }}.</p>
                        <br />
                        <center>
                            <ul class="list-inline">
                                <li><a href="{{ URL::route('login') }}" class="btn btn-primary">{{ trans('app.login') }}</a></li>
                                <li><a href="{{ URL::route('register') }}" class="btn btn-primary">{{ trans('app.register') }}</a></li>
                            </ul>
                        </center>
                    </article>
                    <br/>
                </div>
                
                <hr class="clearfix" />
            </div>
            <div class="section-content row"> 
                <div class="col-sm-12 animated hiding" data-animation="fadeInLeft">
                    <article>
                        <h3>2 - {{ trans('app.install_step2_title1') }} <span class="highlight">{{ trans('app.install_step2_title2') }}</span></h3>
                        <div class="sub-title">{{ trans('app.install_step2_subtitle') }}</div>
                        <p>{{ trans('app.install_step2_description') }}.</p>
                    </article>
                    <br />
                    <center>
                        <ul class="list-inline">
                            <li><a href="{{ URL::route('channels') }}" class="btn btn-primary">{{ trans('app.channels_mychannels') }}</a></li>
                        </ul>
                    </center>
                    <br/>
                </div>
                
                <hr class="clearfix" />
            </div>
            <div class="section-content row"> 
                <div class="col-sm-12 animated hiding" data-animation="fadeInLeft">
                    <article>
                        <h3>3 - {{ trans('app.install_step3_title1') }} <span class="highlight">{{ trans('app.install_step3_title2') }}</span></h3>
                        <div class="sub-title">{{ trans('app.install_step3_subtitle') }}</div>
                        <p>{{ trans('app.install_step3_description') }}.</p>
                    </article>
                    <br />
                    <center>
                        <ul class="list-inline">
                            <li><a href="{{ URL::route('ga-accounts') }}" class="btn btn-primary">{{ trans('app.google_myaccounts') }}</a></li>
                        </ul>
                    </center>
                    <br/>
                </div>
                
                <hr class="clearfix" />
            </div>
            <div class="section-content row"> 
                <div class="col-sm-12 animated hiding" data-animation="fadeInLeft">
                    <article>
                        <h3>4 - {{ trans('app.install_step4_title1') }} <span class="highlight">{{ trans('app.install_step4_title2') }}</span></h3>
                        <div class="sub-title">{{ trans('app.install_step4_subtitle') }}</div>
                        <p>{{ trans('app.install_step4_description') }}</p>
                    </article>
                    <br />
                    <center>
                        <ul class="list-inline">
                            <li><a href="{{ URL::route('reportings') }}" class="btn btn-primary">{{ trans('app.reportings_myreportings') }}</a></li>
                        </ul>
                    </center>
                    <br/>
                </div>
                
                <hr class="clearfix" />
            </div>
            <div class="section-content row"> 
                <div class="col-sm-12 animated hiding" data-animation="fadeInLeft">
                    <article>
                        <h3>5 - {{ trans('app.install_step5_title1') }}  <span class="highlight">{{ trans('app.install_step5_title2') }}</span> !</h3>
                        <div class="sub-title">{{ trans('app.install_step5_subtitle') }}</div>
                        <p>{{ trans('app.install_step5_description') }}. </p>
                    </article>
                    <br />
                    <center>
                        <ul class="list-inline">
                            <li><a href="{{ URL::route('support') }}" class="btn btn-primary">{{ trans('app.install_step5_button') }}</a></li>
                        </ul>
                    </center>
                    <br />
                </div>
                
            </div>
        </div>
    </section>

@endsection
