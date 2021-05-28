<?php

namespace App\Traits;

use App\Http\Controllers\ResponseHelperController;
use Closure;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait ManagesTransactions
{
    public function transaction(Closure $callback): array
    {
        try {
            DB::beginTransaction();
            $callback($this);
            DB::commit();
            $response = ResponseHelperController::returnSuccess(null, null, 'Transaction is completed successfully.');
        } catch (QueryException $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());
            $response = ResponseHelperController::returnQueryException(null, 'A query exception error occurred.');
        } catch (Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());
            $response = ResponseHelperController::returnInternalException(null, 'An internal exception error occurred.');
        }

        return $response;
    }
}
