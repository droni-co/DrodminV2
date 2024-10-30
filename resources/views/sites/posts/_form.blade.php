<ul class="nav nav-tabs" id="postTab">
  <li class="nav-item">
    <button
      class="nav-link active"
      id="postInfo-tab"
      data-bs-toggle="tab"
      data-bs-target="#postInfo"
      type="button"
      role="tab"
      aria-controls="postInfo"
      aria-selected="true">
      Información
    </button>
  </li>
  <li class="nav-item">
    <button
      class="nav-link"
      id="postCategories-tab"
      data-bs-toggle="tab"
      data-bs-target="#postCategories"
      type="button"
      role="tab"
      aria-controls="postCategories"
      aria-selected="false">
      Categorías
    </button>
  </li>
  <li class="nav-item">
    <button
      class="nav-link"
      id="postProps-tab"
      data-bs-toggle="tab"
      data-bs-target="#postProps"
      type="button"
      role="tab"
      aria-controls="postProps"
      aria-selected="false">
      Propiedades
    </button>
  </li>
</ul>
<div class="tab-content" id="postTabContent">
  <div class="tab-pane fade show active" id="postInfo" role="tabpanel" aria-labelledby="postInfo-tab">
    <!-- Tab de información -->
    <div class="form-floating mb-3 mt-2">
      <input type="text" class="form-control" id="name" name="name" placeholder="Título del post" required value="{{ old('name', $post->name) }}">
      <label for="name">Título del post</label>
    </div>
    <div class="form-floating mb-3">
      <textarea class="form-control" placeholder="Descripción" id="description" name="description" style="height: 100px;">{{ old('description', $post->description) }}</textarea>
      <label for="floatingTextarea">Descripción</label>
    </div>
    <div class="mb-3">
      <label for="picture">Imagen</label>
      <attachment-input
        site-id="{{ $site->id }}"
        name="picture"
        accept="image/*"
        :width="1200"
        :height="600"
        value="{{ old('picture', $post->picture) }}">
      </attachment-input>
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
  </div>
  <div class="tab-pane fade" id="postCategories" role="tabpanel" aria-labelledby="postCategories-tab">
    <div class="mb-3 mt-2">
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
  </div>
  <div class="tab-pane fade" id="postProps" role="tabpanel" aria-labelledby="postProps-tab">
    @if($post->id)
    <attrs-component
      :site="{{ $site->toJson() }}"
      :attrs="{{ $post->attrs->toJson() }}"
      :attributable="{{ $post->toJson() }}"
      attributable-type="App\Models\Post"
      >
    </attrs-component>
    @else
    <div class="alert alert-info" role="alert">
      <h4 class="alert-heading">¡Atención!</h4>
      <p>Para poder agregar propiedades a este post, primero debes guardarlo.</p>
    </div>
    @endif
  </div>
</div>
