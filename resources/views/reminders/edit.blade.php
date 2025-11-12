@extends('layouts.app')

@section('slot')
<div class="min-h-screen flex items-center justify-center w-full"">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Editar Lembrete</h1>

                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reminders.update', $reminder->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Título:
                        </label>
                        <input type="text" name="titulo" id="titulo" class="form-input mt-1 block w-full" value="{{ $reminder->titulo }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Descrição:
                        </label>
                        <input type="text" name="descricao" id="descricao" class="form-input mt-1 block w-full"  value="{{ $reminder->descricao ?? old('descricao') }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="data_lembrete" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Data:
                        </label>
                        <input type="date" name="data_lembrete" id="data_lembrete" class="form-input mt-1 block w-full" value="{{ $reminder->data_lembrete }}" required>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Atualizar
                    </button>
                    <a href="{{ route('reminders.index') }}"
                        class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-block">
                            Cancelar
                    </a>
                </form>

                @if($reminder->previsao_clima)
                    <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Previsão do Clima</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Para {{ $reminder->data_lembrete }} em Guarapuava: 
                            <span class="font-semibold">{{ $reminder->previsao_clima }}</span>
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection