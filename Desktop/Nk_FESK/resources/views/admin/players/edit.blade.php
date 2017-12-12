@extends('layouts.layout')

@section('title', 'Uredi igrača')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Uredi igrača</h3>
            </div>
            <div class="panel-body">
                <form accept-charset="UTF-8" enctype="multipart/form-data" role="form" method="post" type="hidden" action="{{ route('players.update', $player->id) }}">
                <fieldset>
                    <div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Ime igrača" name="first_name" type="text" value="{{ $player->ime }}"}}" />
                        {!! ($errors->has('first_name') ? $errors->first('first_name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Prezime igrača" name="last_name" type="text" value="{{ $player->prezime }}"}}" />
                        {!! ($errors->has('last_name') ? $errors->first('last_name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					
					<h5>Datum Rođenja:</h5>
					<input type="date" name="date" value="{{$player->datum_rodenja}}">
                    
                    <h5>Momčad:</h5>
						<select id="teamId" name="teamId">
							@foreach ($teams as $team)
								<option value="{{$team->id}}" <?php if($player->id_ekipa == $team->id){ echo "selected";}?> >{{ucfirst($team->naziv)}}</option>
							@endforeach
						</select> 
						<hr />
					<h5>Pozicija:</h5>
						<select id="position" name="position">
							<option value="Vratar" <?php if($player->pozicija == "Vratar"){ echo "selected";}?> >Vratar</option>
							<option value="Obrambeni" <?php if($player->pozicija == "Obrambeni"){ echo "selected";}?>>Obrambeni</option>
							<option value="Vezni" <?php if($player->pozicija == "Vezni"){ echo "selected";}?>>Vezni</option>
							<option value="Napadač" <?php if($player->pozicija == "Napadač"){ echo "selected";}?> >Napadač</option>
						</select>
					<hr />
					<h5>Slika igrača:</h5>
						<input type="file" name="file" id="file">
                    <hr />
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<input name="_method" value="PUT" type="hidden">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Update">
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@stop