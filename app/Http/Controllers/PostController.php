<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function registerPosts(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            // 'user_id' => 'required|numeric|exists:users,id',
            'user_id' => 'required|numeric',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'img' => 'required|file|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return Response::ResponseBody(
                '302',
                'Invalid Request',
                'danger',
                $validator->errors()->all()
            );
        }

        $post_user_id = $request->user_id;
        $post_title = $request->title;
        $post_description = $request->description;
        $post_img = $request->file('img');

        $file_saved_name = time() . '.png';
        $post_img->move(public_path('/' . env('APP_FILE_PATH')), $file_saved_name);

        $data = [
            'user_id' => $post_user_id,
            'title' => $post_title,
            'img_url' => $file_saved_name,
            'description' => $post_description,
            'status' => 1,
        ];

        Post::create($data);

        return Response::ResponseBody(
            '200',
            'Successfully Saved Post',
            'success',
            null
        );
    }

    public function getPost(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // 'id' => 'required|numeric|exists:posts,id'
            'id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return Response::ResponseBody(
                '302',
                'Invalid Request',
                'danger',
                null
            );
        } else {
            return Response::ResponseBody(
                '200',
                null,
                null,
                Post::find($request->id)
            );
        }
    }

    public function getAllPosts(Request $request)
    {

        $query=Post::where('status', 1);

        if($request->has('search') && $request->filled('search')){
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        return Response::ResponseBody(
            '200',
            null,
            null,
            $query->get()
        );
    }
}
