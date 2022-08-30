@extends('MainLayoutLoginRegistration.Main')

@section('content')
    <div class="sign-up container-fluid">
        <div class="form-sign-up row mx-auto">
            <div class="col-2 col-sm-7">

            </div>
            <div class="col-10 col-sm-5 d-grid align-items-center">
                <form action="/signup_user" method="post" class="bg-white p-3 rounded-2">
                    @csrf
                    <h3 class="mb-3">Daftar Pengguna</h3>
                    @if($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <input type="text" class="form-control @error('nameBuyer') is-invalid @enderror" placeholder="Nama Lengkap" name="nameBuyer" value="{{ old('nameBuyer') }}">
                                @error('nameBuyer')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" value="{{ old('username') }}">
                                @error('username')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
                                @error('password')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi Password" name="password_confirmation">
                                @error('password_confirmation')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control @error('address') is-invalid @enderror" placeholder="Alamat Lengkap" id="floatingTextarea2" name="address" style="height: 50px; overflow: hidden">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label for="floatingTextarea2">Alamat Lengkap</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary border-0 rounded-0 button-sign-up">Daftar</button>
                    <div class="text-center mt-3">
                        <p class="card-text">
                            <small class="text-muted">
                                Dengan mendaftar, Anda setuju dengan <span>Syarat, Ketentuan dan Kebijakan
                                    dari Shoope & Kebijakan Privasi</span>
                            </small>
                        </p>
                        <p><span style="color: rgb(113,119,125)">Punya akun?</span>
                            <a style="color: rgb(238,77,45)" class="text-decoration-none" href="/login_user">Log in</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


