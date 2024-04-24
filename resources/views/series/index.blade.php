<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('seasons.index', $serie->id) }}">
                {{ $serie->nome }}
            </a>
        
            <span class="d-flex">
                <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                    <img src="{{ asset('media/icons/edit-icon.svg')}}" alt="Trash Icon" style="width: 20px">
                </a>

                <form action="{{ route('series.destroy', $serie->id)}}" method="POST" class="ms-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        <img src="{{ asset('media/icons/trash-icon.svg')}}" alt="Trash Icon" style="width: 20px">
                    </button>
                </form>
            </span>
        </li>
        @endforeach
    </ul>
</x-layout>
