@extends('layout.master')
@section('title')
    Mes rapports
@endsection

@section('content')

    <div id="body">
        <section id="sc-heading" class="section text-center">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                        <h1> Mes rapports </h1>
                        @if (count($summaries))
                        	<ul class="list-box">
                        	@foreach($summaries as $summary)
                                <li> 
                                    <b>{{ $summary->name}}  </b>
                                    <ul class="button-list-centered">
                                        <li>
                                            <a href="{{ URL::route('summaries-test', ['id_summary' => $summary->id]) }}"> <button class="btn btn-info">Tester</button></a>
                                        </li>
                                        <li>
                                            <a href="{{ URL::route('summaries-edit', ['id_summary' => $summary->id]) }}"> <button class="btn btn-warning">Modifier</button></a> 
                                        </li>
                                        <li>
                                            <a href="{{ URL::route('summaries-delete', ['id_summary' => $summary->id]) }}"> <button class="btn btn-danger">Supprimer</button> </a>
                                        </li>
                                    </ul>
                                </li>

                        	@endforeach
                        	</ul>
                        @else
                        	<p>Désolé vous n'avez pas de rapport </p>
                        @endif
                        <a href="{{ URL::route('summaries-add') }}"> 
                            <button class="btn btn-primary btn-addtoslack"> <i class="fa fa-list-alt"></i> <div>Créer un rapport</div></button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
