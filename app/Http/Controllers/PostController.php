<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(){
        return view('create');
    }
    public function ourfilestore(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'mobile' => 'nullable',
            'email' => 'nullable',
            'image' => 'nullable|mimes:png,jpg,pdf',
        ]);
        
    
    $imageName=null;
     if(isset($request->image)){
        $imageName=time().'.'.$request->image->extension();
        $request->image->move(public_path('images'),$imageName);
     }
        
     
//Add new post
        $post= new Post;

        $post->name=$request->name;
        $post->designation=$request->designation;
        $post->mobile=$request->mobile;
        $post->email=$request->email;
        $post->image=$imageName;

        $post->save();
        return redirect()->route('home')-> with('success','your post has been created!');
    }

     public function editData($id){
        $post=Post::findOrFail($id);
        return view('edit',['ourPost'=>$post]);
     }

    public function updateData($id,Request $request){
        

        $validated = $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'mobile' => 'nullable',
            'email' => 'nullable',
            'image' => 'nullable|mimes:png,jpg,pdf',
        ]);
        
    
         
      
     //updata data
        $post=Post::findOrFail($id);
        $post->name=$request->name;
        $post->designation=$request->designation;
        $post->mobile=$request->mobile;
        $post->email=$request->email;
        if(isset($request->image)){
            $imageName=time().'.'.$request->image->extension();
            $request->image->move(public_path('images'),$imageName);
            $post->image=$imageName;
          }
            

        $post->save();
        return redirect()->route('home')-> with('success','your post has been updated!');
        
     }

     public function deleteData($id){
        $post=Post::findOrFail($id);
        $post->delete();
        flash()->error('your post has been deleted!');
        return redirect()->route('home');
     }

    public function searchData(Request $request){
       

    $query = $request->input('query');

    //$posts = Post::all(); // Or paginate if needed

    $results = [];
    if ($query) {
        $results = Post::where('name', 'like', '%' . $query . '%')
                       ->orWhere('designation', 'like', '%' . $query . '%')
                       ->orWhere('mobile', 'like', '%' . $query . '%')
                       ->orWhere('email', 'like', '%' . $query . '%')
                       ->get();
    }

    return view('search', compact( 'results', 'query'));


     }
}
