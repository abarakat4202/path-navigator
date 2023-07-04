<?php

namespace App\Modules\Navigator\Domain\Services;

final class AutoCompleteService
{

    public function __construct()
    {
        
    }

    public function handle(string $path): array
    {
        return glob("$path*");
    }
}