<?php

namespace App\Http\Controllers;
use App\Models\Faculty;
use App\Models\Major;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FacultyController extends Controller
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
        $faculty=Faculty::all();
        return view('admin.all_faculty')->with(compact('faculty'));
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
        return view('admin.add_faculty');
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
            'faculty'=> 'required',
        ],
        [
            'faculty.required'=>'Vui lòng nhập khoa',
        ]
    );
        $faculty=new Faculty();
        $faculty->name=$request->input('faculty');
        $faculty->save();
        return redirect(route('faculty.index'))->with('status',"Faculty added sucessfully");
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
        $faculty=Faculty::find($id);
        // print($faculty);
        return view('admin.edit_faculty')->with(compact('faculty'));
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
        $faculty=$request->validate([
            'faculty'=> 'required',
        ],
        [
            'faculty.required'=>'Vui lòng nhập khoa',
        ]
    );
        $faculty=Faculty::find($id);
        $faculty->name=$request->input('faculty');
        $faculty->save();
        return redirect(route('faculty.index'))->with('status',"Faculty updated sucessfully");
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
        $faculty=Faculty::find($id);
        $faculty->delete();
        return redirect(route('faculty.index'))->with('status',"Faculty deleted successfully");
    }

    public function fetchMajor(Request $request){
        $data['major'] = Major::where("faculty_id", $request->faculty_id)->get(["name", "id"]);
        // dd($data['major']);
        return response()->json($data);
    }
}
