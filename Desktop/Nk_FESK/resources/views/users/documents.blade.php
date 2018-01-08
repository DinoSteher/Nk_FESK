@extends('layouts.layout')
@section('title', 'Dokumenti')

@section('content')
<div class="page-header">
        <div class='btn-toolbar pull-right'>
        </div>
        <h1>Dokumenti</h1>
</div>
	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Naziv dokumenta</th>
                        </tr>
                    </thead>
                    <tbody>
						@foreach($documents as $document)
							<tr>
							<td>{{ucfirst($document->naziv)}}</td>
							<td> <a href="{{$document->putanja}}">Link na PDF</a></p></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop