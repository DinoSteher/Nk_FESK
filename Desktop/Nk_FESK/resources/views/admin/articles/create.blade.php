@extends('layouts.layout')

@section('title', 'Dodaj novi članak')

@section('content')
<div class="row">
    <div class="col-md-12" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dodaj novi članak</h3>
            </div>
            <div class="panel-body">
                <form accept-charset="UTF-8" role="form" enctype="multipart/form-data" method="post" type="hidden" action="{{ route('articles.store') }}">
                <fieldset>
                    <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Naziv članka" name="name" type="text"}}" />
                        {!! ($errors->has('name') ? $errors->first('name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					
					<div class="form-group {{ ($errors->has('content')) ? 'has-error' : '' }}">
					
                        <textarea class="form-control" rows="15" cols="50" placeholder="Sadržaj članka" name="content" type="text"}}">
						</textarea>
                        {!! ($errors->has('content') ? $errors->first('content', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					
					<h5>Dodaj sliku članku:</h5>
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