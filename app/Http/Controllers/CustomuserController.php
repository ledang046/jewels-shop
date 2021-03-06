<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomUser;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePassword;
class CustomuserController extends Controller
{
    public function manageUser()
    {
        return view('backend.home');
    }

    public function editPassword($id)
    {
        $user = CustomUser::find($id);

        return view('backend.change_password', ['record' => $user]);
    }

    public function changePassword(ChangePassword $request, $id)
    {
        $customeuser = CustomUser::find($id);
        $user = CustomUser::where("id","=",$id)->first();
        if(Hash::check($request->currentpass,$user->passcode) and $request->newpass == $request->confirmpass){
                 //mã hóa password
                $customeuser->passcode = Hash::make($request->newpass);
                $customeuser->save();

                return redirect()->back()->with('successMsg',"Change password success!");
        }else{
            return redirect()->back()->with('errorMsg',"Your current password is incorrect!");
        }
    }
    public function showInfo($id)
    {
        $user = CustomUser::where("id","=",$id)->first();
        return view("backend.change_info",["record"=>$user]);
    }

    public function updateUser(Request $request, $id)
    {
        $users = CustomUser::find($id);
        //update name
        $users->name = $request->name;
        $users->address = $request->address;
        $users->phonenumber = $request->phonenumber;
        $users->save();

        return redirect()->back()->with('successMsg',"Change info success!");
    }
    
}
