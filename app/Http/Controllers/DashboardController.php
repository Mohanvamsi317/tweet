<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $ideas=Idea::join('users', 'users.id', '=', 'ideas.user_id')
        ->select('ideas.*', 'users.profile_pic as profile_pic')
        ->orderby('created_at')   // select chat data and sender's name
        ->get();
        return view('dashboard', ['ideas'=>$ideas]);
    }

    public function share()
    {
        return view('share-tweet');
    }

    public function postTweet(Request $request)
    {
        // Validate and saveDashboardController the new post
        try{
        $request->validate([
            'tweet_content' => 'required|min:5|max:240',
            'media' =>'nullable|mimes:jpeg,png,mp4|max:5120'        
            ]);
            $user = Auth::user();
            $idea = new Idea();
            $idea->content = $request->tweet_content;
            $idea->user_id = $user->id;
            $idea->name = $user->name;
            if($request->hasFile('media'))
            {
                $path=$request->file('media')->store('media','public');
                $idea->media_type=$path;
            }
            $idea->save();
        
            return redirect()->route('dashboard')->with('success', 'Post created successfully!');
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
    

    public function destroy($id){
        //$ide=Idea::where('id',$id)->first();
        //$ide->delete();
        $idea=Idea::find($id);
        if ($idea) {
            $idea->delete();
            return redirect()->DashboardControllerroute('posts')->with('success', 'Post deleted successfully');
        }
        
        return redirect()->route('posts')->with('error', 'Post not found');
    }

    public function show($id)
    {

        $idea = Idea::find($id);

        return view('tweet-view', ['idea' => $idea]);
    }

    public function display(){
        $ideas= DB::table('ideas')->where('user_id', Auth::user()->id)->get();
        return view('posts', ['ideas'=> $ideas]);
    }
    public function profile(){
        $user = Auth::user();

        return view('profile', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to the login page
    }

    public function edit()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('profile.edit', compact('user'));
    }

    // Handle the update
    public function update(Request $request)
    {
        $id = $request->id ?? "";
    $user = User::findOrFail($id);

    // Validate the input
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle profile picture upload
    if ($request->hasFile('profile_pic')) {
        // Delete the old profile picture if it exists
        if ($user->profile_pic) {
            Storage::delete($user->profile_pic);
        }

        // Store the new profile picture
        $profilePicPath = $request->file('profile_pic')->store('profile_pics', 'public');
        $user->profile_pic = $profilePicPath;
    }

    // Update user details
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->save();

    // Redirect back to the profile page with a success message
    return redirect()->route('profile')->with('success', 'Profile updated successfully.');
}

public function updatelikes(Request $request, $current_user, $current_post_id)
{
    $is_like = Like::where('user_id', $current_user)
                    ->where('post_id',$current_post_id)
                    ->first();
    $like=Idea::find( $current_post_id);
    if($is_like)
    {
        $is_like->delete();
        $like->likes-=1;
        $like->save();
        return response()->json([
            'message'=>'unliked',
            'likes'=>$like->likes

        ]);
    }      
    else
    {
        Like::insert([
            'user_id'=> $current_user,
            'post_id'=> $current_post_id
        ]);
        $like->likes+=1;    
        $like->save();  
        return response()->json([
            'message'=>'liked',
            'likes'=>$like->likes
        ]);
    }        


}

public function setting()
{
    $user=Auth::User();
    return view('setting',compact('user'));
}

}