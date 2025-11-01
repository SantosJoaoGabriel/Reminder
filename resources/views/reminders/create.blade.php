@extends('layouts.app')

@section('slot')
    <div class="min-h-screen flex items-center justify-center w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                        Adicionar Novo Lembrete
                    </h1>
                    <form action="{{ route('reminders.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for ="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Titulo:
                            </label>
                            <input type="text" name="titulo" id="titulo" class="form-input mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Descrição:
                            </label>
                            <input type="text" name="descricao" id="descricao" class="form-input mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="data_lembrete" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Data do Lembrete:
                            </label>
                            <input type="date" name="data_lembrete" id="data_lembrete" class="form-input mt-1 block w-full" required>
                        </div>
                        <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Adicionar
                        </button>
                        <a href="{{ route('reminders.index') }}"
                            class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-block">
                                Cancelar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection