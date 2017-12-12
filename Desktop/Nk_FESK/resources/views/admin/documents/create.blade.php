@extends('layouts.layout')

@section('title', 'Dodaj novi dokument')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dodaj novi dokument</h3>
            </div>
            <div class="panel-body">
                <form accept-charset="UTF-8" enctype="multipart/form-data" role="form" method="post" type="hidden" action="{{ route('documents.store') }}">
                <fieldset>
                    <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Ime dokumenta" name="name" type="text"}}" />
                        {!! ($errors->has('name') ? $errors->first('name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>

					<h5>Dokument:</h5>
						<input type="file" name="file" id="file">
						{!! ($errors->has('file') ? $errors->first('file', '<p class="text-danger">:message</p>') : '') !!}
                    <hr />
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Create">
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@stop