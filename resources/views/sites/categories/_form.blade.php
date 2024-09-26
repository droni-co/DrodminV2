<div class="form-floating mb-3">
  <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la categoría" required value="{{ old('name', $category->name) }}">
  <label for="name">Nombre de la categoría</label>
</div>
<div class="form-floating mb-3">
  <textarea class="form-control" placeholder="Descripción" id="description" name="description" style="height: 100px;">{{ old('description', $category->description) }}</textarea>
  <label for="floatingTextarea">Descripción</label>
</div>
<div class="mb-3">
  <label for="picture">Imagen</label>
  <attachment-input site-id="{{ $site->id }}" name="picture" accept="" value="{{ old('picture', $category->picture) }}"></attachment-input>
</div>
<div class="form-floating mb-3">
  <button type="submit" class="btn btn-primary">
    <i class="mdi mdi-content-save"></i>
    Guardar
  </button>
</div>
