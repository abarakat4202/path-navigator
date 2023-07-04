<?php

namespace App\Modules\Navigator\Responders;

use App\Traits\HasErrorResponse;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetFileLinesResponder
{
    use HasErrorResponse;
    
    public function send(LengthAwarePaginator $fileLinesPaginator): LengthAwarePaginator
    {
        return $fileLinesPaginator;
    }
}