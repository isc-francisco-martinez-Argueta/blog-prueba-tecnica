<div wire:ignore.self class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">


            <div class="modal-header  ">

                <h4 class="modal-title " id="staticBackdropLabel">Titulo: {{$title}}</h4>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Contenido:</h5>
                        <blockquote class="blockquote mb-0">
                            <p>{{$content}}.</p>
                            <footer class="blockquote-footer">Autor: <cite title="Source Title">{{$author}}</cite>
                            </footer>
                        </blockquote>

                    </div>

                    <div class="card-footer text-muted">
                        {{$created_at}}
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
