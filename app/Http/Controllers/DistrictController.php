<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\District;
use App\Models\Ward;

class DistrictController extends Controller
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
        $district=District::all();
        return view('admin.all_district')->with(compact('district'));
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
        return view('admin.add_district');
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
        $district=$request->validate([
            'district'=> 'required',
        ],
        [
            'district.required'=>'Vui lòng nhập quận',
        ]
    );
        $district= new District();
        $district->name=$request->input('district');
        $district->save();
        return redirect()->back()->with('status',"Course added successfully");
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
        $district=District::find($id);
        // dd($district);
        return view('admin.edit_district')->with(compact('district'));
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
        $district=$request->validate([
            'district'=> 'required',
        ],
        [
            'district.required'=>'Vui lòng nhập quận',
        ]
    );
        $district= District::find($id);
        $district->name=$request->input('district');
        $district->save();
        return redirect(route('district.index'))->with('status',"District updated successfully");
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
        $district=District::find($id)->delete();
        return redirect(route('district.index'))->with('status',"district deleted successfully");
    }

    public function fetchWard(Request $request){
        $data['ward'] = Ward::where("district_id", $request->district_id)->get(["name", "id"]);
        // dd($data['ward']);
        return response()->json($data);
    }
}
