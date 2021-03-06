<?php

class ModalWidget {
    /**
     * ModalWidget
     * * Crea un modal de bootstrap con funcionalidades extra
     */
    
    function __construct(string $id, string $title, string $body, string $bootstrapClassSize="modal-md", bool $showOnLoad=false) {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->bootstrapClassSize = $bootstrapClassSize;
        $this->showOnLoad = $showOnLoad;
    }

    function __toString() {
        $script = $this->showOnLoad ? <<<HTML
        <script>
            $(document).ready(function() {
                $($this->id).modal('show');
            });
        </script>
        HTML : "";
        return <<<HTML
        $script
        <div class="modal fade" id="$this->id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog $this->bootstrapClassSize" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">$this->title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        $this->body
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }
}