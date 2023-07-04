<?php

namespace App\Modules\Navigator\Actions;

use App\Modules\Navigator\Domain\Requests\GetFileLinesRequest;
use App\Modules\Navigator\Domain\Services\GetFileLinesService;
use App\Modules\Navigator\Domain\Exceptions\FileNavigationException;
use App\Modules\Navigator\Responders\GetFileLinesResponder;
use Illuminate\Support\Facades\Log;

class GetFileLinesAction
{
    public function __construct(protected GetFileLinesService $service, protected GetFileLinesResponder $responder)
    {
    }

    public function __invoke(GetFileLinesRequest $request)
    {
        try 
        {
            $response = $this->service->handle($request->file_path, $request->page ?? 0, $request->perPage ?? 10);
        }
        catch(FileNavigationException $e)
        {
            return $this->responder->error($e->getMessage());
        }
        catch(\Throwable $e)
        {
            Log::error('GET_FILE_LINES_ACTION_ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return $this->responder->error();
        }

        return $this->responder->send($response);
    }
}