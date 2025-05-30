<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class STOCKLOGController extends Controller
{
    public function index()
    {
        $stockLogs = StockLog::all();
        if ($stockLogs->count() > 0) {
            return response()->json([
                'status' => 200,
                'stock_logs' => $stockLogs
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No records found.'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required|string',
            'user_name' => 'required|string',
            'stock_id' => 'required|string|exists:stocks,id',
            'sku' => 'required|string',
            'description' => 'nullable|string',
            'qty' => 'required|integer',
            'reason' => 'required|string',
            'date_released' => 'nullable|date',
            'receiver' => 'nullable|string',
            'buying_price' => 'nullable|numeric',
            'supplier' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $stockLog = StockLog::create([
            'action' => $request->action,
            'user_name' => $request->user_name,
            'stock_id' => $request->stock_id,
            'sku' => $request->sku,
            'description' => $request->description,
            'qty' => $request->qty,
            'reason' => $request->reason,
            'date_released' => $request->date_released,
            'receiver' => $request->receiver,
            'buying_price' => $request->buying_price,
            'supplier' => $request->supplier,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Stock log created successfully.',
            'stock_log' => $stockLog
        ], 200);
    }

    public function show($id)
    {
        $stockLog = StockLog::find($id);
        if ($stockLog) {
            return response()->json([
                'status' => 200,
                'stock_log' => $stockLog
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Stock log not found.'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required|string',
            'user_name' => 'required|string',
            'stock_id' => 'required|string|exists:stocks,id',
            'sku' => 'required|string',
            'description' => 'nullable|string',
            'qty' => 'required|integer',
            'reason' => 'required|string',
            'date_released' => 'nullable|date',
            'receiver' => 'nullable|string',
            'buying_price' => 'nullable|numeric',
            'supplier' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $stockLog = StockLog::find($id);
        if ($stockLog) {
            $stockLog->update([
            'action' => $request->action,
            'user_name' => $request->user_name,
            'stock_id' => $request->stock_id,
            'sku' => $request->sku,
            'description' => $request->description,
            'qty' => $request->qty,
            'reason' => $request->reason,
            'date_released' => $request->date_released,
            'receiver' => $request->receiver,
            'buying_price' => $request->buying_price,
            'supplier' => $request->supplier,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Stock log updated successfully.',
                'stock_log' => $stockLog
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Stock log not found.'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $stockLog = StockLog::find($id);
        if ($stockLog) {
            $stockLog->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Stock log deleted.'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Stock log not found.'
            ], 404);
        }
    }
}
