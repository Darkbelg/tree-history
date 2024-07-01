<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        try {
            $message->delete();

            // Return a success JSON response
            return response()->json(['message' => 'Message deleted successfully.']);
        } catch (\Exception $e) {
            // Log the exception
            Log::error($e->getMessage() . $e->getTraceAsString());

            // Return an error JSON response
            return response()->json(['error' => 'Failed to delete message.'], 500);
        }
    }
}
