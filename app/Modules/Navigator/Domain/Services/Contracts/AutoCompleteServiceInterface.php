<?php

namespace App\Modules\Navigator\Domain\Services\Contracts;

interface AutoCompleteServiceInterface
{
    public function handle(string $path): array;
}