@include('layouts.alumnoin')
<div class="container">
	<h2 class="demoHeaders">Temas</h2>
	{{-- {{dd($temario)}} --}}
	<div id="accordion">
		@forelse($temario as $key=> $item)
			<h3>{{$item->nombre_tema}}</h3>
			<div style="text-align: center;">
				@if($item->rutavideo != "")
					<p style="text-align: center; font-size: 20px;"> <strong>Multimedia</strong></p>
					<video controls>
						<source src="{{Storage::url($item->rutavideo)}}" type="video/mp4">
							Tu navegador no implementa el elemento <code>video</code>
					</video>
					<br>
					<a href="{{route('preguntasalu',$item->id)}}" class="btn btn-success">Contestar Ejecicios</a>

				@else
					<p>No hay videos que mostrar</p>
					<a href="{{route('preguntasalu',$item->id)}}" class="btn btn-success">Contestar Ejecicios</a>
				@endif
			</div>
		@empty
			<div>
				No hay temas que mostrar
			</div>
		@endforelse
	</div>
</div>
@include('layouts.alumnofin')
<script src="{{asset('bootstrap/js/jqueryui/jquery-ui.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	$( "#accordion" ).accordion({heightStyle: 'panel'});
</script>