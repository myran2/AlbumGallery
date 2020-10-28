<?php

namespace App\Http\Controllers;

use App\Models\Album;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    protected $rules = [
        'title'    => 'required|max:60',
        'artist'   => 'required|max:60',
        'filename' => 'required|max:130',
    ];

    /**
     * Laravel doesn't support testing for uniqueness on two columns inside the default validator
     * so we have to run the check seperately.
     * 
     * Just queries the DB for an existing album with the provided title and artist
     * and if it finds a match the validation fails.
     */
    private function validateTitleAndArtistUniqueness($request, $title, $artist)
    {
        $validator = Validator::make($request->all(), [
            'title' => Rule::unique('albums')->where(function($query) use($title, $artist) {
                return $query->where('title', $title)->where('artist', $artist);
            })],
            ['title.unique' => 'Album title and artist must be unique']
        )->validate();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        $title = $request->input('title');
        $artist = $request->input('artist');

        $this->validateTitleAndArtistUniqueness($request, $title, $artist);

        $album = $request->all();
        Album::create($album);

        return redirect('/')->with('success', 'Album created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        $data = [
            'album' => $album
        ];
        return view('album.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $this->validate($request, $this->rules);
        $title = $request->input('title');
        $artist = $request->input('artist');

        // make sure the "duplicate" album isn't the album we're trying to save
        if ($title != $album->title || $artist != $album->artist)
            $this->validateTitleAndArtistUniqueness($request, $title, $artist);

        $album->title = $request->input('title');
        $album->artist = $request->input('artist');

        $album->save();

        return redirect('/')->with('success', 'Album Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return redirect('/')->with('success', 'Album Deleted');
    }
}
