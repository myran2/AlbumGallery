<?php

namespace App\Http\Controllers;

use App\Models\Album;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Manually validate input from the create/edit forms
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    private function validateFormInput($request)
    {
        $title = $request->input('title');
        $artist = $request->input('artist');
        
        $validator = Validator::make($request->all(), [
            /**
             * Laravel doesn't support testing for uniqueness on two columns inside the default validator
             * so we have to run the check seperately.
             *
             * Just queries the DB for an existing album with the provided title and artist
             * and if it finds a match the validation fails.
             */
            'title' => ['required', 'max:60', Rule::unique('albums')->where(function($query) use($title, $artist) {
                return $query->where('title', $title)->where('artist', $artist);
            })],
            'artist' => ['required', 'max:60'],
            'image' => ['mimes:jpeg,jpg,png,gif', 'max:2048']
            ],
            ['title.unique' => 'Album title and artist must be unique']
        )->validate();
    }

    /**
     * Parses an image from the given request
     * and stores it in the /storage/app/public directory
     * after running php artisan storage:link
     * that directory will be symlinked to /public/storage
     * 
     * A fun thing to do thats a bit outside of the scope
     * of this project would be to create a File model/table that
     * stores a name and hash of an image, then check that
     * table for duplicates when uploading a new image.
     * This implementation just uploads whatever and gives it a unique name,
     * so there's no chance of collisions.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return string - filename of the uploaded image
     */
    private function handleImageUpload($request)
    {
        // image is empty
        if (!$request->hasFile('image'))
            return '';

        $fullpath = $request->file('image')->store('public');
        return explode('/', $fullpath)[1];
    }
    
    /**
     * No support for viewing one album at a time because they're meant to be displayed in a gallery.
     * So we just redirect to the gallery if an album is accessed directly.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return redirect('/');
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $albums = Album::select('id', 'title', 'artist', 'image')->get();
       $data = [
           'albums' => $albums
       ];
       return view('gallery')->with($data);
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
        $this->validateFormInput($request);

        $album = $request->all();
        $img = $this->handleImageUpload($request);
        if ($img == '')
            $album['image'] = 'nocover.png';
        else
            $album['image'] = $img;

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
        $title = $request->input('title');
        $artist = $request->input('artist');

        // make sure when we check for duplicate album/artist pairs that we aren't checking this album against itself
        if ($title != $album->title || $artist != $album->artist)
            $this->validateFormInput($request);
        
        $album->title = $title;
        $album->artist = $artist;

        // if user doesn't specify a new album cover, just use the old one
        $img = $this->handleImageUpload($request);
        if ($img != '')
            $album->image = $img;

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
        // delete cover image from storage as long as it isn't the default cover
        if ($album->image != 'nocover.png')
            unlink(storage_path('app/public/'. $album->image));

        // delete db record
        $album->delete();
        return redirect('/')->with('success', 'Album Deleted');
    }
}
