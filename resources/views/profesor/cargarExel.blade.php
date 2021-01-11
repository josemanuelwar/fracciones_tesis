@include('layouts.Inicio')
<div class="container-fluid">
<br>
    <div class="card">
        <div class="card-header">
            <h3>Cargar Lista Alumnos en Excel</h3>
        </div>
        <div class="card-body">
            <form  action="{{ route('importar-excel') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(Session::has('message'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{Session::get('message')}}</strong>
                    </div>
                @endif
                <div class="form-group">
                    <label for="excel">Selecciona el archivo Exel</label>
                    <input type="file" class="form-control-file" id="excel" name="excel">
                </div>
                <input type="submit" value="Cargar">
            </form>
        </div>
    </div>
</div>
@include('layouts.final')
