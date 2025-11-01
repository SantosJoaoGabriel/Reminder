@extends('layouts.app')

@section('slot')
<!-- Centraliza cards vertical/horizontalmente na tela -->
 <div class="min-h-screen flex items-center justify-center w-full">
    <div class="grid gap-16 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($reminders as $reminder)
            @php
                $clima = strtolower($reminder->previsao_clima ?? '');
                $glow = 'shadow-[0_0_40px_10px_rgba(59,130,246,0.5)]';
                if(str_contains($clima, 'cloud')) $glow = 'shadow-[0_0_40px_10px_rgba(255,255,255,0.5)]';
                elseif(str_contains($clima, 'rain')) $glow = 'shadow-[0_0_40px_10px_rgba(59,130,246,0.6)]';
                elseif(str_contains($clima, 'sun')) $glow = 'shadow-[0_0_40px_10px_rgba(255,204,0,0.5)]';
                elseif(str_contains($clima, 'storm')) $glow = 'shadow-[0_0_40px_10px_rgba(124,58,237,0.7)]';
                elseif(str_contains($clima, 'snow')) $glow = 'shadow-[0_0_40px_10px_rgba(173,216,230,0.8)]';
            @endphp
            <div class="relative w-[340px] h-[220px] rounded-2xl border-2 border-transparent
                bg-gray-800 flex flex-col items-center justify-center
                {{ $glow }} shadow-2xl overflow-hidden
                hover:scale-105 transition-transform duration-300
            ">
                <h2 class="text-2xl font-bold text-white mb-2">{{ $reminder->titulo }}</h2>
                <p class="text-gray-300 mb-2 text-base">{{ $reminder->descricao }}</p>
                <div class="flex items-center gap-2 text-blue-200 font-bold mb-2">
                    📅 {{ \Carbon\Carbon::parse($reminder->data_lembrete)->format('d/m/Y') }}
                </div>
                <div class="flex items-center gap-2 text-lg mb-2">
                    @if(str_contains($clima, 'cloud'))
                        ☁️
                    @elseif(str_contains($clima, 'rain'))
                        🌧️
                    @elseif(str_contains($clima, 'sun'))
                        ☀️
                    @elseif(str_contains($clima, 'storm'))
                        ⛈️
                    @elseif(str_contains($clima, 'snow'))
                        ❄️
                    @elseif(str_contains($clima, 'hot'))
                        🌡️
                    @else
                        🌈
                    @endif
                    <span class="text-blue-100 font-bold">{{ $reminder->previsao_clima ?? 'N/A' }}</span>
                </div>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('reminders.edit', $reminder->id) }}" class="px-3 py-2 bg-blue-700 text-white rounded-lg font-semibold text-sm shadow hover:bg-blue-500">Editar</a>
                    <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded-lg font-semibold text-sm shadow hover:bg-red-400">Excluir</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div> 
<div
    style="position: fixed; bottom: 2rem; left: 50%; transform: translateX(-50%); z-index: 9999; padding: 0.3rem 0.7rem; border-radius: 0.7rem; box-shadow: 0 2px 10px rgba(37,99,235,0.07); background: transparent;"
>
    {{ $reminders->links('pagination::tailwind') }}
</div>
<!-- maldito botão formatado em CSS puro-->
<a href="{{ route('reminders.create') }}"
   style="position: fixed; bottom: 2rem; right: 2rem; z-index: 9999; background: #2563eb; color: #fff; font-weight: bold; padding: 1rem 1.5rem; border-radius: 9999px; box-shadow: 0 4px 12px rgba(37,99,235,0.3); display: flex; align-items: center; gap: 0.5rem; cursor: pointer; text-decoration: none; font-size: 1rem;"
   title="Novo Lembrete">
    <svg xmlns="http://www.w3.org/2000/svg" style="height:1.25rem;width:1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    Novo
</a>
@endsection