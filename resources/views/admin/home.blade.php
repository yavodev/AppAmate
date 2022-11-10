<x-main-layout>
    <!-- title -->
    @section('title')Inicio @endsection

     <!---- CSS ----->
    <x-slot name="css">
    </x-slot>    
    <div class="main-panel"> 
        <div class="content-wrapper">
        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row mb-2 d-flex align-items-center">
                    <!----- dashboard for ADMINISTRADOR ----->
                    @role('Admin')
                        <div class="col-sm-6">
                          <lottie-player src="{{asset('animations/dash.json')}}"  background="transparent"  
                            speed="1"  style="width: 300px; height: 300px; margin: 0 auto;" loop autoplay></lottie-player>

                            
                        </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <!-- count profesionales-->
                            <div class="col-md-6 col-xl-6 mb-5">
                              <div class="team1__item text-center mb-30">
                                  <div class="team1__thumb">
                                      <img src="{{ asset('images/calendar.png')}}" alt="Profesionales amate">
                                  </div>
                                  <div class="team1__content">
                                      <h4 class="text-white"></h4>
                                      <p class="fs-5"><span class="fw-bold text-uppercase">Profesionales Registrados</span></p>
                                      <div class="team1__btn">
                                          <button  class="btn btn-light fw-bold" style="cursor: default;">{{$count_profesionales}}</button>
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <!-- count usuarios-->
                            <div class="col-md-6 col-xl-6 mb-5">
                              <div class="team1__item text-center mb-30">
                                  <div class="team1__thumb">
                                      <img src="{{ asset('images/calendar.png')}}" alt="Usuarios amate">
                                  </div>
                                  <div class="team1__content">
                                      <h4 class="text-white"></h4>
                                      <p class="fs-5"><span class="fw-bold text-uppercase">Usuarios Registrados</span></p>
                                      <div class="team1__btn">
                                          <button  class="btn btn-light fw-bold" style="cursor: default;">{{$count_usuarios}}</button>
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <!-- count eventos-->
                            <div class="col-md-6 col-xl-6 mb-5">
                              <div class="team1__item text-center mb-30">
                                  <div class="team1__thumb">
                                      <img src="{{ asset('images/calendar.png')}}" alt="Eventos amate">
                                  </div>
                                  <div class="team1__content">
                                      <h4 class="text-white"></h4>
                                      <p class="fs-5"><span class="fw-bold text-uppercase">Eventos Registrados</span></p>
                                      <div class="team1__btn">
                                          <button  class="btn btn-light fw-bold" style="cursor: default;">{{$count_events}}</button>
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <!-- count noticias-->
                            <div class="col-md-6 col-xl-6 mb-5">
                              <div class="team1__item text-center mb-30">
                                  <div class="team1__thumb">
                                      <img src="{{ asset('images/calendar.png')}}" alt="Noticias amate">
                                  </div>
                                  <div class="team1__content">
                                      <h4 class="text-white"></h4>
                                      <p class="fs-5"><span class="fw-bold text-uppercase">Noticias Registradas</span></p>
                                      <div class="team1__btn">
                                          <button  class="btn btn-light fw-bold" style="cursor: default;">{{$count_noticias}}</button>
                                      </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    @endrole

                     <!----- dashboard for Profesionales ----->
                    @role('Usuario')
                        <div class="col-sm-6">
                          <lottie-player src="{{asset('animations/dash.json')}}"  background="transparent"  
                            speed="1"  style="width: 300px; height: 300px; margin: 0 auto;" loop autoplay></lottie-player>

                            
                        </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <!-- count profesionales-->
                            <div class="col-md-6 col-xl-6 mb-5">
                              <div class="team1__item text-center mb-30">
                                  <div class="team1__thumb">
                                      <img src="{{ asset('images/test.png')}}" class="mt-2" alt="Profesionales amate">
                                  </div>
                                  <div class="team1__content">
                                      <h4 class="text-white"></h4>
                                      <p class="fs-5"><span class="fw-bold text-uppercase">Realizar Test</span></p>
                                      <div class="team1__btn">
                                        <a href="{{route('test.index')}}" class="btn btn-light fw-bold" >¡Ver Test!</a>
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <!-- count usuarios-->
                            <div class="col-md-6 col-xl-6 mb-5">
                              <div class="team1__item text-center mb-30">
                                  <div class="team1__thumb">
                                      <img src="{{ asset('images/calendar.png')}}" class="mt-2" alt="Usuarios amate">
                                  </div>
                                  <div class="team1__content">
                                      <h4 class="text-white"></h4>
                                      <p class="fs-5"><span class="fw-bold text-uppercase">Agendar Cita</span></p>
                                      <div class="team1__btn">
                                          <a href="{{route('citation.agendar')}}" class="btn btn-light fw-bold" >¡Ver Citas!</a>
                                      </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    
                    @else
                        <div class="col-sm-6">
                            <lottie-player src="{{asset('animations/dash.json')}}"  background="transparent"  
                              speed="1"  style="width: 300px; height: 300px; margin: 0 auto;" loop autoplay></lottie-player>
  
                              
                          </div>
                          <div class="col-sm-6">
                            <div class="row">
  
                              <!-- count eventos-->
                              <div class="col-md-6 col-xl-6 mb-5">
                                <div class="team1__item text-center mb-30">
                                    <div class="team1__thumb">
                                        <img src="{{ asset('images/calendar.png')}}" alt="Eventos amate">
                                    </div>
                                    <div class="team1__content">
                                        <h4 class="text-white"></h4>
                                        <p class="fs-5"><span class="fw-bold text-uppercase">Eventos que e Registrado</span></p>
                                        <div class="team1__btn">
                                            <a  class="btn btn-light fw-bold" style="cursor: default;">{{$count_events}}</a>
                                        </div>
                                    </div>
                                </div>
                              </div>
  
                              <!-- count noticias-->
                              <div class="col-md-6 col-xl-6 mb-5">
                                <div class="team1__item text-center mb-30">
                                    <div class="team1__thumb">
                                        <img src="{{ asset('images/calendar.png')}}" alt="Noticias amate">
                                    </div>
                                    <div class="team1__content">
                                        <h4 class="text-white"></h4>
                                        <p class="fs-5"><span class="fw-bold text-uppercase">Noticias que e Registrado</span></p>
                                        <div class="team1__btn">
                                            <button  class="btn btn-light fw-bold" style="cursor: default;">{{$count_noticias}}</button>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm 12">
                            <div>
                              <canvas id="myChart"></canvas>
                            </div>
                          </div>
                    @endrole
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
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
        const labels = [
          'January',
          'February',
          'March',
        ];

        const data = {
          labels: labels,
          datasets: [{
            label: 'Cantidad de Usuarios según los Niveles de Violencia',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5],
          }]
        };

        const config = {
          type: 'line',
          data: data,
          options: {}
        };

        const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
      </script>
    </x-slot>
    
</x-main-layout>