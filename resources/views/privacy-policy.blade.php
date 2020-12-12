@extends('layout.master')
@section('title')
    {{ trans('app.policy') }}
@endsection

@section('content')
    <div id="hero" class="static-header plain-version light clearfix">
        <div class="text-heading">
            <h1 class="animated hiding" data-animation="bounceInDown" data-delay="0">{{ trans('app.policy') }} </h1>
            <p class="animated hiding" data-animation="fadeInDown" data-delay="500">{{ trans('app.policy_description') }}</p>
        </div>
    </div>
        <hr class="no-margin" />
    
    <section id="process" class="section dark">
        <div class="container">
            <div class="section-content row"> 
                <div class="col-sm-12 animated hiding" data-animation="fadeInLeft">
                    <article>
                        <h3>- {{ trans('app.policy_title1') }} </h3>
                        <p>{{ trans('app.policy_description1') }}.</p>
                    </article>
                    <br/>
                </div>
                
                <hr class="clearfix" />
            </div>
            <div class="section-content row"> 
                <div class="col-sm-12 animated hiding" data-animation="fadeInLeft">
                    <article>
                        <h3>- {{ trans('app.policy_title2') }} </h3>
                        <p>{{ trans('app.policy_description2') }}.</p>
                    </article>
                    <br/>
                </div>
                
                <hr class="clearfix" />
            </div>
            <div class="section-content row"> 
                <div class="col-sm-12 animated hiding" data-animation="fadeInLeft">
                    <article>
                        <h3>- {{ trans('app.policy_title3') }} </h3>
                        <p>{{ trans('app.policy_description3') }}.</p>
                    </article>
                    <br/>
                </div>
                
                <hr class="clearfix" />
            </div>
            <div class="section-content row"> 
                <div class="col-sm-12 animated hiding" data-animation="fadeInLeft">
                    <article>
                        <h3>- {{ trans('app.policy_title4') }} </h3>
                        <p>{{ trans('app.policy_description4') }}.</p>
                    </article>
                    <br/>
                </div>
                
                <hr class="clearfix" />
            </div>
            <div class="section-content row"> 
                <div class="col-sm-12 animated hiding" data-animation="fadeInLeft">
                    <article>
                        <h3>- {{ trans('app.policy_title5') }} </h3>
                        <p>{{ trans('app.policy_description5') }}.</p>
                    </article>
                    <br/>
                </div>
            </div>
        </div>
    </section>
@endsection
