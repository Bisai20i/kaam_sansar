<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentTypes = DocumentType::all();
        return view('backend.documenttype.index', compact('documentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view('backend.documenttype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'documentType' => 'required|string|max:255|unique:document_types,documentType',
        ]);

        DocumentType::create($validated);

        return redirect()->back()
            ->with('success', 'Document type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $documentType = DocumentType::findOrFail($id);
        // return view('backend.documenttype.show', compact('documentType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $documentType = DocumentType::findOrFail($id);
        // return view('backend.documenttype.create', compact('documentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'documentType' => 'required|string|max:255|unique:document_types,documentType,' . $id,
        ]);

        $documentType = DocumentType::findOrFail($id);
        $documentType->update($validated);

        return redirect()->back()
            ->with('success', 'Document type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documentType = DocumentType::findOrFail($id);
        $documentType->delete();

        return redirect()->back()
            ->with('success', 'Document type deleted successfully.');
    }
}
