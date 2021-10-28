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
}
