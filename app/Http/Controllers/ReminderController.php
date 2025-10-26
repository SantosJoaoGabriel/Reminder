<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReminderController extends Controller
{
    public function index() {
        $reminders = Reminder::where('user_id', auth()->id())->paginate(10);
        return view('reminders.index', compact('reminders'));
    }

    public function create() {
        return view('reminders.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data_lembrete' => 'required|date',
            'hora_lembrete' => 'required',
        ]);

        $cidade = 'Guarapuava';
        $data = $validated['data_lembrete'];
        $apiKey = env('WEATHER_API_KEY');   

        $response = Http::get("https://api.weatherapi.com/v1/forecast.json", [
            'key' => $apiKey,
            'q' => $cidade,
            'dt' => $data
        ]);

        $previsao = $response['forecast']['forecastday'][0]['day']['condition']['text'] ?? 'Não encontrado';

        $validated['previsao_clima'] = $previsao;
        $validated['user_id'] = auth()->id();

        Reminder::create($validated);

        return redirect()->route('reminders.index')->with('success', 'Lembrete criado com previsão do clima!');
    }

    public function edit($id) {
        $reminder = Reminder::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        return view('reminders.edit', compact('reminder'));
    }

    public function update(Request $request, Reminder $reminder) {
    if ($reminder->user_id !== auth()->id()) {
        abort(403);
    }

    $validated = $request->validate([
        'titulo' => 'required|string|max:255',
        'descricao' => 'required|string',
        'data_lembrete' => 'required|date',
        'hora_lembrete' => 'required',
    ]);

    // Consulta nova previsão de clima
    $cidade = 'Guarapuava';
    $data = $validated['data_lembrete'];
    $apiKey = env('WEATHER_API_KEY');

    $response = Http::get("https://api.weatherapi.com/v1/forecast.json", [
        'key' => $apiKey,
        'q' => $cidade,
        'dt' => $data
    ]);

    $previsao = $response['forecast']['forecastday'][0]['day']['condition']['text'] ?? 'Não encontrado';
    $validated['previsao_clima'] = $previsao;

    $reminder->update($validated);

    return redirect()->route('reminders.index')
        ->with('success', 'Lembrete atualizado com nova previsão do clima!');
}   

    public function destroy(Reminder $reminder) {
        if ($reminder->user_id !== auth()->id()) {
            abort(403);
        }
        $reminder->delete();
        return redirect()->route('reminders.index');
    }
}