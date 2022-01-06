<?php

class InputProfileImageWidget {
    public $invalidFeedback = "";
    function __construct(string $name, string $validation, string $label="", string $cssClasses="", string $style="") {
        $this->name = $name;
        $this->validation = $validation;
        $this->cssClasses = $cssClasses;
        $this->style = $style;
        $this->label = $label;
    }

    function __toString() {
        $name = $this->name;
        $id = "imgInput-$name";
        $label = $this->label != "" ? <<<HTML
        <label class="form-label">$this->label</label>
        HTML : "";
        return <<<HTML
        <div class="col-md mb-3 $this->cssClasses" style="$this->style">
            $label
            <br>
            <input name=$name type='file' id="$id" class="d-none"/>
            <label for="$id">
                <img id="$id-imagePreview" alt="" class="profile-user-img img-circle d-none" style="width: 100px; height: 100px; object-fit: cover"/>
                <div id="$id-selectImageText" class="profile-user-img img-circle d-flex align-items-center justify-content-center text-center" style="width: 100px; height: 100px;">
                    <p class="text-secondary" style="transform: translateY(25%)">Seleccionar</p>
                </div>
            </label>
            <!-- bootstrap no funciona clase invalid-feedback -->
            <div class="text-danger">$this->invalidFeedback</div>        
        </div>
        <script>
            input = document.getElementById("$id");
            input.onchange = evt => {
                imgPreview = document.getElementById("$id-imagePreview");
                imgPreview.classList.remove("d-none");
                imgPreviewText = document.getElementById("$id-selectImageText");
                if (imgPreviewText) 
                    imgPreviewText.remove();
                const [file] = input.files;
                if (file) {
                    imgPreview.src = URL.createObjectURL(file)
                }
            }
        </script>
        HTML;
    }
}