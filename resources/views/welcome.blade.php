@include('layouts.alumnoin')
<div class="container">
    <ul class="list-group.item">
        @forelse($materias as $item)
            <li class="list-group-item border-0 mb-3 shadow-sm">
                <a href="{{route('Temasaul',$item->id)}}" class="d-flex justify-content-between">{{$item->nombremateria}}
                <span>
                    @if($item->urlimagenmat != "")
                        <img src="{{Storage::url($item->urlimagenmat)}}" width="100vh">
                    @else
                        <p>No hay portad que mostrar</p>
                    @endif
                </span>
                <span>
                    {{$item->nombregrado}}
                </span>
                </a>
            </li>
        @empty
            <li class="list-group-item border-0 mb-3 shadow-sm">
                No hay materias que mostrar
            </li>
        @endforelse
    </ul>
</div>
@include('layouts.alumnofin')