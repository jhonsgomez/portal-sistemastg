<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    // Muestra la lista de noticias con filtros de búsqueda, estado y paginación
    public function index(Request $request)
    {
        $query = Noticia::query();

        if ($request->has('busqueda') && $request->busqueda != '') {
            $busqueda = $request->busqueda;
            $query->where(function($q) use ($busqueda) {
                $q->where('titulo', 'like', "%{$busqueda}%")
                  ->orWhere('categoria', 'like', "%{$busqueda}%");
            });
        }

        if ($request->has('estado') && $request->estado != 'todas') {
            $query->where('estado', $request->estado);
        }

        $query->orderBy('fecha', 'desc');

        $noticias = $query->paginate(6)->withQueryString();

        return view('admin.noticias', [
            'noticias' => $noticias,
            'busqueda' => $request->busqueda ?? '',
            'estadoFiltro' => $request->estado ?? 'todas',
        ]);
    }

    // Muestra el formulario de creación de una nueva noticia
    public function create()
    {
        return view('admin.crear-noticia');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'categoria' => 'required',
            'descripcion' => 'required|max:200',
            'contenido' => 'required',
            'fecha' => 'required|date',
            'estado' => 'required|in:borrador,publicada',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', 
        ], [
            'titulo.required' => 'El título es obligatorio',
            'categoria.required' => 'La categoría es obligatoria',
            'descripcion.required' => 'La descripción es obligatoria',
            'descripcion.max' => 'La descripción no puede tener más de 200 caracteres',
            'contenido.required' => 'El contenido es obligatorio',
            'fecha.required' => 'La fecha es obligatoria',
            'imagen.image' => 'El archivo debe ser una imagen',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o webp',
            'imagen.max' => 'La imagen no puede pesar más de 5MB',
        ]);

        // Guarda la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images/noticias'), $nombreImagen);
            $validated['imagen'] = $nombreImagen;
        }

        Noticia::create($validated);

        return redirect()->route('admin.noticias')
            ->with('success', '¡Noticia creada exitosamente!');
    }

    public function show(Noticia $noticia)
    {
        return view('admin.ver-noticia', compact('noticia'));
    }

    public function edit(Noticia $noticia)
    {
        return view('admin.editar-noticia', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'categoria' => 'required',
            'descripcion' => 'required|max:200',
            'contenido' => 'required',
            'fecha' => 'required|date',
            'estado' => 'required|in:borrador,publicada',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Si se sube una nueva imagen, elimina la anterior y guarda la nueva
        if ($request->hasFile('imagen')) {
            if ($noticia->imagen && file_exists(public_path('images/noticias/' . $noticia->imagen))) {
                unlink(public_path('images/noticias/' . $noticia->imagen));
            }

            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images/noticias'), $nombreImagen);
            $validated['imagen'] = $nombreImagen;
        }

        $noticia->update($validated);

        return redirect()->route('admin.noticias')
            ->with('success', '¡Noticia actualizada exitosamente!');
    }

    // Elimina una noticia y su imagen asociada
    public function destroy(Noticia $noticia)
    {
        if ($noticia->imagen && file_exists(public_path('images/noticias/' . $noticia->imagen))) {
            unlink(public_path('images/noticias/' . $noticia->imagen));
        }

        $noticia->delete();

        return redirect()->route('admin.noticias')
            ->with('success', '¡Noticia eliminada exitosamente!');
    }
}
