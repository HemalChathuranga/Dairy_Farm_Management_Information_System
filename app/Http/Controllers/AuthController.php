<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
    public function login(){

        if (!empty(Auth::check())) {
            
            if(Auth::user()->role == 'Admin'){

                return redirect('admin/dashboard');
            }
            elseif(Auth::user()->role == 'Manager'){

                return redirect('manager/dashboard');
            }
            elseif(Auth::user()->role == 'Office Staff'){

                return redirect('officeStaff/dashboard');
            }
            elseif(Auth::user()->role == 'Medical Staff'){

                return redirect('medicalStaff/dashboard');
            }
            elseif(Auth::user()->role == 'Field Staff'){

                return redirect('fieldStaff/dashboard');
            }
            elseif(Auth::user()->role == 'Stores Staff'){
                
                return redirect('storesStaff/dashboard');
            }

        }
        return view('auth.login');
    }

    public function authLogin(Request $request){
        
        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['emp_id' => $request->uid, 'password' => $request->password], $remember)){

            if(Auth::user()->role == 'Admin' && Auth::user()->status == "Active"){

                return redirect('admin/dashboard');
            }
            elseif(Auth::user()->role == 'Manager'){

                return redirect('manager/dashboard');
            }
            elseif(Auth::user()->role == 'Office Staff'){

                return redirect('officeStaff/dashboard');
            }
            elseif(Auth::user()->role == 'Medical Staff'){

                return redirect('medicalStaff/dashboard');
            }
            elseif(Auth::user()->role == 'Field Staff'){

                return redirect('fieldStaff/dashboard');
            }
            elseif(Auth::user()->role == 'Stores Staff'){

                return redirect('storesStaff/dashboard');
            }
            else {
                Auth::logout();
                return redirect()->back()->with('error', 'Your User Credentials has been Revoked');
            }
        }
        else{
            return redirect()->back()->with('error', 'Please Enter Correct User Name and Password');
        }

    }

    public function authLogout(){

        Auth::logout();
        return redirect(url(''));

    }

}
