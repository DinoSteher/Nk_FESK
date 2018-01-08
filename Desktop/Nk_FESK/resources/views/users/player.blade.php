@extends('layouts.layout')
@section('title', 'Igrač')

@section('content')
<div class="page-header">
        <div class='btn-toolbar pull-right'>
        </div>
        <h1>{{ucfirst($player->ime)}} {{ucfirst($player->prezime)}}</h1>
</div>
<div style="text-align:center;">
	<img src="{{$player->slika}}" alt="Image"/>
	<br>
	<br>
	<p><b>Pozicija: {{$player->pozicija}}<b></p>
	<p>Datum rođenja: {{$player->datum_rodenja}}</p>
</div>
@stop