@include('layouts.Inicio')
<div id="app" class="container-fluid">
    <br> 
    <h1>{!!$vista[0]['reactivo']!!}</h1>    
    <?php $i=0;?>
    @foreach ($respuesta as $item)
       <h2> {{$inciso[$i]}} )<input type="radio" name="respuesta" id="" style="width: 50px;  height: 24px;">
        {!!$item['respuesta']!!}</h2>
        <?php $i++; ?>
    @endforeach
</div>
@include('layouts.final')
