@extends('layouts.layout')
@section('title', 'Galerija')

@section('content')
<div class="page-header">
        <div class='btn-toolbar pull-right'>
            <a class="btn btn-primary btn-lg" href="{{ route('gallery.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Dodaj galeriju
            </a>
        </div>
        <h1>Galerije</h1>
</div>
	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover"> 
					<thead>
                        <tr>
							<th>Naziv</th>
							<th>Broj slika</th>
							<th>Akcija</th>
                        </tr>
                    </thead>
					@foreach($galleries as $gallery)
					<tr>
							<td>{{ucfirst($gallery->naziv)}}</td>
							<td> 12 </td>
							<td>
								<a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-default">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
									Edit
								</a>
								<a href="{{ route('gallery.destroy', $gallery->id) }}" class="btn btn-danger" data-method="delete" data-token="{{ csrf_token() }}">
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