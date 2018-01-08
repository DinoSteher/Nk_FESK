@extends('layouts.layout')
@section('title', 'Momčad')

@section('content')
<div class="page-header">
        <div class='btn-toolbar pull-right'>
        </div>
        <h1>{{ucfirst($team->naziv)}}</h1>
</div>
	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover">
					<thead>
                        <tr>
                            <th>Treneri</th>
                        </tr>
                    </thead>
                    <tbody>
						@foreach($players as $player)
						@if($player->pozicija=="Trener")
							<tr>
							<td>
								<img src="{{$player->slika}}" height="42" width="42">
								<a href="{{ route('player', urlencode($player->id)) }}">{{ucfirst($player->ime)}}, {{ucfirst($player->prezime)}}</a>
							</td>
							</tr>
						@endif
						@endforeach
					</tbody>
                    <thead>
                        <tr>
                            <th>Vratari</th>
                        </tr>
                    </thead>
                    <tbody>
						@foreach($players as $player)
						@if($player->pozicija=="Vratar")
							<tr>
							<td>
								<img src="{{$player->slika}}" height="42" width="42">
								<a href="{{ route('player', urlencode($player->id)) }}">{{ucfirst($player->ime)}}, {{ucfirst($player->prezime)}}</a>
							</td>
							</tr>
						@endif
						@endforeach
					</tbody>
					<thead>
                        <tr>
                            <th>Obrambeni</th>
                        </tr>
                    </thead>
                    <tbody>
						@foreach($players as $player)
						@if($player->pozicija=="Obrambeni")
							<tr>
							<td>
								<img src="{{$player->slika}}" height="42" width="42">
								<a href="{{ route('player', urlencode($player->id)) }}">{{ucfirst($player->ime)}}, {{ucfirst($player->prezime)}}</a>
							</td>
							</tr>
						@endif
						@endforeach
					</tbody>
					<thead>
                        <tr>
                            <th>Vezni</th>
                        </tr>
                    </thead>
                    <tbody>
						@foreach($players as $player)
						@if($player->pozicija=="Vezni")
							<tr>
							<td>
								<img src="{{$player->slika}}" height="42" width="42">
								<a href="{{ route('player', urlencode($player->id)) }}">{{ucfirst($player->ime)}}, {{ucfirst($player->prezime)}}</a>
							</td>
							</tr>
						@endif
						@endforeach
					</tbody>
					<thead>
                        <tr>
                            <th>Napadači</th>
                        </tr>
                    </thead>
                    <tbody>
						@foreach($players as $player)
						@if($player->pozicija=="Napadač")
							<tr>
							<td>
								<img src="{{$player->slika}}" height="42" width="42">
								<a href="{{ route('player', urlencode($player->id)) }}">{{ucfirst($player->ime)}}, {{ucfirst($player->prezime)}}</a>
							</td>
							</tr>
						@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop