<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\TransactionDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionCreateRequest;
use App\Http\Resources\TransactionResource;
use App\Services\TransactionService;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    )
    {}
    public function create(TransactionCreateRequest $request):JsonResponse
    {
        $payerId = Auth::id();
        $data = $request->validated();
        $transactionDTO = new TransactionDTO($payerId,$data['payee'],$data['value']);

        try {
            $transaction = $this->transactionService->makeTransaction($transactionDTO);
                
            return response()->json(
                new TransactionResource($transaction),200
            );
        } catch (Exception $e) {
            return response()->json([
                'status' => 'false',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
