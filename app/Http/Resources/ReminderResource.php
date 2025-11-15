<?php

namespace App\Http\Resources;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReminderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function __construct(Reminder $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->resource->id,
            'user_id'        => $this->resource->user_id,
            'titulo'         => $this->resource->titulo,
            'descricao'      => $this->resource->descricao,
            'data_lembrete'  => $this->resource->data_lembrete,
            'previsao_clima' => $this->resource->previsao_clima,
            'created_at'     => $this->resource->created_at,
            'updated_at'     => $this->resource->updated_at,
        ];
    }
}