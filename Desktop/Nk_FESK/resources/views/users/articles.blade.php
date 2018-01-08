@extends('layouts.layout')
@section('title', 'Članci')

@section('content')
<div class="page-header">
        <div class='btn-toolbar pull-right'>
        </div>
        <h1>Članci</h1>
</div>
	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover"> 
					<thead>
                        <tr>
							<th>Slika</th>
							<th>Naziv</th>
							<th>Tekst</th>
                        </tr>
                    </thead>
					@foreach($articles as $article)
					<tr>
							<td><img src="{{ $article->slika }}" alt="{{ $article->slika }}" style="width:100px;height:100px;"></td>
							<td><a href="{{ route('article', urlencode($article->id)) }}">{{ucfirst($article->naziv)}}</a></td>
							<td><p>{{substr($article->tekst, 0, 50)}}</p></td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@stop