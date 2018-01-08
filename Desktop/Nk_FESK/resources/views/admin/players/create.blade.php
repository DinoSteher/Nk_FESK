@extends('layouts.layout')

@section('title', 'Dodaj novog igrača')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dodaj novog igrača</h3>
            </div>
            <div class="panel-body">
                <form accept-charset="UTF-8" enctype="multipart/form-data" role="form" method="post" type="hidden" action="{{ route('players.store') }}">
                <fieldset>
                    <div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Ime igrača" name="first_name" type="text"}}" />
                        {!! ($errors->has('first_name') ? $errors->first('first_name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Prezime igrača" name="last_name" type="text"}}" />
                        {!! ($errors->has('last_name') ? $errors->first('last_name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<h5>Datum Rođenja:</h5>
					<input type="date" name="date">
					{!! ($errors->has('date') ? $errors->first('date', '<p class="text-danger">:message</p>') : '') !!}
                    
                    <h5>Momčad:</h5>
						<select id="teamId" name="teamId">
							@foreach ($teams as $team)
								<option value="{{$team->id}}">{{ucfirst($team->naziv)}}</option>
							@endforeach
						</select>
						{!! ($errors->has('teamId') ? $errors->first('teamId', '<p class="text-danger">:message</p>') : '') !!}
					<hr />
					<h5>Pozicija:</h5>
						<select id="position" name="position">
							<option value="Vratar">Vratar</option>
							<option value="Igrač">Igrač</option>
							<option value="Trener">Trener</option>
						</select>
					{!! ($errors->has('position') ? $errors->first('position', '<p class="text-danger">:message</p>') : '') !!}
					<hr />
					<h5>Slika igrača:</h5>
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