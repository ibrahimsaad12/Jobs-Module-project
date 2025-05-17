<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostPaymentRequest;
use App\Models\Payment;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
    public function index()
    {
        $payment = Payment::all();

        return response()->json([
            'success' => true,
            'data' => $payment,

        ], 200);
    }

    public function post(PostPaymentRequest $request)
    {
        $payment = new Payment([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'status' => $request->status,
        ]);
        $payment->save();

    return response()->json([
        'success' => true,
        'message' => 'Application submitted successfully!',
        'data' => $payment,
    ], 201);

}
public function destroy($id)
{
    $payment = payment::find($id);

    if (!$payment) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    $payment->delete();

    return response()->json([
        'success' => true,
        'message' => 'Application deleted successfully!',
    ], 200);
}
public function update(UpdatePaymentRequest $request, $id)
{
    $payment = Payment::find($id);
// Debugging: Log the incoming request data

    if (!$payment) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    // Update only the fields that are present in the request
      if ($request->has('user_id')) {
        $payment->user_id = $request->user_id;
    }
    if ($request->has('amount')) {
        $payment->amount = $request->amount;
    }
    if ($request->has('payment_method')) {
        $payment->payment_method = $request->payment_method;
    }
    if ($request->has('transaction_id')) {
        $payment->transaction_id = $request->transaction_id;
    }
    if ($request->has('status')) {
        $payment->status = $request->status;
    }



    $payment->save();

    return response()->json([
        'success' => true,
        'message' => 'Application updated successfully!',
        'data' => $payment,
    ], 200);
}
}



