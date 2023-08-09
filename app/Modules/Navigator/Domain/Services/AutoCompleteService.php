<?php

namespace App\Modules\Navigator\Domain\Services;

use App\Modules\Navigator\Domain\Services\Contracts\AutoCompleteServiceInterface;

final class AutoCompleteService implements AutoCompleteServiceInterface
{
    public function __construct()
    {

    }

    public function handle(string $path): array
    {
        return glob("$path*");
    }
}
