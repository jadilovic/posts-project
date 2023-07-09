<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('home', ['posts' => $posts]);
    }

    public function getMyPosts() {
        $posts = Post::whereUserId(Auth::id())->get();
        return view('myPosts', compact('posts'));
    }

    public function createPost() {
        $kategorije = PostCategory::all();
        return view('addPostForm', compact('kategorije'));
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'naslov' => 'required',
                'opis' => 'required',
                'cijena' => 'required',
                'kontakt' => 'required',
                'slika' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'kategorija' => 'required|exists:post_categories,id'
            ]);

            if ($request->hasFile('slika')) {
                $slika = $request->file('slika');
                $imeSlike = time() . '_' . $slika->getClientOriginalName();
                $slika->storeAs('public/slike', $imeSlike);

                Post::create([
                    'naslov' => $request->naslov,
                    'opis' => $request->opis,
                    'cijena' => $request->cijena,
                    'kontakt' => $request->kontakt,
                    'slika' => $imeSlike,
                    'category_id' => $request->kategorija,
                    'user_id' => Auth::id()
                ]);
            } else {
                Post::create([
                    'naslov' => $request->naslov,
                    'opis' => $request->opis,
                    'cijena' => $request->cijena,
                    'kontakt' => $request->kontakt,
                    'category_id' => $request->kategorija,
                    'user_id' => Auth::id()
                ]);
            }

            return redirect()->route('myPosts')->with('success', 'Oglas je uspjesno kreiran');
        } catch (\Throwable $th) {
            return redirect()->route('myPosts')->with('error', 'Oglas nije uspjesno kreiran');
        }
    }

    public function edit($id) {
        $post = Post::findOrFail($id);
        $kategorije = PostCategory::all();
        return view('editPostForm', compact('post', 'kategorije'));
    }

     public function update(Request $request, $id) {
        try {
            $post = Post::findOrFail($id);
            $post->naslov = $request->naslov;
            $post->opis = $request->opis;
            $post->cijena = $request->cijena;
            $post->kontakt = $request->kontakt;
            $post->category_id = $request->kategorija;
            $post->status = $request->has('status') ? 1 : 0;

            if ($request->hasFile('slika')) {
                $slika = $request->file('slika');
                $imeSlike = time() . '_' . $slika->getClientOriginalName();
                $slika->storeAs('public/slike', $imeSlike);
                $post->slika = $imeSlike;
            }
            $post->save();

            return redirect()->route('posts.edit', $id)->with('success', 'Uspjesno ste uredili oglas!');
        } catch (\Throwable $th) {
            return redirect()->route('posts.edit')->with('error', 'Oglas nije uspjesno uredjen');
        }
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('myPosts')->with('success', 'Uspjesno ste obrisali oglas!');
    }
}
