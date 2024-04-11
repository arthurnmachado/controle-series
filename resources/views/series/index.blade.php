<x-layout title='Séries'>
    <a href="series/criar" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $serie->nome }} 
                <button type="button" class="btn btn-danger" onclick="deletarItem({{ $serie->id }}, '{{ csrf_token() }}')">
                    <img src="{{ asset('media/icons/trash-icon.svg') }}" alt="Trash Icon" style="width: 20px;">
                </button>                
            </li>
            
        @endforeach
    </ul>
</x-layout>