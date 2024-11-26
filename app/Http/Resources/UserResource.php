<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $btnEdit = e('<button class="btn btn-xs btn-default text-primary mx-1 shadow" wire:click="edit()" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>');
        $btnDelete = e('<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>');
        $btnDetails = e('<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </button>');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => 'Admin', // Adjust as needed.
            'status' => 'Active', // Adjust as needed.
            'actions' => '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>',
        ];
    }

}
