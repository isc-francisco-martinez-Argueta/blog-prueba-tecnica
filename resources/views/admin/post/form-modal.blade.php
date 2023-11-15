<div wire:ignore.self class="modal fade" id="postModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header  ">
                    <h1 class="modal-title fs-5" id="postModalLabel">
                        <b>{{ $post_id ? 'Editar post' : 'Crear post' }}</b>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="{{ $post_id ? 'update' : 'store' }}">
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
