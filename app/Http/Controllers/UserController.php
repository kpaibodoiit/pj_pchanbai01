<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use Sentinel;

class UserController extends Controller
{
    //Hiển thị trang chủ top page
    public function topPage()
    {
        //Hiển thị các giá trị trong table users
        $users = User::latest()->paginate(5);
        return view('home.top', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    //Tạo mới tài khoản
    public function registerUser(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $showInfo = redirect()->route('auth.register')->
                    with(['megName'=>$name])->
                    with(['megEmail'=>$email])->
                    with(['megPw'=>$password]);
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:6|max:30|alpha',
                'email' => 'required|email',
                'password' =>'required|string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',    
                                //regex:/[@$!%*#?&]/
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
                    $showInfo;
            }
        }
        $user = DB::table('users')->where('email', $request->email)->first();
        if (!$user) {
            $newUser = new User();
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            //$newUser->password = Hash::make($request->newPassword);
            $newUser->password = $request->password;
            // $newUser->role = $request->role;
            // $newUser->status = $request->status;
            $newUser->role  = '1';
            $newUser->status  = '1';
            $newUser->save();
            return redirect()->route('auth.showRegister')->with('megSuccess', 'Bạn đã đăng ký tài khoản thành công');
            $showInfo;
        } else {
            return redirect()->route('auth.showRegister')->with('megEr01', 'Email đã tồn tại');
            $showInfo;
        }
    }

    //Hiển thị màn hình đăng ký mới tài khoản
    public function showRegister()
    {
        return view('auth.register');
    }

    //Xử lý khi người dùng đăng nhập tài khoản
    public function loginUser(Request $request)
    {
        
        //dd($request->all()); Kiem tra gia tri nhap vao form khi dang nhap
        if ($request->isMethod('post')) {
            $email  = $request->input('email');
            $password  = $request->input('password');
            $showInfo = redirect()->route('auth.showLogin')
                ->with(['megEmail' => $email])
                ->with(['megPw' => $password]); 
            if (strlen($email) == 0) {
                return redirect()->route('auth.showLogin')->with(['message' => 'Vui lòng nhập địa chỉ email đã đăng ký']);
                $showInfo;
            } else if (strlen($password) == 0) {
                return  redirect()->route('auth.showLogin')->with(['message' => 'Vui lòng nhập mật khẩu của bạn.']);
                $showInfo;
            } else {
                $showInfo = redirect()->route('auth.showLogin')
                    ->with(['message1' => $email])
                    ->with(['message2' => $password]);
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'password' => 'required'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                    $showInfo;
                } else {
                    $remember = $request->remember;
                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                        if (Auth::user()->status != 1) {
                            return redirect()->route('auth.showLogin')->with('message', 'Tài khoản của bạn đã bị khóa, vui lòng liên hệ nhà điều hành');
                            $showInfo;
                        }
                        if (Auth::user()->role == 1) {
                            return view('home');
                        } else {
                            return view('admin');
                        }
                    }
                    return redirect()->route('auth.showLogin')->with(['message' => 'Email hoặc mật khẩu của bạn không chính xác 99'])
                    ->with(['messagePw' => $password]);
                    $showInfo;
                }
            }     
        }     
    }


    //Hiển thị màn hình login
    public function showLogin()
    {
        return view('auth.login');
    }

    //Xử lý khi người dùng thay đổi mật khẩu
    public function resetPassword(Request $request)
    {
        $name  = $request->input('name');
        $email  = $request->input('email');
        $password  = $request->input('password');
        $showInfo = redirect()->route('auth.resetPass')
                ->with(['megName' => $name])
                ->with(['megEmail' => $email])
                ->with(['megPw' => $password]); 
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:6|max:30|alpha',
                'email' => 'required|email',
                'password' =>'required|string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',   
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
                    $showInfo;
            }
            $user1 = DB::table('users')->where('email', $request->email)
                ->where('name', $request->name)->first();
            if (!$user1) {
                return redirect()->route('auth.resetPass')->with('message', 'Email không tồn tại hoặc tên đăng nhập không chính xác.');
                $showInfo;
            } else {
                $user1 = DB::table('users')
                    ->where('email', $request->email)
                    ->where('name', $request->name)
                    ->update(['password' => Hash::make($request->password)]);
                return redirect()->route('auth.resetPass')->with('message1', 'Thay đổi mật khẩu thành công.');
                $showInfo;
            }
            return redirect()->route('auth.resetPass')->with('message', 'Thay đổi mật khẩu thất bại.');
            $showInfo;
        }
    }

    //Hiển thị màn hình thay đổi mật khẩu
    public function resetPass()
    {
        return view('auth.resetPassword');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // public function store(Request $request){
    //     if ($request->isMethod('post')){
    //         $validator = Validator::make($request->all(),[
    //             'name' => 'required|min:6|max:30|alpha',
    //             'email' => 'required|email',
    //             'password' => 'required',
    //         ]);
    //         if ($validator->fails()){
    //             return redirect()->back()
    //                     ->withErrors($validator)
    //                     ->withInput();
    //         }
    //     }
    //     $user = DB::table('users')->where('email',$request->email)->first();
    //     if(!$user){
    //         $newUser = new User();
    //         $newUser->name = $request->name;
    //         $newUser->email = $request->email;
    //         //$newUser->password = Hash::make($request->newPassword);
    //         $newUser->password = $request->password;
    //         // $newUser->role = $request->role;
    //         // $newUser->status = $request->status;
    //         $newUser->role  = '1';
    //         $newUser->status  = '1';
    //         $newUser->save();
    //         return redirect()->route('auth.registerUser')->with('message1','Ban da dang ky tai khoan thanh cong');
    //     }else{
    //         return redirect()->route('auth.registerUser')->with('message','Email cua ban da dang ky');
    //     }

    // }
}
