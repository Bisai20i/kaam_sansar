<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BlogsAndPodcast;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BlogsAndPodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogsAndPodcasts = BlogsAndPodcast::when(
            in_array($request->type, ['blog', 'podcast']),
            fn($query) => $query->where('blogOrPodcast', $request->type)
        )
            ->latest()
            ->simplePaginate(5);

        $type =  $request->type ?? 'Blogs and Podcast';

        return view('backend.blogsandpodcast.lists', compact('blogsAndPodcasts', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blogsandpodcast.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {


        // Validate the request
        $request->validate([
            'blogOrPodcast' => 'required|in:blog,podcast',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'imageUrl' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'croppedImageBase64' => 'nullable|string',
            // 'linkUrl' => 'required_if:blogOrPodcast,podcast|url',
            // 'podcastTime' => 'required_if:blogOrPodcast,podcast|string',

        ]);

        try {
            // Directory to store images
            $folderPath = 'blog_or_podcast_images';
            $imagePath = null;

            // Handle the image upload (Base64 or file)
            if ($request->filled('croppedImageBase64')) {
                $croppedImage = $request->input('croppedImageBase64');
                list(, $imageData) = explode(',', $croppedImage); // Extract base64 content
                $decodedImage = base64_decode($imageData);

                $imageName = time() . '_cropped.jpg';
                $imagePath = "$folderPath/$imageName";

                Storage::disk('public')->put($imagePath, $decodedImage);
            } elseif ($request->hasFile('imageUrl')) {
                $image = $request->file('imageUrl');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = "$folderPath/$imageName";

                $resizedImage = Image::make($image);
                $resizedImage->resize(500, 400, function ($constraint) {
                    $constraint->aspectRatio();
                });

                Storage::disk('public')->put($imagePath, $resizedImage->encode('jpg', 90));
            }

            // Ensure a unique slug
            $uniqueSlug = $this->generateUniqueSlug($request->title);

            // Create a new BlogOrPodcast record
            $blogOrPodcast = BlogsAndPodcast::create([
                'blogOrPodcast' => $request->blogOrPodcast,
                'slug' => $uniqueSlug,
                'title' => $request->title,
                'description' => $request->description,
                'imageUrl' => $imagePath,
                'linkUrl' => $request->linkUrl,
                'podcastTime' => $request->podcastTime,
            ]);

            return redirect()->route('blogsAndPodcast.index')->with('success', 'Blog/Podcast created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Blog/Podcast. ' . $e->getMessage());
        }
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = BlogsAndPodcast::where('slug', 'like', "$slug%")->count();

        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogsAndPodcast  $blogsAndPodcast
     * @return \Illuminate\Http\Response
     */
    public function show(BlogsAndPodcast $blogsAndPodcast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogsAndPodcast  $blogsAndPodcast
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogsAndPodcast $blogsAndPodcast)
    {
        $type = $blogsAndPodcast->blogOrPodcast;


        return view('backend.blogsandpodcast.create', compact('blogsAndPodcast', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogsAndPodcast  $blogsAndPodcast
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the record to update
        $blogOrPodcast = BlogsAndPodcast::findOrFail($id);

        // Validate the request
        $request->validate([
            'blogOrPodcast' => 'required|in:blog,podcast',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'imageUrl' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'croppedImageBase64' => 'nullable|string',
            'linkUrl' => 'required_if:blogOrPodcast,podcast|url',
            'podcastTime' => 'required_if:blogOrPodcast,podcast|string',
        ]);

        // Directory to store images
        $folderPath = 'blog_or_podcast_images';
        $imagePath = $blogOrPodcast->imageUrl; // Keep the existing image path by default

        // Handle the image upload (Base64 or file)
        if ($request->filled('croppedImageBase64')) {
            $croppedImage = $request->input('croppedImageBase64');
            list(, $imageData) = explode(',', $croppedImage); // Extract base64 content
            $decodedImage = base64_decode($imageData);

            $imageName = time() . '_cropped.jpg';
            $imagePath = "$folderPath/$imageName";

            Storage::disk('public')->put($imagePath, $decodedImage);

            // Delete the old image if it exists
            if ($blogOrPodcast->imageUrl && Storage::disk('public')->exists($blogOrPodcast->imageUrl)) {
                Storage::disk('public')->delete($blogOrPodcast->imageUrl);
            }
        } elseif ($request->hasFile('imageUrl')) {
            $image = $request->file('imageUrl');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = "$folderPath/$imageName";

            $resizedImage = Image::make($image);
            $resizedImage->resize(1024, 1024, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::disk('public')->put($imagePath, $resizedImage->encode('jpg', 90));

            // Delete the old image if it exists
            if ($blogOrPodcast->imageUrl && Storage::disk('public')->exists($blogOrPodcast->imageUrl)) {
                Storage::disk('public')->delete($blogOrPodcast->imageUrl);
            }
        }

        // Ensure a unique slug if the title has changed
        if ($blogOrPodcast->title !== $request->title) {
            $uniqueSlug = $this->generateUniqueSlug($request->title);
        } else {
            $uniqueSlug = $blogOrPodcast->slug;
        }

        // Update the BlogOrPodcast record
        $blogOrPodcast->update([
            'blogOrPodcast' => $request->blogOrPodcast,
            'slug' => $uniqueSlug,
            'title' => $request->title,
            'description' => $request->description,
            'imageUrl' => $imagePath,
            'linkUrl' => $request->linkUrl,
            'podcastTime' => $request->podcastTime,
        ]);

        return redirect()->route('blogsAndPodcast.index')->with('success', 'Blog/Podcast updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogsAndPodcast  $blogsAndPodcast
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Find the BlogOrPodcast record by ID
            $blogOrPodcast = BlogsAndPodcast::findOrFail($id);
            // Delete the image if it exists
            if ($blogOrPodcast->imageUrl && Storage::disk('public')->exists($blogOrPodcast->imageUrl)) {
                Storage::disk('public')->delete($blogOrPodcast->imageUrl);
            }
            // Delete the record
            $blogOrPodcast->delete();

            return redirect()->back()->with('success', 'Blog/Podcast deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Blog/Podcast. ' . $e->getMessage());
        }
    }

    public function publish($id)
    {

        $blogsAndPodcast = BlogsAndPodcast::find($id);

        $blogsAndPodcast->publishStatus = '1';
        $blogsAndPodcast->save();
        return redirect()->back()->with('success', 'Blog/Podcast published successfully.');
    }

    public function unpublish($id)
    {
        $blogsAndPodcast = BlogsAndPodcast::find($id);

        // If not found, you might want to handle that case
        if (!$blogsAndPodcast) {
            return redirect()->route('blogsAndPodcast.index')->with('error', 'Blog/Podcast not found.');
        }

        $blogsAndPodcast->publishStatus = '0';
        $blogsAndPodcast->save();

        return redirect()->back()->with('success', 'Blog/Podcast unpublished successfully.');
    }
}