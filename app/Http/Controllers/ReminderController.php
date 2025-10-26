<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index() {
        $reminders = Reminder::paginate(10);
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
    $validated['user_id'] = auth()->id(); // se houver relacionamento
    Reminder::create($validated);

    return redirect()->route('reminders.index')->with('success', 'Lembrete criado!');
}

public function edit($id) {
    $reminder = Reminder::where('id', $id)
        ->where('user_id', auth()->user()->id)
        ->firstOrFail();
    return view('reminders.edit', compact('reminder'));
}

public function update(Request $request, Reminder $reminder) {
    $validated = $request->validate([
        'titulo' => 'required|string|max:255',
        'descricao' => 'required|string',
        'data_lembrete' => 'required|date',
        'hora_lembrete' => 'required',
    ]);
    $reminder->update($validated);
    return redirect()->route('reminders.index')
        ->with('success', 'Lembrete atualizado!');
}

    public function destroy(Reminder $reminder) {
        $reminder->delete();
        return redirect()->route('reminders.index');
    }
}
