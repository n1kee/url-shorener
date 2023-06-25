<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function resolve($slug)
    {
        $url = Url::whereShortened($slug)->first();

        return redirect($url->original);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestUrls = Url::latest('id')->limit(10)->get();

        return response()->json([
            'urlList' => UrlResource::collection($latestUrls),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('url_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request)
    {
        $requestUrl = $request->input('url');

        $url = Url::firstOrCreate([
            'original' => $requestUrl,
        ]);

        $idx = $url->id - 1;

        $alphabet = range('a', 'z');

        $alphabetSize = count($alphabet);

        $urlLength = 1 + floor($idx / $alphabetSize);

        $shortenedUrl = '';

        while (--$urlLength) {
            $shortenedUrl .= current($alphabet);
        }

        $charIdx = $idx % count($alphabet);

        $shortenedUrl .= $alphabet[$charIdx];

        $url->shortened = $shortenedUrl;

        $url->save();

        $urlResource = (new UrlResource($url))->toArray($request);

        return response()->json([
            'url' => $urlResource['shortened'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Url $url)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUrlRequest $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
        //
    }
}
