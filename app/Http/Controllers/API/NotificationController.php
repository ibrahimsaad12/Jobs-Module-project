<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Requests\PostNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = Notification::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully fetched posts!',
            'data' => $notification,
        ], 200);
    }

    public function post(PostNotificationRequest $request)
{
    $notification = new Notification([
       'user_id' => $request->user_id,
       'message' => $request->message,
       'type' => $request->type,
         'is_read' => $request->is_read,
    ]);
    $notification->save();

    return response()->json([
        'success' => true,
        'message' => 'Application submitted successfully!',
        'data' => $notification,
    ], 201);

}
public function destroy($id)
{
    $notification = Notification::find($id);

    if (!$notification) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    $notification->delete();

    return response()->json([
        'success' => true,
        'message' => 'Application deleted successfully!',
    ], 200);
}
public function update(UpdateNotificationRequest $request, $id)
{
    $notification = Notification::find($id);
// Debugging: Log the incoming request data

    if (!$notification) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    // Update only the fields that are present in the request
     if ($request->user_id) {
        $notification->user_id = $request->user_id;
    }
    if ($request->message) {
        $notification->message = $request->message;
    }
    if ($request->type) {
        $notification->type = $request->type;
    }
    if ($request->is_read) {
        $notification->is_read = $request->is_read;
    }




    $notification->save();

    return response()->json([
        'success' => true,
        'message' => 'Application updated successfully!',
        'data' => $notification,
    ], 200);
}
}

