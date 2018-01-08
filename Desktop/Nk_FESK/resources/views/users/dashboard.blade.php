@extends('layouts.layout')

@section('title', 'Početna')

@section('content')
<div class="row">

	<div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron"  style="background-color:#00e5ff;">
            <img class="img-fluid rounded" style="max-width:30%;max-height:30%;margin:auto;display:block;" src="{{$articles[0]->slika}}" alt="">
					<h3>{{$articles[0]->naziv}}</h1>
					<p><?php print substr($articles[0]->tekst, 0, 50) ?></p>
					<p><a class="btn btn-default" href="{{ route('article', urlencode($articles[0]->id)) }}" role="button">Pročitaj više &raquo;</a></p>
          </div>
          <div class="row">
		  @foreach(range(1,3) as $counter)
		  @if(isset($articles[$counter]))
            <div class="col-xs-6 col-lg-4">
				<div class="jumbotron"   style="background-color:#00e5ff;">
              <h2>{{$articles[$counter]->naziv}}</h2>
              <p><?php print substr($articles[$counter]->tekst, 0, 20) ?></p>
              <p><a class="btn btn-default" href="{{ route('article', urlencode($articles[$counter]->id)) }}" role="button">Pročitaj više &raquo;</a></p>
			  </div>
            </div><!--/.col-xs-6.col-lg-4-->
          @endif
		  @endforeach
		  </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div id="fb-root"></div>
				<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = 'https://connect.facebook.net/hr_HR/sdk.js#xfbml=1&version=v2.11';
					fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>
				<div class="fb-page" data-href="https://www.facebook.com/nkfesk1927/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
					<blockquote cite="https://www.facebook.com/nkfesk1927/" class="fb-xfbml-parse-ignore">
						<a href="https://www.facebook.com/nkfesk1927/">Nk Fešk Feričanci</a>
					</blockquote>
				</div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->
	</div>
</div>
@stop
