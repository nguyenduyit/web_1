<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Models\District;
use App\Models\Ward;


class WardController extends Controller
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
        $ward=Ward::with('district')->orderBy('district_id','ASC')->get();
        // dd($ward);
        return view('admin.all_ward')->with(compact('ward'));
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
        $district=District::all();
        return view('admin.add_ward')->with(compact('district'));
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
        $ward=$request->validate([
            'district_id'=> 'required',
            'ward' => 'required',
        ],
        [
            'district_id.required'=>'Vui lòng chọn quận',
            'ward.required' => 'Vui lòng nhập ngành',
        ]
    );
        $major=new Ward();
        $major->district_id=$request->input('district_id');
        $major->name=$request->input('ward');
        $major->save();
        return redirect(route('ward.index'))->with('status',"ward added successfully");

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
        $ward=Ward::find($id);
        $district=District::orderBy('id','ASC')->get();
        return view('admin.edit_ward')->with(compact('ward','district'));
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
        $ward=$request->validate([
            'district_id'=> 'required',
            'ward' => 'required',
        ],
        [
            'district_id.required'=>'Vui lòng chọn quận',
            'ward.required' => 'Vui lòng nhập ngành',
        ]
    );
        $ward=Ward::find($id);
        $ward->district_id=$request->input('district_id');
        $ward->name=$request->input('ward');
        $ward->save();
        return redirect(route('ward.index'))->with('status',"ward updated successfully");
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
        $ward=Ward::find($id)->delete();
        return redirect(route('ward.index'))->with('status',"ward deleted sucessfully");
    }
}
