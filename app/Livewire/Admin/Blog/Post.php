<?php

namespace App\Livewire\Admin\Blog;

use App\Models\Post as ModelsPost;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;

class Post extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = "", $pagination, $paginations;
    public $post_id, $title, $author, $content, $user_id, $created_at;

    public function messages()
    {
        return [
            'title.required' => 'Titulo es requerido.',
            'author.required' => 'Autor es requerido.',
            'content.required' => 'Contenido es requerido.',
        ];
    }
    public function mount()
    {
        $this->user_id = Auth()->user()->id;
        // dd($this->user_id);
        $this->pagination = 10;
        $this->paginations = [10, 15, 20, 30, 50];
    }
    public function updatingPagination()
    {
        $this->resetPage();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function create()
    {
        $this->resetInputFields();
        $this->dispatch('abrirModal');
    }

    public function store()
    {

        $validated = $this->validate([
            'user_id' => 'required',
            'title' => 'required|min:3',
            'author' => 'required|min:3',
            'content' => 'required|min:3',
        ]);


        ModelsPost::create($validated);
        $this->dispatch('cerrarModal');
        $this->dispatch('store-message');
    }

    public function show($id)
    {
        $this->resetInputFields();
        $post               = ModelsPost::where('id', '=', $id)->first();
        $this->post_id      = $id;
        $this->title         = $post->title;
        $this->author        = $post->author;
        $this->content       = $post->content;
        $this->created_at       = $post->created_at->diffForHumans();

        $this->dispatch('showAbrirModal');
    }

    public function edit($id)
    {
        $this->resetInputFields();

        $post               = ModelsPost::where('id', '=', $id)->first();
        $this->post_id      = $id;
        $this->title         = $post->title;
        $this->author        = $post->author;
        $this->content  = $post->content;

        $this->dispatch('abrirModal');
    }
    public function update()
    {
        $validated = $this->validate([
            'user_id' => 'required',
            'title' => 'required|min:3',
            'author' => 'required|min:3',
            'content' => 'required|min:3',
        ]);

        $post = ModelsPost::findOrFail($this->post_id);
        $post->update($validated);
        $this->dispatch('cerrarModal');
        $this->dispatch('update-message');
    }


    #[On('post-destroy')]
    public function destroy($id)
    {
        ModelsPost::destroy($id);
    }

    private function resetInputFields()
    {
        $this->post_id                   = '';
        $this->title                     = '';
        $this->author                    = '';
        $this->content                 = '';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cancel()
    {
        $this->resetInputFields();
    }


    public function render()
    {
        $posts = new ModelsPost();

        if (!is_null($this->search) && !empty($this->search)) {

            $posts = $posts->where(function ($q) {
                $q->where('title', 'LIKE', "%{$this->search}%")
                    ->orWhere('content', 'LIKE', "%{$this->search}%")
                    ->orWhere('author', 'LIKE', "%{$this->search}%");
            });
        }

        $posts = $posts->orderBy('id', 'DESC')
            ->paginate($this->pagination);

        return view('livewire.admin.blog.post', [
            'posts' => $posts
        ]);
    }
}
