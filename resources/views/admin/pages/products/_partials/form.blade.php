@csrf
<div class="form-group">
    <label for="title">Nome:</label>
    <input type="text" name="title" id="title" class="form-control" placeholder="Nome:"
        value="{{ $product->title ?? old('title') }}" autofocus>
</div>
<div class="form-group">
    <label for="price">preço:</label>
    <input type="number" name="price" id="price" class="form-control" placeholder="Preço:"
        value="{{ $product->price ?? old('price') }}" step="0.01">
</div>
<div class="form-group">
    <label for="image">Imagem:</label>
    <input type="file" name="image" id="image" class="form-control" placeholder="Imagem:">
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Descrição:">
        {{ $product->description ?? old('description') }}
    </textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>