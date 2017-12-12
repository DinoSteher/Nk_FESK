@extends('layouts.layout')

@section('title', 'Dodaj novu galeriju')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dodaj novu galeriju</h3>
            </div>
            <div class="panel-body">
                <form accept-charset="UTF-8" enctype="multipart/form-data" role="form" method="post" type="hidden" action="{{ route('gallery.store') }}">
                <fieldset>
                    <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Ime galerije" name="name" type="text"}}" />
                        {!! ($errors->has('name') ? $errors->first('name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Create">
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@stop