<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Student;
use App\Models\Comment;
use App\Models\ReplyComment;
use Session;
use Illuminate\Support\Str;
use App\Http\Controllers\StudentController;
use  RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    //
    public function admin(){
        return view('login');
    }
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
    public function logout(){
        $this->CheckLogin();
        Session::put('admin_name',NULL);
        Session::put('admin_id',NULL);
        return Redirect::to('/');
    }
    public function login(Request $request){
        $data=$request->all();
        $data_username=Str::lower($request->username);
        $data_pasword=md5($request->password);
        $this->validate($request,[
          'username' => 'required',
          'password' => 'required',
        ],[
            'username.required'=>'Vui lòng nhập username',
            'password.required'=>'Vui lòng nhập password',
        ]
    );
        $admin=User::where('username',$data_username)->where('password',$data_pasword)->first();
        // print($admin);
       
        if($admin){
            // print($admin);
          
            Session::put('admin_name',$admin->username);
            Session::put('admin_id',$admin->id);
            return Redirect('/homeadmin');
            // print('abc');
        }
        else {
            $student=Student::where('maso',$data_username)->where('password',$data_pasword)->first();
            if($student){
                // print($data_username);
                // print($data_pasword);
                // print($student);
                Session::put('student_maso',$student->maso);
                Session::put('student_name',$student->name);
                Session::put('student_id',$student->id);
                // dd($sv);
                alert()->success('Success','Đăng nhập thành công');
               
                return redirect::to('student/all-post');
            }
            else {
                alert()->error('Failure','Đăng nhập thất bại');
                return Redirect('/');
            }
           
        }
      
    }
    public function homeadmin(){
        $this->CheckLogin();
        return view('admin.adminHome');
    }

    public function all_comment(){
        $comment=Comment::with('post')->with('student')->orderby('post_id','asc')->get();
        // dd($comment);
       return view('admin.all_comment')->with(compact('comment'));
    }
    public function delete_comment(Request $request,$id){
        $comment=Comment::find($id)->delete();
        return redirect::to('/allComment')->with('status',"Xoá bình luận thành công");
    }
    public function all_reply_comment(){
        $reply_comment=ReplyComment::with('comment')->with('student')->with('post')->orderby('post_id','asc')->get();
        // dd($reply_comment);
       return view('admin.all_replycomment')->with(compact('reply_comment'));
    }
    public function delete_replycomment(Request $request,$id){
        $replycomment=ReplyComment::find($id)->delete();
        return redirect::to('/allReplyComment')->with('status',"Xoá bình luận thành công");
    }
}
