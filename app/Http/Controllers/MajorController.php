<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Major;
use Session;
use Illuminate\Support\Facades\Redirect;

class MajorController extends Controller
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
        $major=Major::with('faculty')->orderBy('faculty_id','ASC')->get();
        // dd($major);
        // print($major);
        return view('admin.all_major')->with(compact('major'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $this->CheckLogin();
        $faculty=Faculty::all();
        return view('admin.add_major')->with(compact('faculty'));

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
        $faculty=$request->validate([
            'faculty_id'=> 'required',
            'major' => 'required',
        ],
        [
            'faculty_id.required'=>'Vui lòng chọn khoa',
            'major.required' => 'Vui lòng nhập ngành',
        ]
    );
        $major=new Major();
        $major->faculty_id=$request->input('faculty_id');
        $major->name=$request->input('major');
        $major->save();
        return redirect(route('major.index'))->with('status',"Major added successfully");
        // print_r($request->all());
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
        $major=Major::find($id);
        $faculty=Faculty::orderBy('id','DESC')->get();
        return view('admin.edit_major')->with(compact('major','faculty'));
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
        $major=$request->validate([
            'faculty_id'=> 'required',
            'major' => 'required',
        ],
        [
            'faculty_id.required'=>'Vui lòng chọn khoa',
            'major.required' => 'Vui lòng nhập ngành',
        ]);
        $major= Major::find($id);
        $major->faculty_id=$request->input('faculty_id');
        $major->name=$request->input('major');
        $major->save();
        return redirect(route('.index'))->with('status',"Major updated successfully");
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
        $major= Major::find($id)->delete();
        return redirect(route('major.index'))->with('status',"Major deleted sucessfully");
    }
}
