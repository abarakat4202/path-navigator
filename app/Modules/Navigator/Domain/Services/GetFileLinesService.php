<?php

namespace App\Modules\Navigator\Domain\Services;

use App\Modules\Navigator\Domain\Exceptions\FileNavigationException;
use Illuminate\Pagination\LengthAwarePaginator;

class GetFileLinesService
{

    /**
     * The function handles pagination for a file by returning a LengthAwarePaginator
     * object with the specified number of lines per page.
     */
    public function handle(string $filePath, int $page = 1, int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        if(!is_file($filePath)) {
            throw new FileNavigationException("No file with path : \"$filePath\"");
        }

        $page = $page ?: LengthAwarePaginator::resolveCurrentPage('page');

        return new LengthAwarePaginator(
            $this->getFileLinesContents($filePath, $this->getStartLineNumber($page, $perPage), $perPage),
            $this->getFileLinesCount($filePath),
            $perPage,
            $page,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
    }

    /**
     * The function calculates the starting line number based on the current page and
     * number of items per page.
     */
    private function getStartLineNumber(int $page = 1, int $perPage = 10): int
    {
        return (($page - 1) * $perPage) + 1;
    }

    /**
     * The getFileLinesContents function reads a file and returns an array
     * containing the contents of specified lines.
     */
    public function getFileLinesContents(string $filePath, int $startLine = 1, int $numLines = 10): array
    {
        $handleFile = fopen($filePath, 'r');
        if ($handleFile === false) {
            throw new FileNavigationException("Failed to open the file: $filePath");
        }

        $currentLine = 1;
        $selectedLines = [];

        while (!feof($handleFile)) {
            $line = fgets($handleFile);
            if ($currentLine >= $startLine && $currentLine < $startLine + $numLines) {
                $selectedLines[$currentLine] = $line;
            }
            $currentLine++;
        }

        fclose($handleFile);
        return $selectedLines;
    }

    /**
     * The getFileLinesCount function in PHP reads a file and returns the number
     * of lines in the file.
     */
    public function getFileLinesCount(string $filePath): int
    {
        $handleFile = fopen($filePath, "r");
        if ($handleFile === false) {
            throw new FileNavigationException("Failed to open the file: $filePath");
        }
        
        $linecount = 0;

        while(!feof($handleFile)) {
            $line = fgets($handleFile, 4096);
            $linecount = $linecount + substr_count($line, "\n");
        }

        fclose($handleFile);
        return $linecount;
    }

}