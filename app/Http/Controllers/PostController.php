<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(){

        $postsFromDB = Post::all(); // collection object, it is an array but i can access it like object thanks to magic method in php

        return view("posts.index", ["posts"=> $postsFromDB]);
    }

    public function show(Post $post){
        // $singlePostFromDB = Post::where("id", $postId)->first(); // model object, without ->first() = query bulder

        // $singlePostFromDB = Post::where("id", $postId)->get(); // collection object

        // select * from posts where id = $postId
        // $singlePostFromDB = Post::findOrFail($postId); // model object or throw exeption
        // if no model return from dataBase $singlePostFromDB == null

        // if (is_null($singlePostFromDB)) {
        //     return to_route("posts.index");
        // }

        return view("posts.show", ['post'=> $post]);
    }

    public function create(){
        $users = User::all();
        return view('posts.create', ['users'=> $users]);
    }

    public function store(){

        // $data = request()->all(); // request() access to request object

        request()->validate([
            'title' => ['required', 'string', 'min:3'],
            'descriptoin' => ['required', 'string', 'mim:5'],
            'post_creator' => ['required', 'exists:users,id'],
        ]);

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);

        return to_route('posts.index'); // to_route == redirect to route
    }

    public function edit(Post $post){ // model route binding for access to post from param from route
        $user = User::find($post->user_id);
        return view('posts.edit', ['user'=> $user, 'post'=> $post]);
    }

    public function update($postId){

        request()->validate([
            'title' => ['required', 'string', 'min:3'],
            'descriptoin' => ['required', 'string', 'mim:5'],
            'post_creator' => ['required', 'exists:users,id'],
        ]);

        $singlePostFromDB = Post::find($postId);

        $singlePostFromDB->update([
            'title'=> $singlePostFromDB->title,
            'description'=> $singlePostFromDB->description,
            'user_id' => $singlePostFromDB->post_creator,
        ]);
        return to_route('posts.show', $postId);
    }

    public function destroy ($postId){
        $singlePostFromDB = Post::find($postId);
        $singlePostFromDB->delete();

        return to_route('posts.index');
    }


}
