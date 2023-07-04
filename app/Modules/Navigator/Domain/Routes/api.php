<?php

Route::prefix('navigator')->middleware('auth:admin')->group(function () {
    Route::get('/auto-complete', \App\Modules\Navigator\Actions\AutoCompleteAction::class);
    Route::get('/file-lines', \App\Modules\Navigator\Actions\GetFileLinesAction::class);
});
