@extends('layouts.layout')
@section('title', 'Ekipe')

@section('content')
<div class="page-header">
        <div class='btn-toolbar pull-right'>
        </div>
        <h1>{{ucfirst($team->naziv)}}</h1>
</div>
	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Igrači</th>
                        </tr>
                    </thead>
                    <tbody>
						@foreach($players as $player)
							<tr>
							<td>{{ucfirst($player->ime)}}, {{ucfirst($player->prezime)}}</td>
							</tr>
						@endforeach
					</tbody>
@stop