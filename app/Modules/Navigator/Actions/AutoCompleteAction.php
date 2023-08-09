<?php

namespace App\Modules\Navigator\Actions;

use App\Modules\Navigator\Domain\Requests\AutoCompleteRequest;
use App\Modules\Navigator\Domain\Services\AutoCompleteService;
use App\Modules\Navigator\Responders\AutoCompleteResponder;
use Illuminate\Support\Facades\Log;

class AutoCompleteAction
{
    public function __construct(protected AutoCompleteService $service, protected AutoCompleteResponder $responder)
    {
    }

    public function __invoke(AutoCompleteRequest $request)
    {
        try {
            $suggestions = glob("$request->file_path*");
        } catch (\Throwable $e) {
            Log::error('GET_AUTO_COMPLETE_ACTION_ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return $this->responder->error();
        }

        return $this->responder->send($suggestions ?? []);
    }
}
