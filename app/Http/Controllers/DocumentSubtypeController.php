<?php

namespace App\Http\Controllers;

use App\Models\DocumentSubtype;
use Illuminate\Http\Request;

class DocumentSubtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentSubtypes = DocumentSubtype::all();
        return view('backend.documentsubtype.index', compact('documentSubtypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'documentSubtype' => 'required|string|max:255|unique:document_subtypes,documentSubtype',
        ]);

        DocumentSubtype::create($validated);

        return redirect()->back()->with('success', 'Document subtype created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $documentSubtype = DocumentSubtype::findOrFail($id);
        // return view('backend.documentsubtype.show', compact('documentSubtype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documentSubtype = DocumentSubtype::findOrFail($id);
        return view('backend.documentsubtype.create', compact('documentSubtype'));
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
            'documentSubtype' => 'required|string|max:255|unique:document_subtypes,documentSubtype,'.$id,
        ]);

        $documentSubtype = DocumentSubtype::findOrFail($id);
        $documentSubtype->update($validated);

        return redirect()->back()->with('success', 'Document subtype updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documentSubtype = DocumentSubtype::findOrFail($id);
        $documentSubtype->delete();
        return redirect()->back()->with('success', 'Document subtype deleted successfully.');
    }
}