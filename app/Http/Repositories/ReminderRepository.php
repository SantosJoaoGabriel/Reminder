<?php

namespace App\Http\Repositories;

use App\Models\Reminder;

class ReminderRepository extends BaseRepository
{
    public function __construct(Reminder $model)
    {
        parent::__construct($model);
    }

    public function index(array $data)
    {
        $reminders = $this->model->query();

        if (isset($data['user_id'])) {
            $reminders->where('user_id', $data['user_id']);
        }
        if (isset($data['year'])) {
            $reminders->whereYear('data_lembrete', $data['year']);
        }
        if (isset($data['month']) && ($data['view'] ?? null) === 'month') {
            $reminders->whereMonth('data_lembrete', $data['month']);
        }
        if (isset($data['week']) && ($data['view'] ?? null) === 'week') {
            $reminders->whereRaw('WEEK(data_lembrete) = ?', [$data['week']]);
        }
        if (isset($data['day']) && ($data['view'] ?? null) === 'day') {
            $reminders->whereDate('data_lembrete', $data['day']);
        }

        return $reminders
            ->select([
                'id',
                'user_id',
                'titulo',
                'descricao',
                'data_lembrete',
                'previsao_clima',
                'created_at',
                'updated_at',
            ])
            ->orderBy('data_lembrete')
            ->orderBy('id')
            ->paginate(6);
    }

    public function update(array $data, string $id)
    {
        unset($data['user_id']);
        return parent::update($data, $id);
    }
}