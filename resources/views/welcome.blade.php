@include('layouts.alumnoin')
    @foreach ($materias as $item)
    <article class="about">
        <a href="{{route('Temasaul',$item->id)}}"><h2>{{$item->nombremateria}} -- {{$item->nombregrado}}</h2></a>
        @if ($item->nombregrado == 'TERCERO')
            <img src="{{asset('images/portada_edited.jpg')}}" alt="" srcset="">
        @endif
        @if ($item->nombregrado == 'CUARTO')
            <img src="{{asset('images/portada1_edited.jpg')}}" alt="" srcset="">
        @endif
        @if ($item->nombregrado == 'QUINTO')
            <img src="{{asset('images/portada3_edited.jpg')}}" alt="" srcset="">
        @endif
        @if ($item->nombregrado == 'SEXTO')
            <img src="{{asset('images/portada2_edited.jpg')}}" alt="" srcset="">
        @endif
    </article>
        
    @endforeach
@include('layouts.alumnofin')        