@extends('MainLayoutLoginRegistration.Main')

@section('content')
    <div class="sign-up container-fluid">
        <div class="form-sign-up row mx-auto">
            <div class="col-2 col-sm-7">

            </div>
            <div class="col-10 col-sm-5 d-grid align-items-center">
                <form action="/sign_user" method="post" class="bg-white p-3 rounded-2">
                    @csrf
                    <h3 class="mb-3">Log In Pengguna</h3>

                    <div class="mb-3">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="username" name="username" value="{{ old('username') }}">
                        @error('username')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
                        @error('password')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary border-0 rounded-0 button-sign-up">Log In</button>
                    <div class="text-center mt-3">
                        <p><span style="color: rgb(113,119,125)">Baru di Shopee?</span>
                            <a style="color: rgb(238,77,45)" class="text-decoration-none" href="/registration_user">Daftar</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
