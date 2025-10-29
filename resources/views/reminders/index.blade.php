@extends('layouts.app')

@section('slot')
<div class="min-h-screen flex items-center justify-center bg-[#181928]">
    <div class="grid gap-16 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($reminders as $reminder)

            @php
                $clima = strtolower($reminder->previsao_clima ?? '');
                $glow = 'shadow-[0_0_40px_10px_rgba(59,130,246,0.5)]'; // azul como padrão
                if(str_contains($clima, 'rain')) $glow = 'shadow-[0_0_40px_10px_rgba(59,130,246,0.6)]';
                elseif(str_contains($clima, 'cloud')) $glow = 'shadow-[0_0_40px_10px_rgba(255,255,255,0.5)]';
                elseif(str_contains($clima, 'sun')) $glow = 'shadow-[0_0_40px_10px_rgba(255,204,0,0.5)]';
                elseif(str_contains($clima, 'storm')) $glow = 'shadow-[0_0_40px_10px_rgba(124,58,237,0.7)]';
                elseif(str_contains($clima, 'snow')) $glow = 'shadow-[0_0_40px_10px_rgba(173,216,230,0.8)]';
            @endphp
            <div class="relative w-[340px] h-[220px] rounded-2xl border-2 border-transparent
                bg-[#22232d] flex flex-col items-center justify-center
                {{ $glow }} shadow-2xl overflow-hidden
                hover:scale-105 transition-transform duration-300
            ">
                <h2 class="text-2xl font-bold text-white mb-2">{{ $reminder->titulo }}</h2>
                <p class="text-gray-300 mb-2 text-base">{{ $reminder->descricao }}</p>
                <div class="flex items-center gap-2 text-blue-200 font-bold mb-2">
                    📅 {{ \Carbon\Carbon::parse($reminder->data_lembrete)->format('d/m/Y') }}
                </div>
                <div class="flex items-center gap-2 text-lg mb-2">
                    @if(str_contains($clima, 'rain'))
                        🌧️
                    @elseif(str_contains($clima, 'cloud'))
                        ☁️
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
@endsection