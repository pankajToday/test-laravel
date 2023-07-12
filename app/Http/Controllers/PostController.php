<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    function fetchCategory(Request $request){
        return Category::select('id' ,'name')->orderBy('name','asc')->get();
    }

    function fetchUsers(){
        return User::select('id' ,'name')->orderBy('name','asc')->get();
    }

    function fetchPost(Request $request){

        return PostResource::collection(
            Post::when( $request->user_id ,  function ($q){
                    $q->where('posted_by' ,request('posted_by') );
                })
                ->when( $request->s_category_id ,  function ($q){
                    $q->where('category_id' ,request('s_category_id') );
                })
                ->when( $request->search ,  function ($q){
                    $q->where('title' ,'like','%'.request('s_category_id').'%' );
                })
                ->orderBy('id','desc')
                ->paginate(5)
        );
    }


    /**
     * Show the form for creating the resource.
     */
    public function create(): never
    {
        abort(404);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'posted_by' => 'required',
        ]);

        $post =  new Post();
        $post->title = $request->title ;
        $post->posted_by = $request->posted_by;
        $post->description = $request->description ;
        $post->category_id = $request->category_id ;
        $post->is_active = $request->status ;

        $post->save() ;
        return response()->json(['data'=>'post created.'],200);
    }



    /**
     * Update the resource in storage.
     */
    public function update(Request $request  )
    {
        $post =  Post::find($request->post_id);
        $post->title = $request->title ;
        $post->posted_by = $request->posted_by;
        $post->description = $request->description ;
        $post->category_id = $request->category_id ;
        $post->is_active = $request->status ;

       // $post->postedBy = '' ;

        $post->save() ;
        return response()->json(['data'=>'post updated.'],200);
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy($id)
    {
        $post =  Post::find($id);
      if(  $post )
      {
          $post->delete();
          return response()->json(['data'=>'post deleted!'],200);
      }
        return response()->json(['data'=>'unable to delete post!'],500);

    }


    function storeUser(Request $request){
        $user =  User::where(['email' => $request->email])->first();

        if( !$user)
        {
            $user =  new User();
        }
        $user->name =  $request->name;
        $user->email =  $request->email;
        $user->password =  Hash::make($request->password);

        $user->save();
        return response()->json(['data'=>'user created.'],200);
    }
}
