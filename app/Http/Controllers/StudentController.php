<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Course;
use App\Models\Major;
use App\Models\Student;
use App\Models\Category;
use App\Models\Post;
use App\Models\District;
use App\Models\Ward;
use App\Models\Comment;
use App\Models\Confirm;
use App\Models\ReplyComment;
use App\Models\Rating;
use App\Models\Report;
use App\Models\Follow;
use App\Models\BlackList;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Session;
use RealRashid\SweetAlert\Facades\Alert;
use Mail;
use App\Mail\TestMail;
use App\Mail\AgreeMail;
use App\Mail\DisagreeMail;
use App\Mail\CancelConfirmMail;
use Antoineaugusti\LaravelSentimentAnalysis\SentimentAnalysis;
use Illuminate\Support\Facades\URL;
use App\Notifications\StudentConfirmNotification;
use Illuminate\Notifications\Notifiable;
use App\Models\Notifications;
use Illuminate\Routing\UrlGenerator;

class StudentController extends Controller
{
    public $danhsachkhen = array ("thích","Đẹp","tốt","chất lượng");
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
     public function CheckLogin_student(){
        $student_maso=null;
        $student_name=null;
        if( Session::get('student_name') && Session::get('student_maso')){
            $student_name=Session::get('student_name');
            $student_maso=Session::get('student_maso');
        }
        else{
           Session::put('student_maso',NULL);
           Session::put('student_name',NULL);
        }
 
        if($student_name && $student_maso){
            return Redirect::to('/student/home');
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
        $student=Student::with('course')->with('major')->with('faculty')->orderBy('course_id','ASC')->get();
        return view('admin.all_student')->with(compact('student'));
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
        $course=Course::all();
        $faculty=Faculty::all();
        // $major=Major::all();
        return view('admin.add_student')->with(compact('course','faculty'));
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
        $student=$request->validate(
            [
            'student_maso' => ['required' ,'regex:/^[b|B]{1}[0-9]{7}+$/'],
            'student_name' => 'required | string',
            'course_id' => 'required',
            'faculty_id' => 'required',
            'major_id' => 'required',
            
           
          
        ],
        [
            'student_maso.required' => 'Nhập mã số',
            'student_maso.regex' => 'Không đúng định dạng "B1809444" hoặc "b1809444"',
            'student_name.required' => 'Nhập họ và tên',
            'course_id.required' => 'Chọn khoá',
            'faculty_id.required' => 'Chọn khoá',
            'major_id.required' => 'Chọn ngành',
        ]
      
    );
        $student=new Student();
        $student->maso=$request->input('student_maso');
        $student->name=$request->input('student_name');
        $student->course_id=$request->input('course_id');
        $student->faculty_id=$request->input('faculty_id');
        $student->major_id=$request->input('major_id');
        $student->save();
        return redirect(route('student.index'))->with('status',"Student added successfully");
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
        $student=Student::find($id);
        $faculty=Faculty::all();
        $course=Course::all();
        return view('admin.edit_student')->with(compact('student','course','faculty'));

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
        $student=$request->validate(
            [
            'student_maso' => ['required' ,'regex:/^[b|B]{1}[0-9]{7}+$/'],
            'student_name' => 'required | string',
            'course_id' => 'required',
            'faculty_id' => 'required',
            'major_id' => 'required',
            
           
          
        ],
        [
            'student_maso.required' => 'Nhập mã số',
            'student_maso.regex' => 'Không đúng định dạng "B1809444" hoặc "b1809444"',
            'student_name.required' => 'Nhập họ và tên',
            'course_id.required' => 'Chọn khoá',
            'faculty_id.required' => 'Chọn khoá',
            'major_id.required' => 'Chọn ngành',
        ]
      
    );
        $student=Student::find($id);
        $student->maso=$request->input('student_maso');
        $student->name=$request->input('student_name');
        $student->course_id=$request->input('course_id');
        $student->faculty_id=$request->input('faculty_id');
        $student->major_id=$request->input('major_id');
        $student->save();
        return redirect(route('student.index'))->with('status',"Student updated successfully");

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
        $student=Student::findOrFail($id)->delete();
        return redirect(route('student.index'))->back()->with('status',"Student deleted successfully");
    }

    public function home(){
        $this->CheckLogin_student();
        $category=Category::all();
        $post=Post::with('student')->with('category')->where('status',1)->get();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $user=Student::find(Session::get('student_id'));
        $major=Major::where('faculty_id',3)->get();
        $district= District::get();
       
        return view('student.home')->with(compact('category','post','confirm','district','user','major'));
    }

    public function create_post(){
        $category=Category::all();
        $district= District::get();
        $user=Student::find(Session::get('student_id'));
        $major=Major::where('faculty_id',3)->get();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        return view('student.create_post')->with(compact('category','district','confirm','user','major'));
    }

    public function save_post(Request $request){
        $this->CheckLogin_student();
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'required|max:5000',
        ],
        [
            'title.required' => 'Nhập nội dung',
            'category_id.required' => 'Chọn danh mục',
            'image.required' => 'Thêm ảnh',
            
        ]
    );
        // dd($request->file('image'));
        $title=$request->input('title');
        $student_id=Session::get('student_id');
        $category_id=$request->input('category_id');
        $image = array();
        if($request->hasfile('image')){
            $files=$request->file('image');
            foreach($files as $file){
                $file_name=time().rand(1,2000).'.'.$file->getClientOriginalExtension();
                // $upload_path='public/images/';
                // $image_url=$upload_path.$file_name;
                $file->move(public_path('images'),$file_name);
                $image[] = $file_name; 

            }
        }
        // dd($image);
        if($request->input('price')){
            $price=$request->input('price');
            $post= new Post();
            $post->title=$title;
            $post->image=implode('|',$image);
            $post->price=$price;
            $post->student_id=$student_id;
            $post->category_id=$category_id;
            $post->time=date('Y-m-d H:i:s');
            // dd($image);
        }
        
