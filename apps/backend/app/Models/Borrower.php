<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowerFactory> */
    use HasFactory;
    protected $fillable = [
        "name",
        "email",
        "member_since",
        "active",
    ];
    protected $casts = [
        'active' => 'boolean',
    ];

    public function borrowings() {
        return $this->hasMany(Borrowing::class);
    }
}
