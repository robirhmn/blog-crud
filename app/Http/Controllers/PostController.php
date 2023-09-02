<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n", $posts);
        //dd ddd, dan die merupakan syntax untuk debugging dan menampilkan data yang relevan
        // $view_data = [
        //     'posts' => $posts
        // ]; 
        
        //SELECT * FROM posts
        // $posts = DB::table('posts')
        //             ->select('id', 'title', 'content', 'created_at')
        //             ->where('active', true)
        //             ->get();
        // $posts = Post::active()->withTrashed()->get(); //withTrashed scope punyanya soft deletes dimana jika kita pakai method tersebut maka data yang dihapus secara softdelets akan ditampilkan juga

        // untuk mengecek apakah user sudah login atau belum biar ga bisa akses lewat url
        if(!Auth::check()){ 
            return redirect('login');
        }

        $posts = Post::active()->get(); //penggunaan active itu berkaitan dengan model post, cek function scopnya di model post
    
        $view_data = [
            'posts' => $posts,
        ];

        return view('posts.index', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::check()){ 
            return redirect('login');
        }

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::check()){ 
            return redirect('login');
        }

        $title = $request -> input('title'); //membaca request dari inputan form dimana title adalah nilai dari atribut name
        $content = $request -> input('content');

        // DB::table('posts')->insert([ cara query builder
        //     'title' => $title,
        //     'content' => $content,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);

        // Post::insert([ //cara eloquent pake model untuk berinteraksi dengan database
        //     'title' => $title,
        //     'content' => $content,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);
        Post::create([ //cara eloquent pake model untuk berinteraksi dengan database 
            'title' => $title, //create memiliki fungsi yang sama saja dengan insert namun pada create terdapat validasi dan trigger terhadap event
            'content' => $content, //created_at dan updated_at dihapus karena nanti akan terisi secara otomatis
        ]);

        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n", $posts);

        // $new_post = [
        //     count($posts) + 1,
        //     $title,
        //     $content,
        //     date('Y-m-d H:i:s')
        // ];
        // $new_post = implode(',', $new_post);

        // array_push($posts, $new_post);
        // $posts = implode("\n", $posts);
       
        // Storage::write('posts.txt', $posts);

        return redirect('posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n", $posts);
        // $selected_post = Array();
        // foreach($posts as $post){
        //     $post = explode(",", $post);
        //     if($post[0] == $id){
        //         $selected_post = $post;
        //     }
        // }
        
        // $post = DB::table('posts')
        //     ->select('id', 'title', 'content', 'created_at')
        //     ->where('id', '=', $id)
        //     ->first();
        
        if(!Auth::check()){ 
            return redirect('login');
        }

        $post = Post::where('id', '=', $id)->first();
        $comments = $post->comments()->limit(2)->get();
        $total_comments = $post->total_comments();

        $view_data = [
            'post' => $post,
            'comments' => $comments,
            'count' => $total_comments
        ];

        return view('posts.show', $view_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           
        // $post = DB::table('posts')
        //     ->select('id', 'title', 'content', 'created_at')
        //     ->where('id', '=', $id)
        //     ->first();

        if(!Auth::check()){ 
            return redirect('login');
        }

        $post = Post::where('id', '=', $id)->first();

        $view_data = [
            'post' => $post
        ];

        return view('posts.edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::check()){ 
            return redirect('login');
        }

        $title = $request->input('title');
        $content = $request->input('content');

        // DB::table('posts')
        //     ->where('id', $id)
        //     ->update([
        //         'title' => $title,
        //         'content' => $content,
        //         'updated_at' => date('Y-m-d H:i:s')
        //     ]);
        Post::where('id', $id)->update([
                'title' => $title,
                'content' => $content,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return redirect("posts/{$id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::check()){ 
            return redirect('login');
        }
        // DB::table('posts')
        //     ->where('id', $id)
        //     ->delete();
        Post::where('id', $id)->delete();

        return redirect("posts");
    }
}
