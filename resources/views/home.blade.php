@extends('layouts.app')

@section('title', 'Portal Informativo - Ingeniería de Sistemas UTS')

@section('content')
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-10">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-content">
                    <div class="badge-info mb-4">
                        <i class="bi bi-cpu me-2"></i>Programa de Ingeniería de Sistemas
                    </div>
                    <h1 class="hero-title">Portal Informativo</h1>
                    <h2 class="hero-subtitle">Ingeniería de Sistemas</h2>
                    <p class="hero-description">
                        Mantente informado sobre eventos, noticias y recursos exclusivos para la comunidad
                        de Ingeniería de Sistemas de las Unidades Tecnológicas de Santander.
                    </p>
                    <div class="hero-buttons mt-4 d-flex justify-content-center">
                        <a href="#noticias" class="btn btn-primary-uts">
                            <i class="bi bi-newspaper me-2"></i>Ver Noticias
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="info-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="info-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3><i class="bi bi-info-circle-fill me-2"></i>Portal Informativo de Ingeniería de Sistemas
                            </h3>
                            <p class="mb-0">
                                Este portal está dedicado exclusivamente a estudiantes, docentes y personal asociado al
                                programa de Ingeniería de Sistemas. Encuentra información sobre eventos, proyectos,
                                convocatorias y recursos académicos. El acceso administrativo está disponible en la
                                parte superior.
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="bi bi-code-slash info-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="news-section" id="noticias">
    <div class="container">
        <div class="section-header-news">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1>Noticias Institucionales</h1>
                    <p class="text-muted">Mantente al día con lo que sucede en la facultad</p>
                </div>
            </div>
        </div>

        @php
            // Determinar si $noticias es un array o un paginador
            $esArray = is_array($noticias);
            $noticiasCollection = $esArray ? collect($noticias) : $noticias;
            $totalNoticias = $esArray ? count($noticias) : $noticias->total();
            $countNoticias = $esArray ? count($noticias) : $noticias->count();
        @endphp

        @if($countNoticias > 0)
        <div class="filtros-categorias">
            <div class="d-flex justify-content-center flex-wrap gap-2">
                <button class="btn-categoria active" data-categoria="todas" onclick="filtrarPorCategoria('todas')">
                    <i class="bi bi-grid-3x3-gap me-2"></i>Todas
                    <span class="badge-count">{{ $totalNoticias }}</span>
                </button>
                @php
                if ($esArray) {
                    $categorias = collect($noticias)->pluck('categoria')->unique()->sort()->values();
                    $categoriaCount = collect($noticias)->groupBy('categoria')->map->count();
                } else {
                    $categorias = $noticias->pluck('categoria')->unique()->sort()->values();
                    $categoriaCount = $noticias->groupBy('categoria')->map->count();
                }
                
                $categoriaIcons = [
                    'Actas' => 'calendar-event',
                    'Inscripciones' => 'person-check',
                    'Comité' => 'people',
                    'Estudiantes' => 'mortarboard',
                    'Docentes' => 'book-half',
                    'Investigación' => 'beaker',
                    'Capacitación' => 'journals',
                    'Banco de ideas' => 'lightbulb'
                ];
                @endphp
                @foreach($categorias as $categoria)
                <button class="btn-categoria" data-categoria="{{ $categoria }}"
                    onclick="filtrarPorCategoria('{{ $categoria }}')">
                    <i class="bi bi-{{ $categoriaIcons[$categoria] ?? 'tag' }} me-2"></i>{{ $categoria }}
                    <span class="badge-count">{{ $categoriaCount[$categoria] ?? 0 }}</span>
                </button>
                @endforeach
            </div>
        </div>

        <div class="resultados-info">
            <p class="text-muted text-center">
                Mostrando <strong id="countNoticias">{{ $countNoticias }}</strong> 
                @if(!$esArray && $totalNoticias != $countNoticias)
                    de <strong>{{ $totalNoticias }}</strong>
                @endif
                noticias
                <span id="categoriaActual"></span>
            </p>
        </div>

        <div class="row g-4" id="noticiasContainer">
            @foreach($noticiasCollection as $noticia)
            @php
                $noticiaId = $esArray ? $noticia['id'] : $noticia->id;
                $noticiaCategoria = $esArray ? $noticia['categoria'] : $noticia->categoria;
                $noticiaTitulo = $esArray ? $noticia['titulo'] : $noticia->titulo;
                $noticiaDescripcion = $esArray ? $noticia['descripcion'] : $noticia->descripcion;
                $noticiaImagen = $esArray ? ($noticia['imagen'] ?? null) : $noticia->imagen;
                $noticiaFecha = $esArray ? $noticia['fecha'] : \Carbon\Carbon::parse($noticia->fecha_publicacion)->format('d/m/Y');
            @endphp
            <div class="col-lg-4 col-md-6 noticia-item" data-categoria="{{ $noticiaCategoria }}">
                <div class="noticia-card" data-noticia-id="{{ $noticiaId }}">
                    <div class="noticia-imagen">
                        @if($esArray)
                            <img src="{{ asset('images/noticias/' . $noticiaImagen) }}" 
                                 alt="{{ $noticiaTitulo }}"
                                 onerror="this.src='{{ asset('images/placeholder-noticia.jpg') }}'">
                        @else
                            <img src="{{ $noticiaImagen ? asset('storage/' . $noticiaImagen) : asset('images/placeholder-noticia.jpg') }}" 
                                 alt="{{ $noticiaTitulo }}"
                                 onerror="this.src='{{ asset('images/placeholder-noticia.jpg') }}'">
                        @endif
                        <div class="noticia-categoria">{{ $noticiaCategoria }}</div>
                    </div>
                    <div class="noticia-content">
                        <div class="noticia-meta">
                            <span class="noticia-tag">Noticias</span>
                            <span class="noticia-fecha">
                                <i class="bi bi-clock"></i> {{ $noticiaFecha }}
                            </span>
                        </div>
                        <h3 class="noticia-titulo">{{ $noticiaTitulo }}</h3>
                        <p class="noticia-descripcion">{{ Str::limit($noticiaDescripcion, 120) }}</p>
                        <a href="#" class="noticia-link" onclick="abrirNoticiaExpandida(event, {{ $noticiaId }})">
                            Leer más <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="no-resultados" id="noResultados" style="display: none;">
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: var(--uts-gray);"></i>
                <h3 class="mt-3">No se encontraron noticias</h3>
                <p class="text-muted">No hay noticias disponibles en esta categoría</p>
                <button class="btn btn-primary-uts mt-3" onclick="filtrarPorCategoria('todas')">
                    <i class="bi bi-arrow-left me-2"></i>Ver todas las noticias
                </button>
            </div>
        </div>

        @if(!$esArray && $noticias->hasPages())
        <div class="pagination-wrapper mt-5">
            <nav>
                <ul class="pagination justify-content-center">
                    {{-- Botón Anterior --}}
                    @if($noticias->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link"><i class="bi bi-chevron-left"></i> Anterior</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $noticias->previousPageUrl() }}" rel="prev">
                                <i class="bi bi-chevron-left"></i> Anterior
                            </a>
                        </li>
                    @endif

                    @foreach($noticias->getUrlRange(1, $noticias->lastPage()) as $page => $url)
                        @if($page == $noticias->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    @if($noticias->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $noticias->nextPageUrl() }}" rel="next">
                                Siguiente <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Siguiente <i class="bi bi-chevron-right"></i></span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif

        @else
        <div class="text-center py-5">
            <i class="bi bi-inbox" style="font-size: 4rem; color: var(--uts-gray);"></i>
            <h3 class="mt-3">No hay noticias publicadas</h3>
            <p class="text-muted">Aún no se han publicado noticias. Vuelve pronto para ver las novedades.</p>
        </div>
        @endif
    </div>
</section>

<div class="noticia-modal-overlay" id="noticiaModal" onclick="cerrarNoticiaExpandida(event)">
    <div class="noticia-modal-container">
        <button class="noticia-modal-close" onclick="cerrarNoticiaExpandida(event)">
            <i class="bi bi-x-lg"></i>
        </button>
        <div class="noticia-modal-content">
            <div class="noticia-modal-imagen">
                <img id="modalImagen" src="" alt="">
                <div class="noticia-modal-categoria" id="modalCategoria"></div>
            </div>
            <div class="noticia-modal-body">
                <div class="noticia-modal-meta">
                    <span class="noticia-tag">Noticias</span>
                    <span class="noticia-fecha">
                        <i class="bi bi-clock"></i> <span id="modalFecha"></span>
                    </span>
                </div>
                <h2 class="noticia-modal-titulo" id="modalTitulo"></h2>
                <div class="noticia-modal-descripcion" id="modalDescripcion"></div>
                <div class="noticia-modal-contenido" id="modalContenido"></div>
            </div>
        </div>
    </div>
</div>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <i class="bi bi-code-slash mb-3" style="font-size: 3rem; color: var(--uts-green);"></i>
            <h2>¿Quieres conocer más sobre Ingeniería de Sistemas?</h2>
            <p>Explora nuestra oferta académica, proyectos destacados y oportunidades</p>
            <a href="https://www.uts.edu.co/sitio" target="_blank" class="btn btn-cta">
                <i class="bi bi-arrow-right-circle me-2"></i>Visitar sitio oficial UTS
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@push('scripts')
<script>

const noticiasData = @json(
    is_array($noticias) 
        ? collect($noticias)->keyBy('id')->toArray() 
        : $noticias->keyBy('id')->toArray()
);
const esArray = @json(is_array($noticias));

function filtrarPorCategoria(categoria) {
    console.log('Filtrando por categoría:', categoria);

    const noticias = document.querySelectorAll('.noticia-item');
    const botones = document.querySelectorAll('.btn-categoria');
    const countElement = document.getElementById('countNoticias');
    const categoriaActualElement = document.getElementById('categoriaActual');
    const noResultados = document.getElementById('noResultados');
    const noticiasContainer = document.getElementById('noticiasContainer');

    let count = 0;

    botones.forEach(btn => {
        btn.classList.remove('active');
        if (btn.dataset.categoria === categoria) {
            btn.classList.add('active');
        }
    });

    noticias.forEach(noticia => {
        const categoriaNoticia = noticia.dataset.categoria;

        if (categoria === 'todas' || categoriaNoticia === categoria) {
            noticia.style.display = 'block';
            noticia.classList.remove('ocultar');
            noticia.classList.add('mostrar');
            count++;

            setTimeout(() => {
                noticia.style.opacity = '1';
                noticia.style.transform = 'scale(1)';
            }, 10);
        } else {
            noticia.classList.add('ocultar');
            noticia.classList.remove('mostrar');
            noticia.style.opacity = '0';
            noticia.style.transform = 'scale(0.9)';

            setTimeout(() => {
                noticia.style.display = 'none';
            }, 400);
        }
    });

    countElement.textContent = count;

    if (categoria === 'todas') {
        categoriaActualElement.textContent = '';
    } else {
        categoriaActualElement.textContent = `en la categoría "${categoria}"`;
    }

    if (count === 0) {
        noResultados.style.display = 'block';
        noticiasContainer.style.display = 'none';
    } else {
        noResultados.style.display = 'none';
        noticiasContainer.style.display = 'flex';
    }
}

function abrirNoticiaExpandida(event, noticiaId) {
    event.preventDefault();

    const card = event.target.closest('.noticia-card');
    card.classList.add('expanding');

    // Buscar la noticia por ID
    const noticia = noticiasData[noticiaId];
    
    if (!noticia) {
        console.error('Noticia no encontrada:', noticiaId);
        return;
    }

    let imagenUrl;
    if (esArray) {
        imagenUrl = noticia.imagen 
            ? `{{ asset('images/noticias') }}/${noticia.imagen}` 
            : '{{ asset('images/placeholder-noticia.jpg') }}';
    } else {
        imagenUrl = noticia.imagen 
            ? `{{ asset('storage') }}/${noticia.imagen}` 
            : '{{ asset('images/placeholder-noticia.jpg') }}';
    }

    document.getElementById('modalImagen').src = imagenUrl;
    document.getElementById('modalCategoria').textContent = noticia.categoria;
    
    let fechaFormateada;
    if (esArray) {
        fechaFormateada = noticia.fecha;
    } else {
        fechaFormateada = new Date(noticia.fecha_publicacion).toLocaleDateString('es-ES');
    }
    document.getElementById('modalFecha').textContent = fechaFormateada;
    
    document.getElementById('modalTitulo').textContent = noticia.titulo;
    document.getElementById('modalDescripcion').textContent = noticia.descripcion;

    const contenidoCompleto = (esArray ? noticia.contenido_completo : noticia.contenido) || `
        <p>Contenido no disponible en este momento. Por favor, contacta con la administración para más información.</p>
    `;

    document.getElementById('modalContenido').innerHTML = contenidoCompleto;

    setTimeout(() => {
        const modal = document.getElementById('noticiaModal');
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }, 200);

    setTimeout(() => {
        card.classList.remove('expanding');
    }, 400);
}

function cerrarNoticiaExpandida(event) {
    if (event.target === event.currentTarget || event.target.closest('.noticia-modal-close')) {
        const modal = document.getElementById('noticiaModal');
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
}

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modal = document.getElementById('noticiaModal');
        if (modal.classList.contains('active')) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const categoria = urlParams.get('categoria');

    if (categoria) {
        filtrarPorCategoria(categoria);
    }
});
</script>
@endpush