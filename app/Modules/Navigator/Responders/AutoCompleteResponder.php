<?php

namespace App\Modules\Navigator\Responders;

use App\Traits\HasErrorResponse;

class AutoCompleteResponder
{
    use HasErrorResponse;

    public function send(array $suggestions)
    {
        return response()->json($suggestions);
    }
}
