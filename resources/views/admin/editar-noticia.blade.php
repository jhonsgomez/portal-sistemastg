@extends('layouts.admin')

@section('title', 'Editar Noticia')

@section('content')
<div class="page-header">
    <h1>Editar Noticia</h1>
    <p>Modifica la información de la noticia</p>
</div>

<form method="POST" action="{{ route('admin.noticias.update', $noticia) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="form-card">
                <h3 class="mb-4">Información de la Noticia</h3>
                <div class="form-group-admin">
                    <label for="titulo">Título *</label>
                    <input 
                        type="text" 
                        class="form-control-admin @error('titulo') is-invalid @enderror" 
                        id="titulo"
                        name="titulo"
                        value="{{ old('titulo', $noticia->titulo) }}"
                        required
                    >
                    @error('titulo')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Categoría -->
                <div class="form-group-admin">
                    <label for="categoria">Categoría *</label>
                    <select class="form-control-admin @error('categoria') is-invalid @enderror" id="categoria" name="categoria" required>
                        <option value="">Selecciona una categoría</option>
                        <option value="Actas" {{ old('categoria', $noticia->categoria) == 'Actas' ? 'selected' : '' }}>Actas</option>
                        <option value="Inscripciones" {{ old('categoria', $noticia->categoria) == 'Inscripciones' ? 'selected' : '' }}>Inscripciones</option>
                        <option value="Comité" {{ old('categoria', $noticia->categoria) == 'Comité' ? 'selected' : '' }}>Comité</option>
                        <option value="Estudiantes" {{ old('categoria', $noticia->categoria) == 'Estudiantes' ? 'selected' : '' }}>Estudiantes</option>
                        <option value="Docentes" {{ old('categoria', $noticia->categoria) == 'Docentes' ? 'selected' : '' }}>Docentes</option>
                        <option value="Investigación" {{ old('categoria', $noticia->categoria) == 'Investigación' ? 'selected' : '' }}>Investigación</option>
                        <option value="Capacitación" {{ old('categoria', $noticia->categoria) == 'Capacitación' ? 'selected' : '' }}>Capacitación</option>
                        <option value="Banco de ideas" {{ old('categoria', $noticia->categoria) == 'Banco de ideas' ? 'selected' : '' }}>Banco de ideas</option>
                    </select>
                    @error('categoria')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Descripción Corta -->
                <div class="form-group-admin">
                    <label for="descripcion">Descripción Corta *</label>
                    <textarea 
                        class="form-control-admin @error('descripcion') is-invalid @enderror" 
                        id="descripcion"
                        name="descripcion"
                        rows="3"
                        required
                    >{{ old('descripcion', $noticia->descripcion) }}</textarea>
                    <small class="text-muted">Máximo 200 caracteres</small>
                    @error('descripcion')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contenido Completo -->
                <div class="form-group-admin">
                    <label for="contenido">Contenido Completo *</label>
                    <textarea 
                        class="form-control-admin @error('contenido') is-invalid @enderror" 
                        id="contenido"
                        name="contenido"
                        rows="10"
                        required
                    >{{ old('contenido', $noticia->contenido) }}</textarea>
                    @error('contenido')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-card mb-4">
                <h3 class="mb-4">Publicación</h3>
                <!-- Fecha -->
                <div class="form-group-admin">
                    <label for="fecha">Fecha de Publicación</label>
                    <input 
                        type="date" 
                        class="form-control-admin @error('fecha') is-invalid @enderror" 
                        id="fecha"
                        name="fecha"
                        value="{{ old('fecha', $noticia->fecha->format('Y-m-d')) }}"
                    >
                    @error('fecha')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Estado -->
                <div class="form-group-admin">
                    <label for="estado">Estado</label>
                    <select class="form-control-admin @error('estado') is-invalid @enderror" id="estado" name="estado">
                        <option value="borrador" {{ old('estado', $noticia->estado) == 'borrador' ? 'selected' : '' }}>Borrador</option>
                        <option value="publicada" {{ old('estado', $noticia->estado) == 'publicada' ? 'selected' : '' }}>Publicar</option>
                    </select>
                    @error('estado')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botones de Acción -->
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn-primary-admin">
                        <i class="bi bi-check-circle"></i>
                        Actualizar Noticia
                    </button>
                    <a href="{{ route('admin.noticias') }}" class="btn-secondary-admin">
                        <i class="bi bi-x-circle"></i>
                        Cancelar
                    </a>
                </div>
            </div>

            <!-- Imagen Destacada -->
            <div class="form-card">
                <h3 class="mb-4">Imagen Destacada</h3>
                
                <!-- Imagen actual -->
                @if($noticia->imagen)
                    <div class="mb-3">
                        <p class="small text-muted mb-2">Imagen actual:</p>
                        <img src="{{ asset('images/noticias/' . $noticia->imagen) }}" 
                             alt="{{ $noticia->titulo }}"
                             class="img-fluid rounded"
                             id="imagenActual">
                        <button type="button" class="btn btn-sm btn-danger mt-2 w-100" onclick="confirmarEliminarImagen()">
                            <i class="bi bi-trash"></i> Cambiar imagen
                        </button>
                    </div>
                @endif

                <div class="form-group-admin" id="uploadArea" style="{{ $noticia->imagen ? 'display:none;' : '' }}">
                    <div class="file-upload" id="fileUploadArea">
                        <input 
                            type="file" 
                            id="imagen"
                            name="imagen"
                            accept="image/*" 
                            style="display: none;"
                            onchange="previewImage(event)"
                        >
                        <i class="bi bi-cloud-upload"></i>
                        <p class="mb-2"><strong>Click para subir imagen</strong></p>
                        <p class="text-muted small mb-0">o arrastra y suelta aquí</p>
                        <p class="text-muted small">PNG, JPG o WEBP (Máx. 5MB)</p>
                    </div>
                    
                    @error('imagen')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror

                    <div id="imagePreview" style="display: none; margin-top: 1rem;">
                        <img id="previewImg" src="" alt="Preview" style="width: 100%; border-radius: 10px;">
                        <button type="button" class="btn-secondary-admin mt-2 w-100" onclick="removeImage()">
                            <i class="bi bi-trash"></i> Eliminar imagen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('scripts')
@endpush