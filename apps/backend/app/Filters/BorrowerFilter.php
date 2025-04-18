<?php 
namespace App\Filters;

class BorrowerFilter extends ApiFilter {
    protected $safeParams = [
        "name" => ["eq"],
        "email" => ["eq"],
        "memberSince" => ["eq","gt","lt"],
        "active" => ["eq","ne"],
    ];
    protected $columnMap = [
        "memberSince" => "member_since",
    ];
}