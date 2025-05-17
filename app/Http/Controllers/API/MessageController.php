<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $message = Message::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully fetched posts!',
            'data' => $message,
        ], 200);
    }

    public function post(PostMessageRequest $request)
{
    $message = new Message([
        'sender_id' => $request->sender_id,
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
        'read_status' => $request->read_status,
    ]);
    $message->save();

    return response()->json([
        'success' => true,
        'message' => 'Application submitted successfully!',
        'data' => $message,
    ], 201);

}
public function destroy($id)
{
    $message = Message::find($id);

    if (!$message) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    $message->delete();

    return response()->json([
        'success' => true,
        'message' => 'Application deleted successfully!',
    ], 200);
}
public function update(UpdateMessageRequest $request, $id)
{
    $message = Message::find($id);
// Debugging: Log the incoming request data

    if (!$message) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    // Update only the fields that are present in the request
   if ($request->sender_id) {
        $message->sender_id = $request->sender_id;
    }
    if ($request->receiver_id) {
        $message->receiver_id = $request->receiver_id;
    }
    if ($request->message) {
        $message->message = $request->message;
    }
    if ($request->read_status) {
        $message->read_status = $request->read_status;
    }


    $message->save();

    return response()->json([
        'success' => true,
        'message' => 'Application updated successfully!',
        'data' => $message,
    ], 200);
}
}

