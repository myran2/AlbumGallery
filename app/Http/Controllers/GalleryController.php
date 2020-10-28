<?php

namespace App\Http\Controllers;

use App\Models\Album;
use DB;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $albums = Album::select('id', 'title', 'artist', 'filename')->get();
       $data = [
           'albums' => $albums
       ];
       return view('gallery')->with($data);
   }
}
