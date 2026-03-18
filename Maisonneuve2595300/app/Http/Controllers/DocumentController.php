<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::select()->orderby('created_at', 'desc')->paginate(5);
        return view('document.index', ['documents' => $documents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('document.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required',
            'title_fr' => 'nullable',
            'file' => 'required|file|mimes:pdf,doc,docx,zip|max:10240',
        ]);

        $title = array_filter([
            'en' => $request->title_en,
            'fr' => $request->title_fr,
        ]);

        $path = $request->file('file')->store('uploads/files', 'public');

        $document = Document::create([
            'title' => $title,
            'filename' => $path,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('documents.index')->with('success', 'File created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
         if ($document->user_id !== auth()->id()) {
        abort(403);
        }

        return view('document.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
         if ($document->user_id !== auth()->id()) {
        abort(403);
        }

        $request->validate([
            'title_en' => 'required',
            'title_fr' => 'nullable',
            'file' => 'nullable|file|mimes:pdf,doc,docx,zip|max:10240',
        ]);
    
        $data = [
            'title' => array_filter([
                'en' => $request->title_en,
                'fr' => $request->title_fr,
            ]),
        ];

        if ($request->hasFile('file')) {
            Storage::delete($document->filename);
            $data['filename'] = $request->file('file')->store('uploads/files');
        }   
            $document->update($data);

            return redirect()->route('documents.index')->with('success', 'File edit successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        if ($document->user_id !== auth()->id()) {
        abort(403);
        }

        Storage::delete($document->filename);
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'File supprimé avec succès');
    }
}
