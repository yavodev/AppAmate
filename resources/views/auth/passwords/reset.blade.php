<x-main-frontend>
    <!-- title -->
    @section('title')Restablecimiento de Contraseña @endsection
    <x-slot name="css">
    </x-slot>
  <!-- |==========================================| -->
    <section class="about3">
        <div class="content_box_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="title2 mb-60 text-center">
                            <h2>{{ __('Reset Password') }}</h2>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header"></div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('password.update') }}" id="quickForm" novalidate>
                                    @csrf
            
                                    <input type="hidden" name="token" value="{{ $token }}">
            
                                    <div class="row mb-3">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electónico') }}</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
            
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required equalto="#password">
                
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn2">
                                                {{ __('Reset Password') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <x-slot name="js">
        <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{asset('vendors/jquery-validation/additional-methods.min.js')}}"></script>
        <script>
            $(function () {
                $('#quickForm').validate({
                    rules: {
                        password: {
                            required: true,
                            minlength:8
                        },
                        password_confirmation:{
                            required: true,
                            minlength:8
                        },
                    },
                    messages: {
                    password: {
                        required: "Ingrese una contraseña",
                        minlength: "Ingrese una contraseña minimo de 8 carácteres",
                    },
                    password_confirmation: {
                        required: "Repita la contraseña",
                        minlength: "Ingrese una contraseña minimo de 8 carácteres",
                        equalTo: 'Las contraseñas no son iguales'
                    },
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    }
                });
            });
            
        </script>
    </x-slot>

</x-main-frontend>
