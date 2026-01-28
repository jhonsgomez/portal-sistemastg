@extends('layouts.admin')

@section('title', 'Nueva Noticia')

@section('content')
<div class="page-header">
    <h1>Nueva Noticia</h1>
    <p>Crea una nueva noticia para la facultad de Ingeniería de Sistemas</p>
</div>

<form id="noticiaForm" method="POST" action="{{ route('admin.noticias.store') }}" enctype="multipart/form-data">
    @csrf
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
                        value="{{ old('titulo') }}"
                        placeholder="Escribe el título de la noticia"
                        required
                    >
                    @error('titulo')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group-admin">
                    <label for="categoria">Categoría *</label>
                    <select class="form-control-admin @error('categoria') is-invalid @enderror" id="categoria" name="categoria" required>
                        <option value="">Selecciona una categoría</option>
                        <option value="Actas" {{ old('categoria') == 'Actas' ? 'selected' : '' }}>Actas</option>
                        <option value="Inscripciones" {{ old('categoria') == 'Inscripciones' ? 'selected' : '' }}>Inscripciones</option>
                        <option value="Comité" {{ old('categoria') == 'Comité' ? 'selected' : '' }}>Comité</option>
                        <option value="Estudiantes" {{ old('categoria') == 'Estudiantes' ? 'selected' : '' }}>Estudiantes </option>
                        <option value="Docentes" {{ old('categoria') == 'Docentes' ? 'selected' : '' }}>Docentes </option>
                        <option value="Investigación" {{ old('categoria') == 'Investigación' ? 'selected' : '' }}>Investigación</option>
                        <option value="Capacitación" {{ old('categoria') == 'Capacitación' ? 'selected' : '' }}>Capacitación</option>
                        <option value="Banco de ideas" {{ old('categoria') == 'Banco de ideas' ? 'selected' : '' }}>Banco de ideas</option>
                    </select>
                    @error('categoria')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group-admin">
                    <label for="descripcion">Descripción Corta *</label>
                    <textarea 
                        class="form-control-admin @error('descripcion') is-invalid @enderror" 
                        id="descripcion"
                        name="descripcion"
                        rows="3"
                        placeholder="Escribe una descripción breve que aparecerá en las tarjetas"
                        required
                    >{{ old('descripcion') }}</textarea>
                    <small class="text-muted">Máximo 200 caracteres</small>
                    @error('descripcion')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group-admin">
                    <label for="contenido">Contenido Completo *</label>
                    <textarea 
                        class="form-control-admin @error('contenido') is-invalid @enderror" 
                        id="contenido"
                        name="contenido"
                        rows="10"
                        placeholder="Escribe el contenido completo de la noticia"
                        required
                    >{{ old('contenido') }}</textarea>
                    <small class="text-muted">Puedes usar formato Markdown</small>
                    @error('contenido')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-card mb-4">
                <h3 class="mb-4">Publicación</h3>
                <div class="form-group-admin">
                    <label for="fecha">Fecha de Publicación</label>
                    <input 
                        type="date" 
                        class="form-control-admin @error('fecha') is-invalid @enderror" 
                        id="fecha"
                        name="fecha"
                        value="{{ old('fecha', date('Y-m-d')) }}"
                    >
                    @error('fecha')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group-admin">
                    <label for="estado">Estado</label>
                    <select class="form-control-admin @error('estado') is-invalid @enderror" id="estado" name="estado">
                        <option value="borrador" {{ old('estado') == 'borrador' ? 'selected' : '' }}>Borrador</option>
                        <option value="publicada" {{ old('estado') == 'publicada' ? 'selected' : '' }}>Publicar</option>
                    </select>
                    @error('estado')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn-primary-admin">
                        <i class="bi bi-check-circle"></i>
                        Guardar Noticia
                    </button>
                    <a href="{{ route('admin.noticias') }}" class="btn-secondary-admin">
                        <i class="bi bi-x-circle"></i>
                        Cancelar
                    </a>
                </div>
            </div>

            <div class="form-card">
                <h3 class="mb-4">Imagen Destacada</h3>
                
                <div class="form-group-admin">
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
<script>
    document
    .getElementById("fileUploadArea")
    .addEventListener("click", function () {
        document.getElementById("imagen").click();
    });

function previewImage(event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("previewImg").src = e.target.result;
            document.getElementById("imagePreview").style.display = "block";
            document.getElementById("fileUploadArea").style.display = "none";
        };

        reader.readAsDataURL(file);
    }
}

// LIMPIAR LA IMAGEN SELECCIONADA
function removeImage() {
    document.getElementById("imagen").value = "";
    document.getElementById("imagePreview").style.display = "none";
    document.getElementById("fileUploadArea").style.display = "block";
}

const uploadArea = document.getElementById("fileUploadArea");

// PREVIENE EL COMPORTAMIENTO POR DEFECTO DEL NAVEGADOR
["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
    uploadArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

// EFECTOS VISUAL CUANDO ARRASTRAS UN ARCHIVO SOBRE EL ÁREA
["dragenter", "dragover"].forEach((eventName) => {
    uploadArea.addEventListener(eventName, () => {
        uploadArea.style.borderColor = "var(--uts-blue)";
        uploadArea.style.backgroundColor = "#f8f9fa";
    });
});

["dragleave", "drop"].forEach((eventName) => {
    uploadArea.addEventListener(eventName, () => {
        uploadArea.style.borderColor = "#e0e0e0";
        uploadArea.style.backgroundColor = "transparent";
    });
});

// PROCESA EL ARCHIVO CUANDO EL USUARIO LO SUELTA
uploadArea.addEventListener("drop", function (e) {
    const dt = e.dataTransfer;
    const files = dt.files;

    if (files.length) {
        document.getElementById("imagen").files = files;
        previewImage({ target: { files: files } });
    }
});

// SUBMIT DEL FORMULARIO
document.getElementById("noticiaForm").addEventListener("submit", function (e) {
    const descripcion = document.getElementById("descripcion").value;
    if (descripcion.length > 200) {
        e.preventDefault();
        alert("La descripción no puede tener más de 200 caracteres");
        return false;
    }

    return true;
});

document.getElementById("descripcion").addEventListener("input", function () {
    const maxLength = 200;
    const currentLength = this.value.length;

    if (currentLength > maxLength) {
        this.value = this.value.substring(0, maxLength);
    }
});

</script>

@endsection

@push('scripts')

@endpush