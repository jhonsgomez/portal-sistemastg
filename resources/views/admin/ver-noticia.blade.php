@extends('layouts.admin')

@section('title', 'Ver Noticia')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>{{ $noticia->titulo }}</h1>
            <p class="text-muted mb-0">
                <i class="bi bi-calendar me-2"></i>{{ $noticia->fecha->format('d/m/Y') }}
                <span class="mx-2">|</span>
                <i class="bi bi-tag me-2"></i>{{ $noticia->categoria }}
                <span class="mx-2">|</span>
                <span class="badge-status {{ $noticia->estado == 'publicada' ? 'publicada' : 'borrador' }}">
                    {{ ucfirst($noticia->estado) }}
                </span>
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.noticias.editar', $noticia) }}" class="btn-primary-admin">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('admin.noticias') }}" class="btn-secondary-admin">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="form-card">
            <!-- Imagen destacada -->
            @if($noticia->imagen)
                <div class="noticia-imagen-preview mb-4">
                    <img src="{{ asset('images/noticias/' . $noticia->imagen) }}" 
                         alt="{{ $noticia->titulo }}"
                         class="img-fluid rounded"
                         style="max-height: 400px; width: 100%; object-fit: cover;">
                </div>
            @endif

            <!-- Descripción -->
            <div class="mb-4">
                <h4 class="mb-3">Descripción</h4>
                <p class="lead">{{ $noticia->descripcion }}</p>
            </div>

            <!-- Contenido completo -->
            <div>
                <h4 class="mb-3">Contenido</h4>
                <div class="noticia-contenido">
                    {!! nl2br(e($noticia->contenido)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Información -->
        <div class="form-card mb-4">
            <h4 class="mb-3">Información</h4>
            <div class="info-list">
                <div class="info-item">
                    <strong>ID:</strong>
                    <span>#{{ $noticia->id }}</span>
                </div>
                <div class="info-item">
                    <strong>Categoría:</strong>
                    <span>{{ $noticia->categoria }}</span>
                </div>
                <div class="info-item">
                    <strong>Fecha de publicación:</strong>
                    <span>{{ $noticia->fecha->format('d/m/Y') }}</span>
                </div>
                <div class="info-item">
                    <strong>Estado:</strong>
                    <span class="badge-status {{ $noticia->estado == 'publicada' ? 'publicada' : 'borrador' }}">
                        {{ ucfirst($noticia->estado) }}
                    </span>
                </div>
                <div class="info-item">
                    <strong>Creada:</strong>
                    <span>{{ $noticia->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="info-item">
                    <strong>Última actualización:</strong>
                    <span>{{ $noticia->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Acciones -->
        <div class="form-card">
            <h4 class="mb-3">Acciones</h4>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.noticias.editar', $noticia) }}" class="btn-primary-admin">
                    <i class="bi bi-pencil"></i> Editar Noticia
                </a>
                <form action="{{ route('admin.noticias.destroy', $noticia) }}" 
                      method="POST" 
                      onsubmit="return confirm('¿Estás seguro de eliminar esta noticia?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-trash"></i> Eliminar Noticia
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
@endpush