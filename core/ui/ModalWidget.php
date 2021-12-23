<?php

class ModalWidget {
    function __construct(string $id, string $title, string $body, string $bootstrapClassSize="modal-md") {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->bootstrapClassSize = $bootstrapClassSize;
    }

    function __toString() {
        return <<<HTML
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