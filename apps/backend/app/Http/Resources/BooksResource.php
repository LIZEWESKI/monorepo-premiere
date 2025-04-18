<?php

namespace App\Http\Resources;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "author" => $this->author,
            "genre" => $this->genre,
            "publishedYear" => $this->published_year,
            "isbn" => $this->isbn,
            "status" => $this->status,
            "borrowings" => BorrowingsResource::collection($this->whenLoaded("borrowings")),
        ];
    }
}
