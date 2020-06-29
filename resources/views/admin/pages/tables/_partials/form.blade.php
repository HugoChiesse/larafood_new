@csrf
<div class="form-group">
    <label for="identify">Identificação:</label>
    <input type="text" name="identify" id="identify" class="form-control" placeholder="Identificação:"
        value="{{ $table->identify ?? old('identify') }}" autofocus>
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <input type="text" name="description" id="description" class="form-control" placeholder="Descrição:"
        value="{{ $table->description ?? old('description') }}" autofocus>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>