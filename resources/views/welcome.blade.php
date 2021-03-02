@include('layouts.alumnoin')
<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-start">
            @foreach ($materias as $item)
            <div class="col-4 col-sm-6  col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{asset('images/portada_edited.jpg')}}" class="card-img-top" alt="">
                    <div class="card-body">
                        <a href="{{route('Temasaul',$item->id)}}"><h2>{{$item->nombremateria}} -- {{$item->nombregrado}}</h2></a>
                    </div>
                </div>
            </div>    
            {{-- <article class="about">
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
            </article> --}}
                
            @endforeach
        </div>
    </div>
</div>
@include('layouts.alumnofin')        