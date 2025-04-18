<?php 
namespace App\Filters;

class BookFilter extends ApiFilter {

    protected $safeParams = [
        "title" => ["eq"],
        "author" => ["eq"],
        "genre" => ["eq"],
        "publishedYear" => ["eq","gt","lt"],
        "isbn" => ["eq"],
        "status" => ["eq"],
    ];
    protected $columnMap = [
        "PublishedYear" => "published_year"
    ];
}