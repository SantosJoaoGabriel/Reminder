<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReminderRequest;
use App\Http\Requests\UpdateReminderRequest;
use App\Http\Resources\ReminderResource;
use App\Http\Services\ReminderService;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    private ReminderService $reminderService;

    public function __construct(ReminderService $reminderService)
    {
        $this->reminderService = $reminderService;
    }

    // Exibe todos os lembretes
    public function index(Request $request)
    {
        $reminders = $this->reminderService->index($request->all());
        return view('reminders.index', compact('reminders'));
    }

    // Exibe o formulário de cadastro
    public function create()
    {
        return view('reminders.create');
    }

    // Salva o novo lembrete
    public function store(CreateReminderRequest $request)
    {
        $reminder = $this->reminderService->store($request->validated());
        return redirect()->route('reminders.index');
    }

    // Exibe detalhes (API)
    public function show(string $id)
    {
        $reminder = $this->reminderService->show($id);
        return new ReminderResource($reminder);
    }

    // Exibe o formulário de edição
    public function edit(string $id)
    {
        $reminder = $this->reminderService->show($id);
        return view('reminders.edit', compact('reminder'));
    }

    // Atualiza um lembrete
    public function update(UpdateReminderRequest $request, string $id)
    {
        $this->reminderService->update($request->validated(), $id);
        return redirect()->route('reminders.index');
    }

    // Exclui um lembrete
    public function destroy(string $id)
    {
        $this->reminderService->destroy($id);
        return redirect()->route('reminders.index');
    }
}