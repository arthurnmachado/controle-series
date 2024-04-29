<x-layout title="Editar Série '{!! $serie->nome !!}'">
    <form action="{{ route('series.update', $serie->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ $serie->nome }}">
        </div>

        <button type="submit" class="btn btn-primary">Editar</button>
    </form>
</x-layout>