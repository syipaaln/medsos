<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feed = Feed::latest()->paginate(2);
        return view('feed.index', compact('feed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feed.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video' => ['required', 'mimes:mp4', 'max:10240'],
            'caption' => ['nullable', 'string', 'max:100'],
        ]);

        $user = auth()->user();
        $feed = new Feed;
        $feed->created_by = $user->id;
        $feed->video =$request->file('video')->store('feed');
        $feed->caption = $request->caption;
        $feed->save();

        // Redirect ke halaman index dan tampilkan alert
        return redirect(route('feed.index'))->with('success','Video berhasil ditambahkan!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feed $feed)
    {
        // Hapus dari public\storage\feed
        if($feed->video) {
            Storage::delete($feed->video);
        }   

        // Hapus dan redirect ke halaman index serta tampilkan alert success
        if($feed->delete()) {
            return redirect(route('feed.index'))->with('success', 'Video berhasil dihapus!');
        }

        // Redirect ke halaman index dan tampilkan alert error
        return redirect(route('feed.index'))->with('error', 'Video gagal dihapus!');
    }
}
