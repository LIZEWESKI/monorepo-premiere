<?php 
namespace App\Filters;

class BorrowingFilter extends ApiFilter {

    protected $safeParams = [
        "borrowDate" => ["eq","gt","lt"],
        "returnDate" => ["eq","gt","lt","ne"],
        "status" => ["eq"],
    ];
    protected $columnMap = [
        "borrowDate" => "borrow_date",
        "returnDate" => "return_date",
    ];
}