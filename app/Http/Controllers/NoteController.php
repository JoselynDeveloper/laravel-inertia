<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Inertia\Inertia;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Notes/Index', [
            'notes' => Note::orderBy('id', 'DESC')
            ->where(function ($query) use ($request) {
                if ($request->has('q')) {
                    $query->where('title', 'LIKE', '%' . $request->q . '%');
                }
            })
            ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Notes/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate inertia
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ], [
            'title.required' => 'El titulo es requerido.',
            'body.required' => 'El contenido es requerido.',
        ], [
            'title' => 'Titulo',
            'body' => 'Contenido',
        ]);

        //create note
        Note::create($request->all());

        #Return
        return redirect()->route('notes.index')->with([
            'success' => true,
            'message' => 'La nota se ha creado correctamente.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return Inertia::render('Notes/Show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return Inertia::render('Notes/Edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //validate inertia
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ], [
            'title.required' => 'El titulo es requerido.',
            'body.required' => 'El contenido es requerido.',
        ], [
            'title' => 'Titulo',
            'body' => 'Contenido',
        ]);

        // Clear errors inertia 
        $request->session()->forget('errors');
        

        //Update
        $note->update($request->all());

        //Redirect message
        return Inertia::render('Notes/Show', compact('note'))->with('success', 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('notes.index')->with([
            'success' => true,
            'message' => 'Note deleted successfully.',
        ]);
    }
}
