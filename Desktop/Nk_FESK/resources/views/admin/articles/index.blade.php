@extends('layouts.layout')
@section('title', 'Članci')

@section('content')
<div class="page-header">
        <div class='btn-toolbar pull-right'>
            <a class="btn btn-primary btn-lg" href="{{ route('articles.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Dodaj članak
            </a>
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
							<th>Akcija</th>
                        </tr>
                    </thead>
					@foreach($articles as $article)
					<tr>
							<td><img src="{{ $article->slika }}" alt="{{ $article->slika }}" style="width:100px;height:100px;"></td>
							<td>{{ucfirst($article->naziv)}}</td>
							<td> <p>{{$article->tekst}}</p></td>
							<td>
								<a href="{{ route('articles.edit', $article->id) }}" class="btn btn-default">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
									Edit
								</a>
								<a href="{{ route('articles.destroy', $article->id) }}" class="btn btn-danger" data-method="delete" data-token="{{ csrf_token() }}">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    Delete
                                    </a>
							</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@stop