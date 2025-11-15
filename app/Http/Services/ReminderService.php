<?php

namespace App\Http\Services;

use App\Http\Repositories\ReminderRepository;
use Illuminate\Support\Facades\Http;
use App\Http\Services\BaseService;

class ReminderService extends BaseService {
    protected ReminderRepository $reminderRepository;

    public function __construct(ReminderRepository $reminderRepository)
    {
        parent::__construct($reminderRepository);
        $this->reminderRepository = $reminderRepository;
    }

    public function index(array $data)
    {
        return $this->reminderRepository->index($data);
    }

    public function store(array $data)
    {
        // Consulta clima antes de salvar
        $data['previsao_clima'] = $this->getWeather($data['data_lembrete'] ?? null);

        return $this->reminderRepository->create($data);
    }

    public function update(array $data, string $id)
    {
        // Consulta clima antes de atualizar
        $data['previsao_clima'] = $this->getWeather($data['data_lembrete'] ?? null);

        return $this->reminderRepository->update($data, $id);
    }

    private function getWeather($date)
    {
        $cidade = 'Guarapuava';
        $apiKey = env('WEATHER_API_KEY');

        if (!$date || !$apiKey) {
            return 'Não encontrado';
        }

        $response = Http::get("https://api.weatherapi.com/v1/forecast.json", [
            'key' => $apiKey,
            'q' => $cidade,
            'dt' => $date,
            'lang' => 'pt'
        ]);

        return $response['forecast']['forecastday'][0]['day']['condition']['text'] ?? 'Não encontrado';
    }

    public function destroy(string $id)
    {
        return $this->reminderRepository->delete($id);
    }
}