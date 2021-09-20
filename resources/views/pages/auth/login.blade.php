@extends('layouts.auth.auth')

@section('title', 'Connexion - ' . config('app.name'))

@section('content')
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <h3 class="card-title text-left mb-5 h2">Connexion</h3>
                        <form method="POST" action="{{ route('auth.login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Email *</label>
                                        <input id="email" type="email" name="email" class="form-control rounded p_input">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Mot de passe *</label>
                                        <input id="password" type="password" name="password"
                                            class="form-control rounded p_input">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4 d-flex align-items-center justify-content-between">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input"> Souvenez-vous de moi
                                            </label>
                                        </div>
                                        {{-- <a href="{{ route('password.request') }}" class="forgot-pass">Forgot
                                    password</a> --}}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col">
                                            <button class="btn btn-facebook w-100">
                                                <i class="mdi mdi-facebook"></i> Facebook </button>
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-google w-100">
                                                <i class="mdi mdi-google-plus"></i> Google plus </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="sign-up">Don't have an Account?<a href="{{ route('register') }}">
                                    Sign Up</a></p> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
