@include('layouts.alumnoin')
@foreach ($temario as $key=> $item)
    <article class="about">
        <h2>{{$key+1}}). <a href="{{route('preguntasalu',$item->id)}}">{{$item->nombre_tema}}</a></h2>
    </article>
@endforeach
@include('layouts.alumnofin')