<x-main-layout>
    <!-- title -->
    @section('title')Usuarios Registrados @endsection

     <!---- CSS ----->
    <x-slot name="css">
    </x-slot>    
    <div class="main-panel"> 
        <div class="content-wrapper">
        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                        <div class="row mb-2">
                          <div class="col-sm-6">
                           <h4 class="card-title">Listado de Usuarios Registrados</h4>
                          </div>
                          <div class="col-sm-6">
                          </div>
                        </div>
                  <p class="card-description">
                    El listado a continución es de todos los usurios registrados en el sistema, para ver si realizaron y el test, da clic sobre el icono de la columna <code>Ver Test</code> de la tabla
                  </p>
                                    
                    <table id="listarusuarios" class="display table table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>Imágen</th>
                          <th>Nombres</th>
                          <th>Correo</th>
                          <th>Estado</th>
                          <th>Ver Test</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                </div>
              </div>
          </div>
          </div>
        </div>
        @include('components.footer-admin')
    </div>
        
        <!-- partial -->
    
    
     <!-- |==============================| -->
    <x-slot name="js">
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"></script>
      <script>
        
          var tabla_usuarios = $('#listarusuarios').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json"
                },
                "ajax": "{{route('pacientes.obtener')}}",
            });
      </script>
    </x-slot>
    
</x-main-layout>