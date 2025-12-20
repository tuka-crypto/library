<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            "ISBN"=>$this->ISBN,
            "title"=>$this->title,
            "price"=>$this->price,
            "mortgage"=>$this->mortgage,
            "authorship_date"=>$this->authorship_date,
            "cover" =>  env('APP_URL'). "/storage/book-images/$this->cover",
            "category"=>$this->category->name,
        ];
    }
}
