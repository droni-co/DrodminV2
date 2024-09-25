<div class="form-floating mb-3">
  <input type="text" class="form-control" id="name" name="name" placeholder="Título del post" required value="{{ old('name', $post->name) }}">
  <label for="name">Título del post</label>
</div>
<div class="form-floating mb-3">
  <textarea class="form-control" placeholder="Descripción" id="description" name="description" style="height: 100px;">{{ old('description', $post->description) }}</textarea>
  <label for="floatingTextarea">Descripción</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="picture" name="picture" placeholder="Imagen" value="{{ old('picture', $post->picture) }}">
  <label for="name">Imagen</label>
</div>
<div class="form-floating mb-3">
  <select class="form-select" id="format" name="format">
    <option value="html" {{ old('format', $post->format) == 'html' ? 'selected' : '' }}>HTML</option>
    <option value="markdown" {{ old('format', $post->format) == 'markdown' ? 'selected' : '' }}>Markdown</option>
  </select>
  <label for="format">Formato</label>
</div>
<div class="form-check form-switch mb-3">
  <input class="form-check-input" type="checkbox" id="active" name="active" value="1" {{ old('active', $post->active) ? 'checked' : '' }}>
  <label class="form-check-label" for="active">¿Está activo?</label>
</div>
<div class="form-floating mb-3">
  <button type="submit" class="btn btn-primary">
    <i class="mdi mdi-content-save"></i>
    Guardar
  </button>
</div>
