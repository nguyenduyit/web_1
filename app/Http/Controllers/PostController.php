<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Category;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $post=Post::with('student')->with('category')->with('report')->get();
        // dd($post);
        return view('admin.all_post')->with(compact('post'));
        // dd($post);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $post=Post::find($id);
        $post->status=$request->input('status');
        $post->save();
        return redirect(route('post.index'))->with('status',"Updating status successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=Post::find($id);
        $path='images/'.$post->image;
        if(file_exists($path)){
            unlink($path);
        }
        $post->delete();
        // dd($path);
        return redirect(route('post.index'))->with('status',"Deleting post successfully");
    }

    public function list_report($id){
        $post=Report::where('post_id',$id)->with('student')->get();
        // dd($post);
        return view('admin.list_report')->with(compact('post'));
    }
    public function search_time(Request $request){
        
        $month=date('m', strtotime($request->input('start')));
      
        $post= Post::whereRaw('MONTH(time) = ?',[$month])->get();
        // dd($post);
        // dd($post);
      
        return view('admin.all_post')->with(compact('post'));
    }
}
