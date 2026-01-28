@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1>Dashboard</h1>
    <p>Bienvenido al panel de administración</p>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="data-table-wrapper">
            <div class="table-header">
                <h3>Noticias Recientes</h3>
                <a href="{{ route('admin.noticias') }}" class="btn-secondary-admin">Ver todas</a>
            </div>
            <div class="table-responsive">
                @if($noticiasRecientes->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Categoría</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($noticiasRecientes as $noticia)
                                <tr>
                                    <td><strong>{{ $noticia->titulo }}</strong></td>
                                    <td>{{ $noticia->categoria }}</td>
                                    <td>{{ $noticia->fecha->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge-status {{ $noticia->estado == 'publicada' ? 'publicada' : 'borrador' }}">
                                            {{ ucfirst($noticia->estado) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div style="padding: 3rem; text-align: center;">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: var(--uts-gray); opacity: 0.3;"></i>
                        <h4 class="mt-3" style="color: var(--uts-gray);">No hay noticias aún</h4>
                        <p class="text-muted">Comienza creando tu primera noticia</p>
                        <a href="{{ route('admin.noticias.crear') }}" class="btn-primary-admin mt-3">
                            <i class="bi bi-plus-circle"></i>
                            Crear Primera Noticia
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="data-table-wrapper">
            <div class="table-header">
                <h3>Acciones Rápidas</h3>
            </div>
            <div style="padding: 1.5rem;">
                <div class="d-grid gap-3">
                    <a href="{{ route('admin.noticias.crear') }}" class="btn-primary-admin">
                        <i class="bi bi-plus-circle"></i>
                        Nueva Noticia
                    </a>
                    <a href="{{ route('admin.noticias') }}" class="btn-secondary-admin">
                        <i class="bi bi-newspaper"></i>
                        Gestionar Noticias ({{ $stats['total_noticias'] }})
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
@endpush