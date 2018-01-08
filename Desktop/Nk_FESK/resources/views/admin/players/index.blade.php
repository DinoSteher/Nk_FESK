@extends('layouts.layout')
@section('title', 'Igrači')

@section('content')
<div class="page-header">
        <div class='btn-toolbar pull-right'>
            <a class="btn btn-primary btn-lg" href="{{ route('players.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Dodaj igrača
            </a>
        </div>
        <h1>Igrači</h1>
</div>
	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		@foreach($teams as $team)
            <div class="table-responsive">
                <table class="table table-hover"> 
					<thead>
					<h2>{{ucfirst($team->naziv)}}</h2>
                        <tr>
							<th>Slika</th>
                            <th>Ime</th>
							<th>Prezime</th>
							<th>Pozicija</th>
                            <th>Datum rođenja</th>
							<th>Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
						@foreach($players as $player)
						<?php 
						if($player->id_ekipa==$team->id){
							?>
							<tr>
							<td><img src="{{ $player->slika }}" alt="{{ $player->slika }}" style="width:50px;height:50px;"></td>
							<td>{{ucfirst($player->ime)}}</td>
							<td>{{ucfirst($player->prezime)}}</td>
							<td>{{ucfirst($player->pozicija)}}</td>
							<td><?php
								$splitDate = explode('-', $player->datum_rodenja);
								$month = $splitDate[2];
								$day   = $splitDate[1];
								$year  = $splitDate[0];
							?>{{$day.".".$month.".".$year."."}}</td>
							<td>
								<a href="{{ route('players.edit', $player->id) }}" class="btn btn-default">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
									Edit
								</a>
								<a href="{{ route('players.destroy', $player->id) }}" class="btn btn-danger" data-method="delete" data-token="{{ csrf_token() }}">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    Delete
                                    </a>
							</td>
							</tr>
						<?php
							}
						?>
						@endforeach
					</tbody>
				</table>
			</div>
		@endforeach
		<div class="table-responsive">
                <table class="table table-hover"> 
					<thead>
					<h2>Bez momčadi</h2>
                        <tr>
							<th>Slika</th>
                            <th>Ime</th>
							<th>Prezime</th>
							<th>Pozicija</th>
                            <th>Datum rođenja</th>
							<th>Akcija</th>
                        </tr>
                    </thead>
					<tbody>
						@foreach($players as $player)
						<?php 
						if($player->id_ekipa==NULL){
							?>
							<tr>
							<td><img src="{{ $player->slika }}" alt="{{ $player->slika }}" style="width:50px;height:50px;"></td>
							<td>{{ucfirst($player->ime)}}</td>
							<td>{{ucfirst($player->prezime)}}</td>
							<td>{{ucfirst($player->pozicija)}}</td>
							<td><?php
								$splitDate = explode('-', $player->datum_rodenja);
								$month = $splitDate[2];
								$day   = $splitDate[1];
								$year  = $splitDate[0];
							?>{{$day.".".$month.".".$year."."}}</td>
							<td>
								<a href="{{ route('players.edit', $player->id) }}" class="btn btn-default">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
									Edit
								</a>
								<a href="{{ route('players.destroy', $player->id) }}" class="btn btn-danger" data-method="delete" data-token="{{ csrf_token() }}">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    Delete
                                    </a>
							</td>
							</tr>
						<?php
							}
						?>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop