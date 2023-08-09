<?php

namespace App\Modules\Navigator\Domain\Services\Contracts;

interface GetFileLinesServiceInterface
{
    public function handle(string $filePath, int $page = 1, int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
    public function getFileLinesContents(string $filePath, int $startLine = 1, int $numLines = 10): array;
    public function getFileLinesCount(string $filePath): int;
}