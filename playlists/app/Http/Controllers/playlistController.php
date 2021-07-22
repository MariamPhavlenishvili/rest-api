<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Playlists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class playlistController extends Controller
{
    public function createPlaylists(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'name' => 'required|max:30',
            'max_items' => 'required|integer'
        ]);

        Playlists::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'max_items' => $request->max_items
        ]);

        return response()->json([
            'message'=>"created successfully"]);
    }

    public function addMusic(Request $request, $id)
    {
        $request->validate([
            'music_name' => 'max:35',
            'music_url' => 'required'
        ]);

        Music::create([
            'playlist_id' => $id,
            'music_name' => $request->music_name,
            'music_url' => $request->music_url,
            'user_id' => $request->user_id
        ]);
    }

    public function deletePlaylist($id)
    {
        $playlist = Playlists::findOrFail($id);
        DB::table('music')->where('playlist_id', $id)->delete();
        $playlist->delete();
        return response()->json([
            'message'=>"deleted successfully"]);
    }

    public function deleteMusic($id)
    {
        $music = Music::findOrFail($id);
        $music->delete();
        return response()->json([
            'message'=>"music deleted successfully"]);
    }

    public function getAllPlaylists(Request $request)
    {
        if (DB::table('playlists')->where('user_id', $request->user_id)->exists())
        {
            return Playlists::where('user_id',$request->user_id)->get();
        }
        else
        {
            return response()->json([
                'message'=>"playlists don't exists"]);
        }
    }

    public function getAllMusic(Request $request)
    {

        if (DB::table('music')->where('user_id', $request->user_id)->exists())
        {
            return Music::where('user_id',$request->user_id)->get();
        }
        else
        {
            return response()->json([
                'message'=>"music doesn't exists"]);
        }

    }
}
