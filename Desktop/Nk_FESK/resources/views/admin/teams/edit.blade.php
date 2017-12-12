@extends('layouts.layout')

@section('title', 'Dodaj novu momčad')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dodaj novu momčad</h3>
            </div>
            <div class="panel-body">
                <form accept-charset="UTF-8" role="form" method="post" action="{{ route('teams.update', $team->id) }}">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="Naziv momčadi" name="naziv" type="text" value="{{ $team->naziv }}"/>
						{!! ($errors->has('naziv') ? $errors->first('naziv', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<input name="_method" value="PUT" type="hidden">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Create">
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@stop