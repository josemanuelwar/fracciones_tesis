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
                <button type="submit" class="btn btn-outline-primary" title="Cargar Archivo exel">subir</button>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="informacion">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Formato del archivo de exel a cargar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><img src="{{asset('admin/assets/img/archivoexel.PNG')}}" class="card-img-top" alt=""></p>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


@include('layouts.final')
<script src="{{asset('js/modal.js')}}"></script>