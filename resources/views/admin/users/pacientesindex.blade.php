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
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="registrados-tab" data-bs-toggle="tab" data-bs-target="#registrados" type="button" role="tab" aria-controls="registrados" aria-selected="true">Usuarios Registrados</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="anonimos-tab" data-bs-toggle="tab" data-bs-target="#anonimos" type="button" role="tab" aria-controls="anonimos" aria-selected="false">Usuarios Anónimos</button>
                    </li>
                  </ul>
                  <!---------------- Panel de usuarios registrados ------------->
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="registrados" role="tabpanel" aria-labelledby="registrados-tab">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                         <h4 class="card-title">Listado de Usuarios Registrados</h4>
                        </div>
                        <div class="col-sm-6">
                        </div>
                      </div>
                      <p class="card-description">
                        El listado a continución es de todos los usuarios registrados en el sistema, para ver si realizaron y el test, da clic sobre el icono de la columna <code>Ver Test</code> de la tabla
                      </p>
                                        
                        <table id="listarusuarios" class="display table table-striped" style="width:100%">
                          <thead>
                            <tr>
                              <th>Imágen</th>
                              <th>Nombres</th>
                              <th>Correo</th>
                              <th>Nivel de Violencia</th>
                              <th>Estado</th>
                              <th>Ver Test</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                    </div>
                    <!---------------- Panel de usuarios anonimos ------------->
                    <div class="tab-pane fade" id="anonimos" role="tabpanel" aria-labelledby="anonimos-tab">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                         <h4 class="card-title">Test Anónimos</h4>
                        </div>
                        <div class="col-sm-6">
                        </div>
                      </div>
                      <p class="card-description">
                        El listado a continución es de todos los Test anónimos registrados en el sistema, para ver el test, da clic sobre el icono de la columna <code>Ver Test</code> de la tabla
                      </p>
                                        
                        <table id="listarusuariosanonimos" class="display table table-striped" style="width:100%">
                          <thead>
                            <tr>
                              <th>Usuario Anónimo</th>
                              <th>Nivel de Violencia</th>
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
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        
          var tabla_usuarios = $('#listarusuarios').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json"
                },
                "ajax": "{{route('pacientes.obtener')}}",
                "scrollX": true,
                "responsive": true
            });
            $("#listarusuarios").removeClass("dataTable");

            var tabla_usuarios2 = $('#listarusuariosanonimos').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json"
                },
                "ajax": "{{route('pacientes.obtenerAnonimos')}}",
                "scrollX": true,
                "responsive": true
            });
            $("#listarusuariosanonimos").removeClass("dataTable");

            function eliminarUsuario(id){
              //console.log("soy id"+id);
                Swal.fire({
                    title: 'Eliminar Usuario',
                    text: "¿Estás seguro de eliminar este usuario?",
                    icon: 'question',
                    showCancelButton: 'Cancelar',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = "usuarios/destroypaciente/"+id;
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            type: "GET",
                            encoding:"UTF-8",
                            url: url,
                            dataType:'json',
                            beforeSend:function(){
                                Swal.fire({
                                    text: 'Eliminando usuario, espere...',
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                    },
                                });
                            }
                        }).done(function(respuesta){
                            //console.log(respuesta);
                            if (!respuesta.error) {
                                Swal.fire({
                                    title: 'Usuario Eliminado!',
                                    icon: 'success',
                                    showConfirmButton: true,
                                    timer: 2000
                                });
                                tabla_usuarios.ajax.reload();
                            } else {
                                setTimeout(function(){
                                    Swal.fire({
                                        title: respuesta.mensaje,
                                        icon: 'error',
                                        showConfirmButton: true,
                                        timer: 4000
                                    });
                                },2000);
                            }
                        }).fail(function(resp){
                            console.log(resp);
                        });
                    }
                })
            }
      </script>
    </x-slot>
    
</x-main-layout>