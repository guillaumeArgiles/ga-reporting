@extends('layout.master')
@section('title')
	{{ trans('app.home_title1') }} {{ trans('app.home_title2') }} {{ trans('app.home_title3') }}
@endsection

@section('content')
    <div id="hero" class="static-header plain-version light clearfix">
        <div class="text-heading">
            <h1 class="animated hiding" data-animation="bounceInDown" data-delay="0">{{ trans('app.home_title1') }} <span class="highlight">{{ trans('app.home_title2') }}</span> {{ trans('app.home_title3') }}</h1>
            <p class="animated hiding" data-animation="fadeInDown" data-delay="500">{{ trans('app.home_description') }}</p>
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
                <div class="col-sm-6 pull-right animated hiding" data-animation="fadeInRight">
                    <img src="<?php echo asset('img/features/content_image1.png'); ?>" class="img-responsive" alt="process 2" />
                </div>
                <div class="col-sm-6 animated hiding" data-animation="fadeInLeft">
					<br/><br/>
                    <article>
                        <h3>{{ trans('app.home_step1_title1') }} <span class="highlight">{{ trans('app.home_step1_title2') }}</span></h3>
                        <div class="sub-title">{{ trans('app.home_step1_subtitle') }}</div>
                        <p>{{ trans('app.home_step1_description') }}.</p>
                    </article>
                </div>
                
                <hr class="clearfix" />
                
                <div class="col-sm-6 animated hiding" data-animation="fadeInLeft">
                    <img src="<?php echo asset('img/features/rich_features_3.png'); ?>" class="img-responsive" alt="process 3" />
                </div>
                <div class="col-sm-6 animated hiding" data-animation="fadeInRight">
					<br/><br/>
                    <article>
                        <h3>{{ trans('app.home_step2_title1') }} <span class="highlight">{{ trans('app.home_step2_title2') }}</span> {{ trans('app.home_step2_title3') }}</h3>
                        <div class="sub-title">{{ trans('app.home_step2_subtitle') }}</div>
                        <p>{{ trans('app.home_step2_description') }}.</p>
                    </article>
                </div>
                
            </div>
        </div>
    </section>

    <section id="guarantee" class="long-block light">
        <div class="container">
            <div class="col-md-12 col-lg-9">
				<i class="icon icon-seo-icons-24 pull-left"></i>
                <article class="pull-left">
                    <h2>{{ trans('app.home_call_title') }}</h2>
                    <p class="thin">{{ trans('app.home_call_description') }}</p>
                </article>
            </div>
			
            <div class="col-md-12 col-lg-3">
                <a href="{{ URL::route('install') }}" class="btn btn-default">{{ trans('app.home_call_button') }}</a>
            </div>
        </div>
    </section>
@endsection
