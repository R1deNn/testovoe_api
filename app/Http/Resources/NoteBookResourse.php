<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteBookResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'fio' => $this->fio,
            'company' => $this->company,
            'tel' => $this->tel,
            'email' => $this->email,
            'bth' => $this->bth,
            'photo' => $this->photo,
        ];
    }
}
