<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowingFactory> */
    use HasFactory;

    protected $fillable = [
        'book_id',
        'borrower_id',
        'borrow_date',
        'return_date',
        'status',
    ];
    public function books(){
        return $this->belongsTo(Book::class);
    }
    public function borrower(){
        return $this->belongsTo(Book::class);
    }
}
