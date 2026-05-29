<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "birth_date" => $this->birth_date,
            "DNI" => $this->DNI,
            "address" => $this->address,
            "phone" => $this->phone,
            'email' => $this->email,
            'registration_status' => $this->registration_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
