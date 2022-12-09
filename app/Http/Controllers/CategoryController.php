<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use Session;

class CategoryController extends Controller
{
    public function CheckLogin(){
        $admin_id=null;
        $admin_name=null;
        if(Session::get('admin_id') && Session::get('admin_name')){
            $admin_id=Session::get('admin_id');
        }
        else{
           Session::put('admin_id',NULL);
           Session::put('admin_name',NULL);
        }
 
        if($admin_id){
            return Redirect::to('/homeadmin');
        }else{
         return Redirect::to('/')->send();
        }
       
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->CheckLogin();
        $category=Category::all();
        return view('admin.all_category')->with(compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->CheckLogin();
        return view('admin.add_category');
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
        $this->CheckLogin();
        $category=$request->validate(
            [
                'category'=>'required',
            ],
            [
                'category.required'=>'Vui lòng nhập danh mục',
            ]
        
        );
        $category = new Category();
        $category->name=$request->input('category');
        $category->save();
        return redirect(route('category.index'))->with('status','Category added successfully');
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
        $this->CheckLogin();
        $category=Category::find($id);
        return view('admin.edit_category')->with(compact('category'));
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
        $this->CheckLogin();
        $category=$request->validate(
            [
                'category'=>'required',
            ],
            [
                'category.required'=>'Vui lòng nhập danh mục',
            ]
        
        );
        $category=Category::find($id);
        $category->name=$request->input('category');
        $category->save();
        return redirect(route('category.index'))->with('status','Category updated successfully');
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
        $this->CheckLogin();
        $category=Category::find($id)->delete();
        return redirect(route('category.index'))->with('status','Category deleted successfully');
    }
}
