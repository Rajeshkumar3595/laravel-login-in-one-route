<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_user;
use App\Models\tbl_gallery_image;
use Validator;
use Session;
use Image;
use Carbon\Carbon;
class UserregisterController extends Controller
{
    public function userRegister(Request $request)
    {
        if($request->action == 'adduserreg')
        {
            $validator = Validator::make($request->all(),[
                'first_name'=>'required',
                'last_name'=>'required',
                'email'=>'required|email',
                'password'=>'required',
                'gender'=>'required',
                'profile_image'=>'required',
            ]);
            if($validator->passes())
            {
                $checkmail = tbl_user::where([['status','!=','deleted'],['email','=',$request->email]])->first();
                if($checkmail)
                {
                    return response()->json(['status'=>201,'message'=>'This is email alredy exit']);
                }
                $pImage = $request->file('profile_image');
                $data = getimagesize($pImage);
                // dd($data);
                 $width = $data[0];
                 $height = $data[1];
                 // dd($height);
                 
                 
                if(!empty($pImage))
                {
                    $imagePath = 'assets/uploads/profile';
                    $profileImg = 'profile'.'_'.uniqid().'.'.$pImage->getClientOriginalExtension();
                    Image::make($pImage->getRealPath())->resize(25, 25)->save('assets/uploads/profile'.$profileImg);
                    $pImage->move($imagePath,$profileImg);
                }
                $adduserDet = new tbl_user;
                $adduserDet->first_name = $request->first_name;
                $adduserDet->last_name = $request->last_name;
                $adduserDet->email = $request->email;
                $adduserDet->password = $request->password;
                $adduserDet->profile_image = $profileImg;
                $adduserDet->gender = $request->gender;
                $add = $adduserDet->save();
                $alldata = tbl_user::where([['status','=','active']])->get();
                
                if($add)
                {
                    if(!empty($request->title && $request->image))
                    {
                        foreach($request->title as $key => $value)
                        {
                            $gafile = $request->file('image');
                            if(!empty($gafile[$key]))
                            {
                                $imagePath = 'assets/uploads/profile';
                                $galleryImg = 'profile'.'_'.uniqid().'.'.$gafile[$key]->getClientOriginalExtension();
                                Image::make($gafile[$key]->getRealPath())->resize(25, 25)->save('assets/uploads/profile'.$galleryImg);
                                $gafile[$key]->move($imagePath,$galleryImg);
                            } 
                            $addgalImage = new tbl_gallery_image;
                            $addgalImage->user_id = $adduserDet->id;
                            $addgalImage->title = $value;
                            $addgalImage->image = $galleryImg;
                            $addgalImage->save();
                        }
                    }
                   
                    return response()->json(['status'=>200,'message'=>'Your Successfully Register','alldata'=>$alldata]);
                }
                else
                {
                    return response()->json(['status'=>201,'message'=>'Your not Register']);
                }
            }
            else
            {
                return response()->json(['status'=>201,'message'=>$validator->errors()]);
            }     
        }
        elseif ($request->action == 'getuserdet')
        {
            if(!empty($request->userId))
            {
               $userdet = tbl_user::where([['status','=','active'],['id','=',$request->userId]])->first();
               $imgae = tbl_gallery_image::where([['status','=','active'],['user_id','=',$request->userId]])->get();
               if($userdet)
               {
                return response()->json(['status'=>200,'message'=>$userdet,'imagede'=>$imgae]);
               }
               else
               {
                return response()->json(['status'=>201,'message'=>'record not fetch']);
               }

            }
            else
            {
                return response()->json(['status'=>201,'message'=>'Invalid Action']);
            }
        }
        elseif($request->action == 'updateuser')
        {
            
            $validator = Validator::make($request->all(),[
                'first_name'=>'required',
                'last_name'=>'required',
                'email'=>'required|email',
                'password'=>'required',
            ]);
            if($validator->passes())
            {
                $checkmail = tbl_user::where([['status','!=','deleted'],['email','=',$request->email],['id','!=',$request->userId]])->first();
                if($checkmail)
                {
                    return response()->json(['status'=>201,'message'=>'This is email alredy exit']);
                }
                $updateuserDet = tbl_user::where([['status','=','active'],['id','=',$request->userId]])->first();
                $pImage = $request->file('profile_image');
                if(!empty($pImage))
                {
                    $imagePath = 'assets/uploads/profile';
                    $profileImg = 'profile'.'_'.uniqid().'.'.$pImage->getClientOriginalExtension();
                    $pImage->move($imagePath,$profileImg);
                $updateuserDet->profile_image = $profileImg;
                }
                $updateuserDet->first_name = $request->first_name;
                $updateuserDet->last_name = $request->last_name;
                $updateuserDet->email = $request->email;
                $updateuserDet->password = $request->password;
                $update = $updateuserDet->save();
                $alldata = tbl_user::where([['status','=','active']])->get();
                if($update)
                {
                        if(!empty($request->deatilEditId ))
                        {
                            foreach($request->deatilEditId as $key => $value)
                            {
                                $updategalImage = tbl_gallery_image::where([['id','=',$value]])->first();
                                $gafile = $request->file('image_e');
                                if(!empty($gafile[$key]))
                                {
                                    $imagePath = 'assets/uploads/profile';
                                    $galleryImg = 'profile'.'_'.uniqid().'.'.$gafile[$key]->getClientOriginalExtension();
                                    $gafile[$key]->move($imagePath,$galleryImg);
                                    $updategalImage->image = $galleryImg;
                                } 
                                $updategalImage->user_id = $updateuserDet->id;
                                $updategalImage->title = $request->title_e[$key];
                                $updategalImage->save();
                            }

                        }

                        if(!empty($request->title && $request->image))
                        {
                            foreach($request->title as $key => $value)
                            {
                                $gafile = $request->file('image');
                                if(!empty($gafile[$key]))
                                {
                                    $imagePath = 'assets/uploads/profile';
                                    $galleryImg = 'profile'.'_'.uniqid().'.'.$gafile[$key]->getClientOriginalExtension();
                                    $gafile[$key]->move($imagePath,$galleryImg);
                                } 
                                $addgalImage = new tbl_gallery_image;
                                $addgalImage->user_id = $updateuserDet->id;
                                $addgalImage->title = $value;
                                $addgalImage->image = $galleryImg;
                                $addgalImage->save();
                            }

                        }
                   
                    return response()->json(['status'=>200,'message'=>'Your Successfully update','alldata'=>$alldata]);
                }
                else
                {
                    return response()->json(['status'=>201,'message'=>'Your not Register']);
                }
            }
            else
            {
                // return response()->json(['status'=>201,'message'=>$validator->errors()->first()]);
            }     
        }
        elseif($request->action == 'deleteuser')
        {
            $userdel = tbl_user::where([['status','=','active'],['id','=',$request->userId]])->first();
            $userdel->status = 'deleted';
            $del = $userdel->save();
            $alldata = tbl_user::where([['status','=','active']])->get();
            if($del)
            {
                return response()->json(['status'=>200,'message'=>'Record Successfully deleted','alldata'=>$alldata]);
            }
            else
            {
                return response()->json(['status'=>201,'message'=>'Record not deleted']);
            }
        }
        elseif($request->action == 'delgaldet')
        {
            $delimage = tbl_gallery_image::where([['id','=',$request->gId]])->first();
            $delimage->status = 'deleted';
            $del = $delimage->save();
            if($delimage)
            {
                return response()->json(['status'=>200,'message'=>'Record Successfully deleted']);
            }
            else
            {
                return response()->json(['status'=>201,'message'=>'Record not deleted']);
            }
        }
    }
    public function userlist()
    {
        $alluserList = tbl_user::where([['status','=','active']])->get();
        return view('userlist',compact('alluserList'));
    }
    // public function registerr()
    // {
    //     return view('signup');
    // }
}
