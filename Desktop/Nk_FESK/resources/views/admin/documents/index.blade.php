@extends('layouts.layout')
@section('title', 'Dokumenti')

@section('content')
<div class="page-header">
        <div class='btn-toolbar pull-right'>
            <a class="btn btn-primary btn-lg" href="{{ route('documents.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Dodaj dokument
            </a>
        </div>
        <h1>Dokumenti</h1>
</div>
	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover"> 
					<thead>
                        <tr>
							<th>Naziv</th>
							<th>Putanja</th>
							<th>Akcija</th>
                        </tr>
                    </thead>
					@foreach($documents as $document)
					<tr>
							<td>{{ucfirst($document->naziv)}}</td>
							<td> <a href="{{$document->putanja}}">Link na PDF</a></p></td>
							<td>
								<a href="{{ route('documents.destroy', $document->id) }}" class="btn btn-danger" data-method="delete" data-token="{{ csrf_token() }}">
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