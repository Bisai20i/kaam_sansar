<?php

namespace App\Http\Controllers;

use App\Models\DocumentPurpose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentPurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentPurposes = DocumentPurpose::get();
        return view('backend.documentpurpose.index', compact('documentPurposes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('backend.documentpurpose.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'documentPurpose' => 'required|string|max:255|unique:document_purposes,documentPurpose',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DocumentPurpose::create([
            'documentPurpose' => $request->documentPurpose,
        ]);

        return redirect()->back()->with('success', 'Document purpose created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Implementation can be added here if needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $documentPurpose = DocumentPurpose::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'documentPurpose' => 'required|string|max:255|unique:document_purposes,documentPurpose,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $documentPurpose->update([
            'documentPurpose' => $request->documentPurpose,
        ]);

        return redirect()->back()
            ->with('success', 'Document purpose updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documentPurpose = DocumentPurpose::findOrFail($id);
        $documentPurpose->delete();

        return redirect()->back()
            ->with('success', 'Document purpose deleted successfully.');
    }
}
