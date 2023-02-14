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
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electónico') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn2">
                                                {{ __('Send Password Reset Link') }}
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
    </x-slot>

</x-main-frontend>
