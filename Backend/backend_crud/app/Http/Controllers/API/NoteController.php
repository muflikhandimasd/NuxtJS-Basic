<?php

namespace App\Http\Controllers\API;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Notes retrieved successfully',
            'data' => $notes
        ]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        Note::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Note created successfully',
            'data' => null
        ]);
    }

    public function show($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json([
                'status' => false,
                'message' => 'Note not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Note retrieved successfully',
            'data' => $note
        ]);
    }

    public function update(Request $request, $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json([
                'status' => false,
                'message' => 'Note not found',
                'data' => null
            ], 404);
        }

        $validator = \Validator::make($request->all(), [
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $note->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Note updated successfully',
            'data' => null
        ]);
    }

    public function destroy($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json([
                'status' => false,
                'message' => 'Note not found',
                'data' => null
            ], 404);
        }

        $note->delete();

        return response()->json([
            'status' => true,
            'message' => 'Note deleted successfully',
            'data' => null
        ]);
    }


}