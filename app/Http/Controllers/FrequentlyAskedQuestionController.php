<?php

namespace App\Http\Controllers;

use App\Models\FrequentlyAskedQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrequentlyAskedQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $faqs = FrequentlyAskedQuestion::latest()->get();

        return $isMobile
            ? $this->responseSuccess('FAQ list fetched successfully.', $faqs)
            : view('backend.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        return $isMobile
            ? $this->responseError('Mobile cannot access create form.', 403)
            : view('backend.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq = FrequentlyAskedQuestion::create([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return $isMobile
            ? $this->responseSuccess('FAQ created successfully.', $faq)
            : redirect()->route('faqs.index')->with('success', 'FAQ created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $faq = FrequentlyAskedQuestion::find($id);

        if (!$faq) {
            return $isMobile
                ? $this->responseError('FAQ not found.', 404)
                : redirect()->back()->with('error', 'FAQ not found.');
        }

        return $isMobile
            ? $this->responseSuccess('FAQ details fetched.', $faq)
            : view('faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $faq = FrequentlyAskedQuestion::find($id);

        if (!$faq) {
            return $isMobile
                ? $this->responseError('FAQ not found.', 404)
                : redirect()->back()->with('error', 'FAQ not found.');
        }

        return $isMobile
            ? $this->responseError('Mobile cannot access edit form.', 403)
            : view('backend.faqs.create', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $faq = FrequentlyAskedQuestion::find($id);

        if (!$faq) {
            return $isMobile
                ? $this->responseError('FAQ not found.', 404)
                : redirect()->back()->with('error', 'FAQ not found.');
        }

        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return $isMobile
            ? $this->responseSuccess('FAQ updated successfully.', $faq)
            : redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $faq = FrequentlyAskedQuestion::find($id);
        if (!$faq) {
            return $isMobile
                ? $this->responseError('FAQ not found.', 404)
                : redirect()->back()->with('error', 'FAQ not found.');
        }

        $faq->delete();

        return $isMobile
            ? $this->responseSuccess('FAQ deleted successfully.')
            : redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully.');
    }
    /**
     * Handle error response.
     */
    protected function responseError($message, $statusCode, $errors = [])
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }
    /**
     * Handle success response.
     */
    protected function responseSuccess($message, $data = [], $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}
