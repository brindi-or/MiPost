<?php

namespace App\Http\Controllers;

use App\Events\NewLike;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

class LikeController extends Controller
{
    //
    public function store(Request $request, $post_id)
    {
        $post = Post::findOrFail($post_id);


        //on vérifie si l'utilisateur a déjà aimé le post
        $existingLike = $post->likes()->where('user_id',2)->first();

        if(!$existingLike){
            $post->likes()->create(['user_id' =>2]);
        }
        else{
            $existingLike->delete();
        }
        //ici on récupère le nouveau nombre de like
        $likesCount = $post->likes()->count();

        //on diffuse l'évènement
        Broadcast(new NewLike($post_id, $likesCount))->toOthers();

        return response()->json([
            'success'=>true,
            'likes_count' => $likesCount,
        'post' => $post]);
    }
}
