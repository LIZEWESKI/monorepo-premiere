<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowingFactory> */
    use HasFactory;
    public function books(){
        return $this->belongsTo(Book::class);
    }
    public function borrower(){
        return $this->belongsTo(Book::class);
    }
}
