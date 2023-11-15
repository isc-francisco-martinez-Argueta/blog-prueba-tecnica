<?php

namespace App\Livewire\Admin\Blog;

use App\Models\Post as ModelsPost;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class Post extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search="", $pagination, $paginations;
    public $title, $author, $content, $user_id;
    // protected $listeners =['destroy'];

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
        $this->user_id= Auth()->user()->id;
        // dd($this->user_id);
        $this->pagination = 10;
        $this->paginations = [10, 15, 20, 30, 50];
    }
    public function updatingPagination(){
        $this->resetPage();
    }
    public function updatingSearch(){
        $this->resetPage();
    }


    public function create(){
        $this->resetInputFields();
        $this->dispatch('view-modal', true);
    }
    public function save()
    {
        $validated = $this->validate([
            'user_id' => 'required',
            'title' => 'required|min:3',
            'author' => 'required|min:3',
            'content' => 'required|min:3',
        ]);
        // dd($this->title, $this->author, $this->content);

        ModelsPost::create($validated);
        $this->dispatch('view-modal', false);

        // return redirect()->to('/posts');

    }

    public function edit(ModelsPost $post){

        // $this->permissions_id = $mypermissions;
        // $this->role_id = $role->id;
        // $this->name = $role->name;
        // $this->emit('editRole');
    }


    #[On('post-destroy')]
    public function destroy($id){
        ModelsPost::destroy($id);
    }

    private function resetInputFields(){
        $this->user_id                  = '';
        $this->title                     = '';
        $this->author                    = '';
        $this->content                 = '';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cancel(){
        $this->resetInputFields();
    }


    public function render()
    {
        $posts = new ModelsPost();

        if (! is_null( $this->search ) && ! empty($this->search)) {

            $posts = $posts->where(function ($q) {
                $q->where('title', 'LIKE', "%{$this->search}%")
                    ->orWhere('content', 'LIKE', "%{$this->search}%")
                    ->orWhere('author', 'LIKE', "%{$this->search}%");
            });
        }

        $posts = $posts->orderBy('id','DESC')
            ->paginate($this->pagination);

        return view('livewire.admin.blog.post', [
            'posts' => $posts
        ]);
    }
}
