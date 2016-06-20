<div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
    <label class="control-label" for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') ?: ($entry ? $entry->nome : null) }}" maxlength="80">
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('data_inicial') ? 'has-error' : '' }}">
            <label class="control-label" for="data_inicial">Data Inicial</label>
            <input type="text" class="form-control" id="data_inicial" name="data_inicial" value="{{ old('data_inicial') ?: ($entry ? $entry->data_inicial : null) }}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('data_final') ? 'has-error' : '' }}">
            <label class="control-label" for="data_final">Data Final</label>
            <input type="text" class="form-control" id="data_final" name="data_final" value="{{ old('data_final') ?: ($entry ? $entry->data_final : null) }}">
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('descricao') ? 'has-error' : '' }}">
    <label class="control-label" for="descricao">Descrição</label>
    <textarea type="text" class="form-control" id="descricao" name="descricao">{{ old('descricao') ?: ($entry ? $entry->descricao : null) }}</textarea>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('lotacao_maxima') ? 'has-error' : '' }}">
            <label class="control-label" for="capacidade">Capacidade máxima</label>
            <input type="text" class="form-control" id="capacidade" name="lotacao_maxima" value="{{ old('lotacao_maxima') ?: ($entry ? $entry->lotacao_maxima : null) }}">
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('tipo') ? 'has-error' : '' }}">
            <label class="control-label" for="tipo">Tipo</label>
            <select class="form-control" name="tipo" id="tipo">
                <option></option>
                <option>show</option>
                <option>balada</option>
                <option>teatro</option>
                <option>esporte</option>
            </select>
            {{--<input type="text" class="form-control" id="capacidade" name="lotacao_maxima" value="{{ old('lotacao_maxima') ?: ($entry ? $entry->lotacao_maxima : null) }}">--}}
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('organizador_id') ? 'has-error' : '' }}">
            <label class="control-label" for="organizador_id">Organizador</label>
            <select class="form-control" name="organizador_id" id="organizador_id">
                <option></option>
                @foreach($organizadores as $item)
                    <option value="{{ $item->id }}">{{ $item->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="checkbox">
    <label>
        <input type="checkbox" name="publicado"> Publicado?
    </label>
</div>


<button type="submit" class="btn btn-primary">Salvar</button>