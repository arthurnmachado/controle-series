<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    @auth
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>        
    @endauth

    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            @auth <a href="{{ route('seasons.index', $serie->id) }}"> @endauth
                {{ $serie->nome }}
            @auth </a> @endauth
        
            @auth
                <span class="d-flex">
                    <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                        <img src="{{ asset('media/icons/edit-icon.svg')}}" alt="Edit Icon" style="width: 20px">
                    </a>

                    <form action="{{ route('series.destroy', $serie->id)}}" method="POST" class="ms-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <img src="{{ asset('media/icons/trash-icon.svg')}}" alt="Trash Icon" style="width: 20px">
                        </button>
                    </form>
                </span>
            @endauth
        </li>
        @endforeach
    </ul>
</x-layout>
