<?php

namespace Tests\Unit;

use App\Modules\Navigator\Domain\Exceptions\FileNavigationException;
use App\Modules\Navigator\Domain\Services\GetFileLinesService;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\TestCase;

class GetFileLinesServiceTest extends TestCase
{
    protected $filePath;
    protected $existingFilePath;
    protected $nonExistingFilePath;
    protected $getFileLinesService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->filePath = __DIR__ . '/test_file.txt'; // Replace with your own test file path
        $this->existingFilePath = __DIR__ . '/existing_file.txt'; // Replace with the path of an existing file on your system
        $this->nonExistingFilePath = __DIR__ . '/non_existing_file.txt'; // Replace with the path of a non-existing file on your system

        $this->getFileLinesService = new GetFileLinesService();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Clean up the test files if they exist
        if (file_exists($this->filePath)) {
            unlink($this->filePath);
        }
    }

    public function testHandleWithValidFilePath(): void
    {
        $page = 1;
        $perPage = 10;

        // Create a test file with some content
        file_put_contents($this->filePath, "Line 1\nLine 2\nLine 3\nLine 4\nLine 5\nLine 6\nLine 7\nLine 8\nLine 9\nLine 10\nLine 11\nLine 12\nLine 13\n");

        $paginator = $this->getFileLinesService->handle($this->filePath, $page, $perPage);

        $this->assertInstanceOf(LengthAwarePaginator::class, $paginator);
        $this->assertEquals(13, $paginator->total());
        $this->assertEquals($page, $paginator->currentPage());
        $this->assertEquals($perPage, $paginator->perPage());
    }

    public function testHandleWithNonExistingFilePath(): void
    {
        $this->expectException(FileNavigationException::class);
        $this->expectExceptionMessage("No file with path : \"" . $this->nonExistingFilePath . "\"");

        $this->getFileLinesService->handle($this->nonExistingFilePath);
    }

    public function testGetFileLinesContents(): void
    {
        $startLine = 3;
        $numLines = 4;

        // Create a test file with some content
        file_put_contents($this->filePath, "Line 1\nLine 2\nLine 3\nLine 4\nLine 5\nLine 6\nLine 7\nLine 8\nLine 9\nLine 10\nLine 11\nLine 12\nLine 13\n");

        $contents = $this->getFileLinesService->getFileLinesContents($this->filePath, $startLine, $numLines);

        $this->assertCount($numLines, $contents);
        $this->assertEquals("Line 3\nLine 4\nLine 5\nLine 6\n", implode('', $contents));
    }

    public function testGetFileLinesCount(): void
    {
        // Create a test file with some content
        file_put_contents($this->filePath, "Line 1\nLine 2\nLine 3\nLine 4\nLine 5\nLine 6\nLine 7\nLine 8\nLine 9\nLine 10\nLine 11\nLine 12\nLine 13\n");

        $count = $this->getFileLinesService->getFileLinesCount($this->filePath);

        $this->assertEquals(13, $count);
    }

    public function testGetFileLinesCountWithNonExistingFile(): void
    {
        $this->expectException(FileNavigationException::class);
        $this->expectExceptionMessage("Failed to open the file: " . $this->nonExistingFilePath);

        $this->getFileLinesService->getFileLinesCount($this->nonExistingFilePath);
    }
}
