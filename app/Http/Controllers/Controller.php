<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Commodity;
use App\Models\News;
use App\Models\Pop;
use App\Models\Equipment;
use App\Models\Gallery;
use App\Models\Feedback;
use App\Models\Section;
use App\Models\Service;
use App\Models\Teacher;
use App\Models\Job;
use App\Models\Course;
use App\Models\Batch;
use App\Models\Download;
use App\Models\aboutEvent;
use App\Models\MockTest;
use App\Models\VideoLesson;
use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(){
        $slider = Pop::all();
        $teacher = Teacher::orderBy('id','DESC')->take(4)->get();
        $course = Course::orderBy('id','DESC')->get();
        $news = News::orderBy('id','DESC')->take(3)->get();
        $latestPackage = Equipment::orderBy('id','DESC')->take(3)->get();
        $testimonial = Feedback::orderBy('id','DESC')->get();
        $FeaturedPackage = Equipment::where(['status'=>'Featured'])->orderBy('id','DESC')->get();

        $batch = Batch::orderBy('id','DESC')->get(); 
        $gallery = Gallery::orderBy('id','DESC')->take(12)->get(); 
        return view('web.home', compact('slider','news', 'latestPackage','FeaturedPackage','testimonial','teacher','course','batch' ,'gallery'));
    }


    public function contact(){
        return view('web.contact');
    }


    public function about(){

        $aboutEvent = Batch::orderBy('id','DESC')->get(); 
        return view('web.about',compact('aboutEvent'));
    }
    
    public function faq(){
        $faq = Service::orderBy('id','DESC')->get();
        return view('web.faq',compact('faq'));
    }

    public function services(){
        $Services = Service::orderBy('id','DESC')->get();
        return view('web.services', compact('Services'));

    }

    public function gallery(){
        $gallery = Gallery::orderBy('id','DESC')->get();
        
        return view('web.gallery' ,compact('gallery'));
    }

    
    public function jobDetail($id){
        $job = Job::find($id);
        return view('web.jobDetail',compact('job'));
    }

    
    public function job(){
        $job = Job::orderBy('id','DESC')->get();
        return view('web.job',compact('job'));
    }

    public function mocktest(){
        $mocktest = MockTest::orderBy('id','DESC')->get();
        return view('web.mocktest',compact('mocktest'));
    }
     
    public function mockdetail($slug){
      
        $mock = MockTest::where(['slug'=>$slug])->orderBy('id','DESC')->first();
        return view('web.mockdetail',compact('mock'));
    }



    public function videolesson(){
        $mocktest = VideoLesson::orderBy('id','DESC')->get();
        return view('web.videolesson',compact('mocktest'));
    }
     
    public function Videodetail($slug){
 
        $mock = VideoLesson::where(['slug'=>$slug])->orderBy('id','DESC')->first();
        return view('web.videodetail',compact('mock'));
    }
    public function courselist(){
        $courselist = Course::where(['type'=>'Competitive'])->orderBy('id','DESC')->get();
        $latest = Course::where(['type'=>'Competitive'])->orderBy('id','DESC')->take(5)->get();
        return view('web.courselist',compact('courselist','latest'));
    }
    public function coursedetail($slug){
        $courselist = Course::where(['slug'=>$slug])->orderBy('id','DESC')->first();
        $courseitem = Course::where(['type'=>'Competitive'])->orderBy('id','DESC')->get();

     return view('web.coursedetail',compact('courselist',"courseitem"));
    }


    public function subjectlist(){
        $courselist = Course::where(['type'=>'Subject'])->orderBy('id','DESC')->get();
        $latest = Course::where(['type'=>'Subject'])->orderBy('id','DESC')->take(5)->get();
        return view('web.subjectlist',compact('courselist','latest'));
    }
    public function subjectdetail($slug){
        $courselist = Course::where(['slug'=>$slug])->orderBy('id','DESC')->first();
        $subjectDetail = Course::where(['type'=>'Subject'])->orderBy('id','DESC')->get();

     return view('web.subjectdetail',compact('courselist','subjectDetail'));
    }









    public function downloadlist(){
        $download = Download::orderBy('id','DESC')->get(); 
        return view('web.downloadlisting',compact('download'));
    }
    public function downloaddetail($slug){
       
        $detail = Download::where(['slug'=>$slug])->orderBy('id','DESC')->first();
        return view('web.downloaddetail', compact('detail'));
    }

    public function event(){
        
        $batch = Batch::orderBy('id','DESC')->get(); 
        return view('web.event',compact('batch'));
    }
    public function eventDetail($id){
        $eventDetail = Batch::find($id);
        return view('web.eventDetail', compact('eventDetail'));
    }

    public function teacherdetail($id){
        $teacher= Teacher::find($id);
        return view('web.teacherdetail',compact('teacher'));
    }

    public function shop(){
        $shop = Equipment::orderBy('id','DESC')->get();
        return view('web.shop',compact('shop'));
    }
    public function shopDetail($slug){
        // $shop= Equipment::find($id);

        $shop = Equipment::where(['slug'=>$slug])->orderBy('id','DESC')->first();
        
       
        return view('web.shopDetail',compact('shop'));
    }

    public function blogInfinity(){
        $news = News::all();
        return view('web.blogInfinity',compact('news'));
    }

    public function blogDetail($slug){
          
          $blogdetail = News::where(['slug'=>$slug])->orderBy('id','DESC')->first();

          $blogs = News::orderBy('id','DESC')->take(4)->get();;
        return view('web.blogDetail',compact('blogdetail','blogs'));
    }



    public function servicedetail($id){
        $data = Service::find($id);
        return view('web.servicedetails', compact('data'));
    }

    public function packages(){
        $data = Equipment::all();
        return view('web.packages',compact('data'));
        
    }

    public function staticpage($slug){
        $data = Section::where(['section_uid'=>$slug])->orderBy('id','DESC')->get();
        return view('web.page',compact('data'));
    }

    public function packagedetail($id){
        $data = Equipment::find($id);
        $gallery = Gallery::where(['property_id'=>$id])->get();
        return view('web.property',compact('data','gallery'));
    }


    public function blogs(){
       
       $news = News::all();
        return view('web.blogs', compact('news'));
    }

    

     public function sendEnquiry(){
         
        
        $data = array(
            'name'=>$_REQUEST['form_name'],
            'email'=>$_REQUEST['form_email'],
            'subject'=>isset($_REQUEST['form_subject']) ? $_REQUEST['form_subject'] : 'Enquiry',
            'phone'=>$_REQUEST['form_phone'],
            'message1'=>$_REQUEST['form_message']);
        
        try{
             Mail::send('web.send',$data,function($message){
                $message->to('cprakash1490@gmail.com')->cc('rahulsoni95888@gmail.com')->subject(isset($_REQUEST['form_subject']) ? $_REQUEST['form_subject'] : 'Enquiry');
                
                $message->from('info@sterlingeducation.co.in','Sterling Education');
            });


        }catch(\Exception $e){
            print_r($e);
            die;
        }
        
        echo json_encode(array('status'=>true,'message'=>'Your Enquiry has sucessfully submitted, we will get back to you as soon as possible'));
        
            


     }

}