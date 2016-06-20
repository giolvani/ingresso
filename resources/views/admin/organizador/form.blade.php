<div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
    <label class="control-label" for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') ?: ($entry ? $entry->nome : null) }}" maxlength="80">
</div>

<button type="submit" class="btn btn-primary">Salvar</button>