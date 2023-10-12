<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }


    public function qrCode($request)
    {
        return [
            'Tài Khoản' => $this->username,
            'Tên' => $this->name,
            'LoginTime:' => date('d/m/Y', strtotime($this->login_at)),
            'ID' => $this->id,
            'Email' => $this->email,
            'Phòng Ban' => $this->department_name,
            'Trạng Thái' => $this->status_name,
        ];
    }
}