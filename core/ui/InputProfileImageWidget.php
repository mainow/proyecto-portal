<?php

class InputProfileImageWidget {
    /**
     * InputProfileImageWidget
     * * Crea un widget especificamente dedicado a un selector de imagen de perfil
     */
    public $invalidFeedback = "";
    function __construct(string $name, string $validation, string $label="", string $defaultImage="", bool $showText=true, string $cssClasses="", string $style="") {
        $this->name = $name;
        $this->validation = $validation;
        $this->cssClasses = $cssClasses;
        $this->style = $style;
        $this->label = $label;
        $this->defaultImage = $defaultImage;
        $this->showText = $showText;
    }

    function __toString() {
        $name = $this->name;
        $id = "imgInput-$name";
        $label = $this->label != "" ? <<<HTML
        <label class="form-label">$this->label</label>
        HTML : "";
        $imgPreviewDisplayClass = $this->showText ? "d-none" : "";
        $placeholderHtml = $this->showText ? <<<HTML
        <div id="$id-selectImageText" class="profile-user-img img-circle d-flex align-items-center justify-content-center text-center" style="width: 100px; height: 100px;">
            <p class="text-secondary" style="transform: translateY(25%)">Seleccionar</p>
        </div>
        HTML : "";
        return <<<HTML
        <div class="mb-3 $this->cssClasses col-mb" style="$this->style">
            $label
            <br>
            <input name=$name type='file' id="$id" class="d-none"/>
            <label for="$id">
                <img id="$id-imagePreview" alt="" src="$this->defaultImage" class="profile-user-img img-circle $imgPreviewDisplayClass" style="width: 100px; height: 100px; object-fit: cover"/>
                $placeholderHtml
            </label>
            <!-- bootstrap no funciona clase invalid-feedback -->
            <div class="text-danger">$this->invalidFeedback</div>        
        </div>
        <script>
            document.getElementById("$id").onchange = evt => {
                document.getElementById("$id-imagePreview").classList.remove("d-none");
                if (document.getElementById("$id-selectImageText")) {
                    document.getElementById("$id-selectImageText").remove();
                }
                const [file] = document.getElementById("$id").files;
                if (file) {
                    document.getElementById("$id-imagePreview").src = URL.createObjectURL(file)
                }
            }
        </script>
        HTML;
    }
}