        $post= new Post();
        $post->title=$title;
        $post->image=implode('|',$image);
        $post->student_id=$student_id;
        $post->category_id=$category_id;
        $post->time=date('Y-m-d H:i:s');
        // dd($image);
        $post->save();
        Alert::success('Thành công',"Đăng bài thành công");
        return redirect('student/all-post');
      
    }

    public function logout(){
        $this->CheckLogin_student();
        Session::put('student_maso',NULL);
        Session::put('student_name',NULL);
        return Redirect::to('/');
    }

    public function all_post(){
        $this->CheckLogin_student();
        $category=Category::all();
        $post=Post::orderBy('id','DESC')->with('confirm')->get();
        $user=Student::find(Session::get('student_id'));
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->with('post')->get();
        $district= District::get();
        $major=Major::where('faculty_id',3)->get();
        // dd($major);
        // dd($user->notifications);
        return view('student.all_post')->with(compact('post','category','confirm','district','user','major'));
    }


    public function profile($id){
        $this->CheckLogin_student();
        $category=Category::all();
        $post=Post::where('student_id',$id)->orderBy('id','DESC')->with('confirm')->get();
        $student=Student::where('id',$id)->with('course')->with('major')->with('ward')->with('district')->first();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $district= District::get();
        $major=Major::where('faculty_id',3)->get();
        $user=Student::find(Session::get('student_id'));
        $rating=Rating::where('rated_student',$id)->get();
        $list_follow=Follow::where('student_id',$id)->with('student_follow')->get();
        $average=0;
        if($rating->count()!=0){
            $rating_sum=Rating::where('rated_student',$id)->sum('rated');
            $average=round($rating_sum/$rating->count());
        }
        else $average=0;
        // dd($confirm);
        return view('student.profile_allpost')->with(compact('post','category','student','confirm','district','rating','average','user','major','list_follow'));
       
    }

    // public function profile_allpost($id){
    //     $this->CheckLogin_student();
    //     $category=Category::all();
    //     $post=Post::where('student_id',$id)->orderBy('id','DESC')->with('confirm')->get();
    //     $student=Student::where('id',$id)->with('course')->with('major')->with('ward')->with('district')->first();
    //     $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
    //     $district= District::get();
    //     $major=Major::where('faculty_id',3)->get();
    //     $user=Student::find(Session::get('student_id'));
    //     $rating=Rating::where('rated_student',$id)->get();
    //     $average=0;
    //     if($rating->count()!=0){
    //         $rating_sum=Rating::where('rated_student',$id)->sum('rated');
    //         $average=round($rating_sum/$rating->count());
    //     }
    //     else $average=0;
    //     // $follow=Follow::where('student_id',Session::get('student_id'))->with('student_follow')->first();
      
    //     // dd($follow);
    //     return view('student.profile_allpost')->with(compact('post','category','student','confirm','district','rating','average','user','major'));
    // }

    public function update_avatar($id){
        $this->CheckLogin_student();
        $category=Category::all();
        $student=Student::where('id',$id)->first();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $district= District::get();
        // dd($student);
        $user=Student::find(Session::get('student_id'));
        return view('student.update_avatar')->with(compact('student','category','confirm','district','user'));
    }


    public function save_avatar(Request $request,$id){
        $this->CheckLogin_student();
        $request->validate([
            'avatar' => 'required',
        ],
        [
            'avatar.required' => 'Vui lòng chọn hình',
        ]
        
    );
        // dd($request->file('avatar'));
        $image=null;
        if($request->hasfile('avatar')){
            $file=$request->file('avatar');
            $file_name=time().rand(1,2000).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'),$file_name);
            $image=$file_name;
           
        }
        $student=Student::find($id);
        $student->image=$image;
        // dd($student->image);
        $student->save();
        // dd($student);
        Alert::success('Thành công',"Cập nhật ảnh đại diện thành công");
        return redirect::to('student/profile/'.$id);
    }

    public function update_profile($id){
        $category=Category::all();
        $student=Student::where('id',$id)->with('district')->with('ward')->first();
        $district=District::all();
        $ward=Ward::all();
        $user=Student::find(Session::get('student_id'));
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        // dd($student);
        return view('student.update_profile')->with(compact('category','student','district','ward','confirm','user'));

    }

    public function save_profile(Request $request,$id){
        $this->CheckLogin_student();
        $request->validate([
            'district_id' => 'required',
            'ward_id' => 'required',
            'phone' => ['required' ,'regex:/^0[0-9]{9}+$/']
        ],
        [
            'district_id.required' => 'Vui lòng chọn quận', 
            'ward_id.required' => 'Vui lòng chọn phường',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Không đúng định dạng số điện thoại',
        ],
      
    );
        $student=Student::find($id);
        $student->district_id=$request->input('district_id');
        $student->ward_id=$request->input('ward_id');
        $student->phone=$request->input('phone');
        $student->save();
        Alert::success('Thành công',"Cập nhật thông tin cá nhân");
        return redirect::to('student/profile/'.$id);
    }

    public function student_edit_post($id,$post_id){
       $category=Category::all();
       $post=Post::where('id',$post_id)->with('student')->with('category')->first();
       $confirm=Confirm::where('owner_id_post',Sesion::get('student_id'))->with('student')->get();
       $district= Distirct::get();
       $user=Student::find(Session::get('student_id'));
       return view('student.edit_post')->with(compact('category','post','confirm','district','user'));
       
    }

    public function student_update_post(Request $request,$id,$post_id){
        $this->CheckLogin_student();
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'required|max:5000',
        ],
        [
            'title.required' => 'Nhập nội dung',
            'category_id.required' => 'Chọn danh mục',
            'image.required' => 'Thêm ảnh',
            
        ]
    );
        // dd($request->file('image'));
        $title=$request->input('title');
        $student_id=$id;
        $category_id=$request->input('category_id');
        $status=$request->input('status');
        $image = array();
        if($request->hasfile('image')){
            $files=$request->file('image');
            foreach($files as $file){
                $file_name=time().rand(1,1000).'.'.$file->getClientOriginalExtension();
                // $upload_path='public/images/';
                // $image_url=$upload_path.$file_name;
                $file->move(public_path('images'),$file_name);
                $image[] = $file_name; 

            }
        }
        // dd($image);
        if($request->input('price')){
            $price=$request->input('price');
            $post= Post::find($post_id);
            $post->title=$title;
            $post->image=implode('|',$image);
            $post->price=$price;
            $post->student_id=$student_id;
            $post->category_id=$category_id;
            $post->status=$status;
            // dd($image);
        }
        
        $post= Post::find($post_id);
        $post->title=$title;
        $post->image=implode('|',$image);
        $post->student_id=$student_id;
        $post->category_id=$category_id;
        $post->status=$status;
        // dd($image);
        $post->save();
        // dd($post);
        Alert::success('Cập nhật bài viết thành công');
        return redirect('student/profile/'.$id);
    }

    public function show_post_category($id){
        $this->CheckLogin_student();
        // dd($id);
        // dd($id);
        $category=Category::all();
        $post=Post::where('category_id',$id)->with('student')->get();
        // dd($post);
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $district= District::get();
        $major=Major::where('faculty_id',3)->get();
        $user=Student::find(Session::get('student_id'));
        // dd($post);
        return view('student/post_via_category')->with(compact('category','post','confirm','district','user','major'));
        
    }

    public function detail_post($id){
        $this->CheckLogin_student();
        $category=Category::all();
        $major=Major::where('faculty_id',3)->get();
        $post=Post::where('id',$id)->with('comment')->with('student')->with('category')->first();
        $comment=Comment::where('post_id',$id)->with('student')->with('replycomment')->get();
        $replyComment=null;
        foreach($comment as $student_comment){
            $replyComment=ReplyComment::where('comment_id',$student_comment->id)->with('student')->with('comment')->get();
            // dd($comment,$replyComment);
        }
        $total_replycomment=$replyComment;
        // dd($total_replycomment);
        
        
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $district= District::get();
        $user=Student::find(Session::get('student_id'));
        // dd($post);
        // dd($comment);
       
        return view('student.detail_post')->with(compact('category','post','comment','confirm','district','user','major','total_replycomment'));
    }

    public function student_comment(Request $request,$id){

        $this->CheckLogin_student();
        $request->validate(
            [
                'comment' => 'required',
            ],
            [
                'comment.required' => 'Nhập bình luận',
            ],
        );
        $danhsachche = array ("không thích","Xấu","Chê","dở ","tệ","không tốt");
        $check_che=false;
        $sentiment = new SentimentAnalysis();
        $comment= new Comment();
        $comment->content=$request->input('comment');
        $comment->rating=(int)$request->input('rating');
        $comment->post_id=(int)$id;
        $comment->student_id=Session::get('student_id');
        
       foreach($danhsachche as $word) {
           $pos=strpos($comment->content,$word);
            if($pos!==false){
                $check_che=true;
                break;
            }
       }
       $student=Post::where('id',$id)->with('student')->first();
       $student_comment=Student::where('id',$comment->student_id)->first();
       if($check_che==true){
            if(Session::get('student_id')!=$student->student->id){
                $url=url()->previous();
               
                Mail::to($student->student->email)->send(new TestMail($student_comment,$url));
            }
       }
        $comment->save();
        Alert::success('Success', 'Bình luận thành công');
        return redirect('student/detail-post/'.$id);
    }

    public function student_edit_comment($id,$comment_id){
        $this->CheckLogin_student();
        $category=Category::all();
        $post=Post::where('id',$id)->first();
        $comment=Comment::where('id',$comment_id)->with('student')->first();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $district= District::get();
        $major=Major::where('faculty_id',3)->get();
        $user=Student::find(Session::get('student_id'));
        return view('student.edit_comment')->with(compact('category','comment','post','district','user','major'));
    }

    public function student_update_comment(Request $request,$id,$comment_id){
        $this->CheckLogin_student();
        $request->validate(
            [
                'comment' => 'required',
            ],
            [
                'comment.required' => 'Nhập bình luận',
            ],
        );
        $comment= Comment::where('id',$comment_id)->first();
        $comment->content=$request->input('comment');
        $comment->post_id=(int)$id;
        $comment->student_id=Session::get('student_id');
       
        $comment->save();
        // dd($comment);
        Alert::success('Cập nhật bình luận thành công');
        return redirect('student/detail-post/'.$id);
    }

    public function student_delete_comment($id,$comment_id){
        $this->CheckLogin_student();
        $post=Post::find($id);
        $comment=Comment::where('id',$comment_id)->delete();
        Alert::success('Xóa bình luận thành công');
        return redirect('student/detail-post/'.$id);
    }
    
   
    public function update_password(){
        return view('student.update_password');
    }
    public function save_password(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => ['required' ,'regex:/^[A-Za-z0-9]{6,}+$/'],
        ],
        [
            'username.required' => 'Vui lòng nhập MSSV',
            'password.required'=> 'Vui lòng nhập mật khẩu',
            'password.regex' => 'Mật khẩu ít nhất 6 kí tự'
        ],
    );
        $student=Student::where('maso',$request->input('username'))->first();
        if($student){
            $studen->password=md5($request->input('password'));
            $student->save();
            Alert::success('Cập nhật mật khẩu thành công');
            return redirect('/');
        }
        else {
            Alert::error('Tài khoản không tồn tại');
            return redirect()->back();
        }
       
    }

    public function confirm(Request $request,$id){
        // dd($request->all());
        $confirm=Confirm::where('post_id_confirm',$id)->first();
        if(Session::get('student_id')==$request->input('student_id')){
            Alert::warning('Cảnh báo',"Bạn là chủ bài viết");
            return redirect()->back();
        }else if($confirm!=null){
            Alert::warning('Cảnh báo',"Đã có người xác nhận");
            return redirect()->back();

        }
        else{
            $confirm = new Confirm ();
            $confirm->student_id_confirm=Session::get('student_id');
            $confirm->post_id_confirm=$id;
            $confirm->owner_id_post=$request->input('student_id');
            $confirm->save();
            $post=Post::find($id);
            $post->save();
            // dd($confirm);
            $student=Student::where('id',$confirm->student_id_confirm)->first();
            $notification=Student::where('id',$confirm->owner_id_post)->first();
            $notification->notify(new StudentConfirmNotification($student,$id));
            Alert::success('Success',"Xác nhận bài viết thành công");
            return redirect('student/all-post');
        }
       
       
    }
    

    public function reply_comment($id,$comment_id){
        $category=Category::all();
        $post=Post::findOrFail($id);
        $comment=Comment::where('id',$comment_id)->with('student')->first();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $district= District::get();
        $major=Major::where('faculty_id',3)->get();
        $user=Student::find(Session::get('student_id'));
        return view('student/replyComment')->with(compact('post','comment','category','district','confirm','user','major'));
    }

    public function save_reply_comment(Request $request,$id,$comment_id){
        $this->CheckLogin_student();
        $request->validate([
            'replyComment' => 'required',
        ],
        [
            'replyComment.required' => 'Vui lòng nhập câu trả lời',
        ]
    );
        $replyComment= new ReplyComment();
        $replyComment->content=$request->replyComment;
        $replyComment->student_id=Session::get('student_id');
        $replyComment->post_id=$id;
        $replyComment->comment_id=$comment_id;
        // dd($replyComment);
        $replyComment->save();
        Alert::success('Trả lời bình luận');
        return redirect('student/detail-post/'.$id);
    }
    public function student_edit_replycomment($id,$replycomment_id){
        $this->CheckLogin_student();
        $category=Category::all();
        $post=Post::where('id',$id)->first();
        $replycomment=ReplyComment::where('id',$replycomment_id)->first();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $district= District::get();
        $user=Student::find(Session::get('student_id'));
        return view('student.edit_replycomment')->with(compact('category','replycomment','post','confirm','district','user'));
    }
    public function student_update_replycomment(Request $request,$id,$replycomment_id){
        $this->CheckLogin_student();
        $request->validate(
            [
                'comment' => 'required',
            ],
            [
                'comment.required' => 'Nhập bình luận',
            ],
        );
        $replycomment= ReplyComment::where('id',$replycomment_id)->first();
        $replycomment->content=$request->input('comment');
        $replycomment->post_id=(int)$id;
        $replycomment->student_id=Session::get('student_id');
       
        $replycomment->save();
        Alert::success('Cập nhật bình luận thành công');
        return redirect('student/detail-post/'.$id);
    }

    public function student_delete_replycomment($id,$replycomment_id){
        $this->CheckLogin_student();
        $post=Post::find($id);
        $replycomment=ReplyComment::where('id',$replycomment_id)->delete();
        Alert::success('Xóa bình luận thành công');
        return redirect('student/detail-post/'.$id);
    }

    public function search(Request $request){
        $search=$request->search;
        $category=Category::all();
        $post=Post::where('title','like','%'.$search.'%')->where('status',1)->get();
        $student=Student::where('name','like','%'.$search.'%')->orWhere('maso','like','%'.$search.'%')->distinct()->get();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $district= District::get();
        $major=Major::where('faculty_id',3)->get();
        $user=Student::find(Session::get('student_id'));
        
        return view('student.search')->with(compact('category','post','confirm','district','student','major','user'));
    }

    public function search_via_district($id){
        $student=Student::where('district_id',$id)->with('post')->with('major')->with('course')->get();
        $category=Category::all();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $district=District::get();
        $major=Major::where('faculty_id',3)->get();
        $post=null;
        $user=Student::find(Session::get('student_id'));
        // dd($student);
        return view('student/search_via_district')->with(compact('category','student','district','confirm','user','major'));
    }

    public function student_confirmed($id){
        $confirmed=Confirm::where('id',$id)->with('post')->with('student')->first();
        $category=Category::all();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $district=District::get();
        // dd($confirmed->post);
        $post=Post::where('id',$confirmed->post->id)->with('category')->first();
        $user=Student::find(Session::get('student_id'));
        return view('student/confirmed')->with(compact('category','district','confirm','confirmed','post','user'));
    }

    public function add_rating(Request $request,$id){
        $this->CheckLogin_student();
        if(Session::get('student_id')==$id){
            return redirect()->back()->with('status',"You don't rating for myself");
        }
        else{
            $rating=$request->input('rating');
            // dd($id);
            Rating::create([
                'student_id' => Session::get('student_id'),
                'rated' => $rating,
                'rated_student'=>$id,
    
            ]);
            Alert::success('Đánh giá thành công');
            return redirect()->back();
        }
    }
    public function history($id){
        $this->CheckLogin_student();
        $category=Category::all();
        $district=District::all();
        $post=Post::where('student_id',$id)->orderBy('id','DESC')->with('confirm')->get();
        $student=Student::where('id',$id)->with('course')->with('major')->with('ward')->with('district')->first();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $history=Confirm::where('student_id_confirm',$id)->with('owner_post')->get();
        $user=Student::find(Session::get('student_id'));
        $major=Major::where('faculty_id',3)->get();
        $rating=Rating::where('rated_student',$id)->get();
        $list_follow=Follow::where('student_id',$id)->with('student_follow')->get();
        $average=0;
        if($rating->count()!=0){
            $rating_sum=Rating::where('rated_student',$id)->sum('rated');
            $average=round($rating_sum/$rating->count());
        }
        else $average=0;
        // dd($confirm);
        // dd($history);
        return view('student.history')->with(compact('category','district','confirm','history','user','major','student','post','rating','average','list_follow'));
    }

    public function signup(){
        
        $course=Course::get();
        $faculty=Faculty::get();
        return view('student.signup')->with(compact('course','faculty'));
    }
   
    public function post_signup(Request $request){
      $request->validate([
        'username' => ['required' ,'regex:/^B+[0-9]{7}+$/','unique:student,maso'],
        'name' => 'required',
        'email' => ['required' , 'email', 'unique:student,email'],
        'password' => ['required' , 'min:6'],
        'phone' => ['required', 'regex:/^[0-9]{10}+$/','unique:student,phone'],

      ],
      [
        'username.rquired' => "MSSV không rỗng",
        'username.regex' =>"ĐÚng định dạng ví dụ: B1809444",
        'username.unique' => "MSSV đã tồn tại",
        'name.required' => "HỌ và tên không rỗng",
        'email.required' => "Email không rỗng",
        'email.email' => "Đúng định dạng email",
        'email.unique' => "Email là duy nhất",
        'password.required' => "Mật khẩu không rỗng",
        'password.min' => "Mật khẩu ít nhất 6 kí tự",
        'phone.required' =>"Số điện thoại không rỗng",
        'phone.regex' => "Là một số điện thoại",
        'phone.unique' => "SĐt là duy nhất",
      ]
    );
        // dd($request->all());
        $student=Student::create([
            'maso' => $request->username,
            'name' => $request->name,
            'password' => md5($request->password),
            'email' => $request->email,
            'course_id' => $request->course_id,
            'faculty_id' => $request->faculty_id,
            'major_id' => $request->major_id,
            'phone' => $request->phone,
        ]);
        if($student){
            alert()->success('Success','Đăng ký thành công');
            return redirect::to('/');
            
        }
        else {
            alert()->error('Failure','Đăng ký thất bại');
            return redirect()->back(); 
           
        }
   
    }

    public function student_report($id){
        $this->CheckLogin_student();
        $report=Report::create([
            'student_id' => Session::get('student_id'),
            'post_id' => $id,
        ]);

        if($report){
            Alert::success('Success',"Báo cáo thành công");
        }
        return redirect::to('student/all-post');
    }

    public function search_via_major($id){
        $category=Category::all();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $district=District::get();
        $search_via_major=Student::where('major_id',$id)->with('post')->with('course')->with('major')->get();
        $user=Student::find(Session::get('student_id'));
        $major=Major::where('faculty_id',3)->get();
        // dd($search_via_major);
        return view('student.search_via_major')->with(compact('category','confirm','district','search_via_major','user','major'));
    }

    public function follow(Request $request,$id){
        $follow=Follow::create([
            'student_id' => Session::get('student_id'),
            'student_id_follow' => $id,
        ]);
        if($follow){
            Alert::success('Theo dõi thành công');
            return redirect::to('student/profile/'.$id);
        }
    }
    public function unfollow(Request $request,$id){
       $unfollow=Follow::where('student_id',Session::get('student_id'))->where('student_id_follow',$id)->first();
       $unfollow->delete();
       Alert::info('Đã bỏ theo dõi');
       return redirect::to('student/profile/'.$id);
    }

    public function list_follow($id){
        $this->CheckLogin_student();
        $category=Category::all();
        $post=Post::where('student_id',$id)->orderBy('id','DESC')->with('confirm')->get();
        $student=Student::where('id',$id)->with('course')->with('major')->with('ward')->with('district')->first();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $district= District::get();
        $major=Major::where('faculty_id',3)->get();
        $user=Student::find(Session::get('student_id'));
        $rating=Rating::where('rated_student',$id)->get();
        $average=0;
        if($rating->count()!=0){
            $rating_sum=Rating::where('rated_student',$id)->sum('rated');
            $average=round($rating_sum/$rating->count());
        }
        else $average=0;

        $list_follow=Follow::where('student_id',$id)->with('student_follow')->get();
        // dd($list_follow);

        return view('student.list_follow')->with(compact('post','category','student','confirm','district','rating','average','user','major','list_follow'));
    }

    public function history_confirm($id){
        $this->CheckLogin_student();
        $category=Category::all();
        $district=District::all();
        $post=Post::where('student_id',$id)->orderBy('id','DESC')->with('confirm')->get();
        $student=Student::where('id',$id)->with('course')->with('major')->with('ward')->with('district')->first();
        $confirm=Confirm::where('owner_id_post',Session::get('student_id'))->with('student')->get();
        $history=Confirm::where('student_id_confirm',$id)->with('owner_post')->get();
        $user=Student::find(Session::get('student_id'));
        $major=Major::where('faculty_id',3)->get();
        $rating=Rating::where('rated_student',$id)->get();
        $list_follow=Follow::where('student_id',$id)->with('student_follow')->get();
        $average=0;
        if($rating->count()!=0){
            $rating_sum=Rating::where('rated_student',$id)->sum('rated');
            $average=round($rating_sum/$rating->count());
        }
        else $average=0;
         return view('student.history_confirm')->with(compact('category','district','confirm','history','user','major','student','post','rating','average','list_follow'));
    }

    public function agree(Request $request,$id){
        $student=Student::where('id',$id)->first();
        $student_agree=Student::where('id',Session::get('student_id'))->first();
        $url=$request->input('url');
        $id=$request->input('id_notification');
        $id_post=$request->input('id_post');
        $result=$student_agree->notifications()->where('id',$id)->update([
            'data->status' => true,
        ]);
        // dd($result);
        Mail::to($student->email)->send(new AgreeMail($student_agree,$url));
        Alert::success('Thành công',"Gửi thông báo thành công");
        $student_agree->notifications()->where('id',$id)->first()->markAsRead();
        return redirect('student/all-post');
    }
    public function disagree(Request $request,$id){
        $student=Student::where('id',$id)->first();
        $student_agree=Student::where('id',Session::get('student_id'))->first();
        $url=$request->input('url');
        $id=$request->input('id_notification');
        $id_post=$request->input('id_post');
        $result=$student_agree->notifications()->where('id',$id)->update([
            'data->status' => false,
        ]);
        // dd($result);
        Confirm::where('post_id_confirm',$id_post)->delete();
        Mail::to($student->email)->send(new DisagreeMail($student_agree,$url));
        Alert::success('Thành công',"Gửi thông báo thành công");
        $student_agree->notifications()->where('id',$id)->first()->markAsRead();
        return redirect('student/all-post');
    }

    public function cancel_confirm(Request $request,$id){
        // dd('abc');
        $confirm=Confirm::where('post_id_confirm',$id)->with('owner_post')->with('student')->first();
        $url="http://127.0.0.1:8000/student/detail-post/".$confirm->post_id_confirm;
        $id_profile=$request->input('id_profile');
        // // dd($url);
        Mail::to($confirm->owner_post->email)->send(new CancelConfirmMail($confirm->student,$url));
        $confirm->delete();
        $blacklist= BlackList::where('student_id',Session::get('student_id'))->first();
        if($blacklist==null){
            $blacklist = new BlackList();
            $blacklist->student_id=Session::get('student_id');
            $blacklist->count=1;
        }else {
           
            $blacklist->count++;
        }
        $blacklist->save();
        Alert::success('Thành công',"Huỷ xác thực thành công");
        return redirect('student/history-confirm/'.$id_profile);
    }
}
