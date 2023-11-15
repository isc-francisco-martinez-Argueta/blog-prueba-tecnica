<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Listar todos los posts
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    // Obtener un post específico
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado'], 404);
        }

        return response()->json($post);
    }

    // Crear un nuevo post
    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    // Actualizar un post existente
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado para actualizar'], 404);
        }

        $post->update($request->all());

        return response()->json($post);
    }

    // Eliminar un post
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post no encontrado'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post eliminado con éxito']);
    }
}
