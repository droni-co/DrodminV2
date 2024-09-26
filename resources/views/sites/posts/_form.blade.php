<div class="form-floating mb-3">
  <input type="text" class="form-control" id="name" name="name" placeholder="Título del post" required value="{{ old('name', $post->name) }}">
  <label for="name">Título del post</label>
</div>
<div class="form-floating mb-3">
  <textarea class="form-control" placeholder="Descripción" id="description" name="description" style="height: 100px;">{{ old('description', $post->description) }}</textarea>
  <label for="floatingTextarea">Descripción</label>
</div>
<div class="mb-3">
  <label for="picture">Imagen</label>
  <attachment-input site-id="{{ $site->id }}" name="picture" accept="" value="{{ old('picture', $post->picture) }}"></attachment-input>
</div>
<div class="mb-3">
  <h5>Categorías</h5>
  <ul class="list-group">
    @foreach ($categories as $category)
    <li class="list-group-item">
      <input
        class="form-check-input me-1"
        type="checkbox"
        id="category-{{ $category->id }}"
        name="categories[]"
        value="{{ $category->id }}"
        {{ in_array($category->id, old('categories', $post->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
      <label class="form-check-label" for="category-{{ $category->id }}">
        {{ $category->name }}
        <small class="text-muted">/{{ $category->slug }}</small>
      </label>
    </li>
    @endforeach
  </ul>
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
