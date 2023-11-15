<div>
    <div class="d-flex justify-content-between pb-2">
        <h3>Listado de post</h3>
        <button wire:click="create" type="button" class="btn btn-primary" >
            Nuevo post
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-md-9 pb-3">
                    <input class="form-control" placeholder="Buscar post" wire:model.live="search">
                </div>
                <div wire:ignore class="col-5 col-md-3 pb-3">
                    <select class=" form-control" title="Paginación" data-header="Seleccione paginación"
                        wire:model.live="pagination">
                        @foreach ($paginations as $pag)
                        <option value="{{ $pag }}" {{ $pagination==$pag ? 'selected' : '' }}>{{ $pag }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Contenido</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($posts)
                    @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->author}}</td>
                        <td>{{ \Illuminate\Support\Str::limit( $post->content, $limit = 70, $end = '...') }}</td>
                        <td>
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <a class="btn btn-light shadow p-2">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a class="btn btn-warning shadow p-2">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button class="btn btn-danger shadow p-2" type="button" wire:click="$dispatch('delete', { postId: {{ $post->id}} })">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    @else
                    <tr class="text-center">
                        <td colspan="12" class="table-secondary">Datos no encontrados.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-fooder">
            {{ $posts->links() }}
        </div>
    </div>














    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="postModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header  ">
                    <h1 class="modal-title fs-5" id="postModalLabel">Crear post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Titulo</label>
                            <input type="text" class="form-control" wire:model="title" placeholder="Escribe un titulo" >
                            <div>@error('title') <span class="text-danger">{{ $message }}</span>  @enderror</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Autor</label>
                            <input type="text" class="form-control" wire:model="author" placeholder="Escribe un autor">
                            <div>@error('author') <span class="text-danger">{{ $message }}</span>  @enderror</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Contenido</label>
                            <textarea class="form-control" wire:model="content" rows="3"
                            placeholder="Describe el contenido"></textarea>
                            <div>@error('content') <span class="text-danger">{{ $message }}</span>  @enderror</div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>









    <script type="module">

        document.addEventListener('livewire:init', () => {

            Livewire.on('delete', ({ postId }) => {
                Swal.fire({
                    title: '¿Desea eliminar?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, ¡Eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.dispatch('post-destroy', {id: postId});
                        Swal.fire(
                            '¡Eliminado!',
                            'Post eliminado',
                            'success'
                        )
                    }
                })
            })



            Livewire.on('view-modal', (flag) => {

                if(flag){
                    const myModal = new bootstrap.Modal('postModal');
                    setTimeout(() => {
                        myModal.show();
                    }, 1000);


                }else{
                    $('#postModal').modal('hide');
                }
            });
        })







    </script>
</div>




