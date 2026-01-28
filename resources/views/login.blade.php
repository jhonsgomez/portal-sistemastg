@extends('layouts.app')

@section('title', 'Iniciar Sesión - UTS')
@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<section class="login-section">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-80">
            <div class="col-lg-10">
                <div class="login-wrapper">
                    <div class="row g-0">
                        <div class="col-lg-6 login-info-side">
                            <div class="info-content">
                                <div class="logo-section mb-4">
                                    <img src="{{ asset('images/logo-uts.png') }}" alt="UTS Logo" class="login-logo">
                                </div>

                                <h2 class="info-title">Portal Administrativo y Docente</h2>
                                <div class="back-link mt-5">
                                    <a href="{{ route('home') }}">
                                        <i class="bi bi-arrow-left me-2"></i>Volver al portal informativo
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 login-form-side">
                            <div class="form-content">
                                <div class="form-header">
                                    <h3>Iniciar Sesión</h3>
                                </div>

                                {{-- Mensajes de error/éxito --}}
                                @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                                @endif

                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                                @endif

                                <form class="login-form" id="loginForm" method="POST" action="{{ route('login.post') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">
                                            <i class="bi bi-person me-2"></i>Usuario
                                        </label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Ingresa tu usuario" value="{{ old('username') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">
                                            <i class="bi bi-lock me-2"></i>Contraseña
                                        </label>
                                        <div class="password-wrapper">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Ingresa tu contraseña" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-login">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>
                                        Iniciar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endpush