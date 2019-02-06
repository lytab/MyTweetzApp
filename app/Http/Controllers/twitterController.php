<?php

namespace App\Http\Controllers;
use \Twitter;
use \File;
use Illuminate\Http\Request;

class twitterController extends Controller
{
    private $count=10;
    private $format='array';
   public function twitterUserTimeLine(){
    $data=Twitter::getUserTimeLine(['count'=>$this->count,'format'=>$this->format]);
    return view('twitter')->with('data',$data);
   }
    public function tweet(Request $request){
        $rules=[
            'tweet'=>'required'
        ];
        $this->validate($request,$rules);
        $newTweet=['status'=>$request->tweet];
         if(!empty($request->images)){
             foreach ($request->images as $key => $value) {
                 $uploadMedia=Twitter::uploadMedia(['media'=>File::get($value->getRealPath())]);
                 if(!empty($uploadMedia)){
                     $newTweet['media_ids'][$uploadMedia->media_id_string]=$uploadMedia->media_id_string;
                 }
             }
         }
         $twitter=Twitter::postTweet($newTweet);
         return back();

    }
}
