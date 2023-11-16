<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends BaseController
{
    // Listar todos los posts
    public function index() : JsonResponse
    {
        $posts = Post::all();
        return $this->sendResponse($posts, 'Posts retrieved successfully.');

    }

    // Obtener un post específico
    public function show($id) : JsonResponse
    {
        $post = Post::find($id);

        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }

        return $this->sendResponse($post, 'Post retrieved successfully.');
    }

    // Crear un nuevo post
    public function store(Request $request) : JsonResponse
    {
        $validatedData = Validator::make($request->all(),[
            'user_id' => 'required',
            'title' => 'required',
            'author' => 'required',
            'content' => 'required',
        ]);

        if($validatedData->fails()){
            return $this->sendError('Validation Error.', $validatedData->errors());
        }

        $post = Post::create($request->all());
        return $this->sendResponse($post, 'Post created successfully.', 201);

    }



    // Actualizar un post existente
    public function update(Request $request, $id) : JsonResponse
    {
        $post = Post::findOrFail($id);

        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }

        $validatedData = Validator::make($request->all(),[
            'user_id' => 'required',
            'title' => 'required',
            'author' => 'required',
            'content' => 'required',
        ]);

        if($validatedData->fails()){
            return $this->sendError('Validation Error.', $validatedData->errors());
        }


        $post->update($validatedData);
        return $this->sendResponse($post, 'Post updated successfully.');

    }

    // Eliminar un post
    public function destroy($id)
    {
        $post = Post::find($id);

        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }

        $post->delete();

        return $this->sendResponse([], 'Post deleted successfully.');
    }

}
