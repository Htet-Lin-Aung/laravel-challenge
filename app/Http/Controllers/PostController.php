<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\ReactionRequest;
use Illuminate\Http\Response;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function list()
    {
        $posts = Post::withCount('likes')->get();
        
        $data = PostResource::collection($posts);
        
        return response()->json([
            'data' => $data,
        ]);
    }

    public function toggleReaction(ReactionRequest $request)
    {                
        $responseOwnPost = $this->checkOwnPost($request);
        $responseExist = $this->checkAlreadyExist($request);

        if($responseOwnPost || $responseExist)
        {
            return response()->json($responseOwnPost ?? $responseExist);
        }
        
        $responseCreate = $this->createReaction($request);
        return response()->json($responseCreate);
    }

    public function checkOwnPost($request)
    {
        $post = Post::find($request->post_id);

        if(!$post)
        {
            return [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Post not found'
            ];
        }
        
        if($post->author_id == auth()->id()) {
            return [
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => 'You cannot like your post'
            ];
        }

    }

    public function checkAlreadyExist($request)
    {
        $like = Like::where('post_id', $request->post_id)
                    ->where('user_id', auth()->id())
                    ->first();
        
        if($like && $request->like) {
            return [
                'status' => Response::HTTP_CONFLICT,
                'message' => 'You already liked this post'
            ];
        }elseif($like && !$request->like) {
            $like->delete();
            
            return [
                'status' => Response::HTTP_OK,
                'message' => 'You unliked this post successfully'
            ];
        }

    }

    public function createReaction($request)
    {
        Like::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id()
        ]);
        
        return [
            'status' => Response::HTTP_CREATED,
            'message' => 'You liked this post successfully'
        ];
    }
}

