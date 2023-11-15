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
                                <a class="btn btn-light shadow p-2" wire:click="show({{ $post->id}})">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a class="btn btn-warning shadow p-2" wire:click="edit({{ $post->id}})">
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
    @include('admin.post.form-modal')
    @include('admin.post.show-modal')










    <script type="module">

        document.addEventListener('livewire:init', () => {
            // console.log(bootstrap);

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



            const myModal = new bootstrap.Modal(document.getElementById('postModal'));
            const show = new bootstrap.Modal(document.getElementById('showModal'));
            Livewire.on('abrirModal', () => {
                // Abrir el modal
                myModal.show();
            });
            Livewire.on('showAbrirModal', () => {
                // Abrir el modal
                show.show();
            });


            Livewire.on('cerrarModal', () => {
                myModal.hide();
                show.hide();
            });


            Livewire.on('store-message', () => {
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: 'success',
                    title: 'Post creado Exitosamente',
                });
            });

            Livewire.on('update-message', () => {
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: 'success',
                    title: 'Post actualizado Exitosamente',
                });
            });
        })







    </script>
</div>




