<div class="form-floating mb-3">
  <input type="text" class="form-control" id="name" name="name" placeholder="Título del post" required value="{{ old('name', $post->name) }}">
  <label for="name">Título del post</label>
</div>
<div class="form-floating mb-3">
  <button type="button" class="btn btn-outline-secondary" id="image-button">
    <i class="mdi mdi-image"></i>
    Imagen
  </button>
</div>
<div class="form-floating mb-3">
  <button type="submit" class="btn btn-primary">
    <i class="mdi mdi-content-save"></i>
    Guardar
  </button>
</div>
