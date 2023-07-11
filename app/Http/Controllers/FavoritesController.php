<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{

    public function index() {
        $user = Auth::user();
        $favorites = $user->favorites;
        $favoritePosts=array();
        foreach ($favorites as $favorite) {
            $post = Post::findOrFail($favorite->post_id);
            array_push($favoritePosts, $post);
        }
        return view('myFavorites', compact('favoritePosts', 'user'));
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'post_id' => 'required'
            ]);

             Favorite::create([
                    'user_id' => Auth::id(),
                    'post_id' => $request->post_id
                ]);

            return redirect()->route('posts', ['categoryId' => 0])->with('success', 'Oglas je uspjesno dodan u favorite');
        } catch (\Throwable $th) {
            return redirect()->route('posts', ['categoryId' => 0])->with('error', 'Oglas nije dodan u favorite');
        }
    }

    public function destroy($postId) {
        $favorite = Favorite::where('user_id', Auth::id())->where('post_id', $postId)->get();
        $favorite[0]->delete();

        return redirect()->route('myFavorites')->with('success', 'Uspjesno ste obrisali favorite!');
    }
}
