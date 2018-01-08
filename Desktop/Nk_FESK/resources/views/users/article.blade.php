@extends('layouts.layout')
@section('title', 'Članak')

@section('content')
<div class="blog-header">
	<div class="blog-masthead">
		<div class="containter">
			<h1 class="blog-title">{{$article->naziv}}</h1>
			<img class="lead blog-description" src="{{$article->slika}}">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 blog-main">
		<div class="blog-post">
			<p><?php print $article->tekst?></p>
		</div>
		<?php
		if(strlen($article->dokument)>0){?>
		<div>
		Prilog uz članak:
		<a href="{{$article->dokument}}">Prilog</a>
		
		</div>
		<?php }?>
	</div>
</div>
@stop