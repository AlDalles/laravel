<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index(){
        $pages = User::paginate(10);
        $link_main="";
        return view('pages/user/list',compact('pages','link_main'));

    }

    public function create(){
        $user = new User();
        return view('pages/user/edit',compact('user'));
    }

    public function store(){
        $data = request()->all();
        $validator = validator()->make($data, [
            'name'=> ['required','min:10'],
            'email'=> ['required','min:5','unique:users,email','email:rfc,dns'],
            'password'=>['required','min:8',]
        ]);
        $error = $validator->errors();
        if(count($error)>0){
            $_SESSION['errors'] = $error->toArray();
            $_SESSION['data'] = $data;
            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }

        $user = new User();
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->password=$data['password'];
        $user->save();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "user \"{$data['name']}\" successfully saved",

        ];
        return new RedirectResponse('/user/list');
    }


    public function destroy($id){

        $user =  User::find($id);
        $name=$user->name;
        $user->delete();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "user \"{$name}\" successfully deleted",

        ];

        return new RedirectResponse('/user/list');

    }
    public function delete_many(){
        $users = User::all();
        return view('pages/user/delete',compact('users'));

    }


    public function destroy_many(){
        $data = request()->all();
        $users=User::find($data['users_id']);
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "users \"{$users->pluck('name')->implode(' ,')}\" successfully deleted",

        ];
        User::destroy($data['users_id']);


        return new RedirectResponse('/user/list');
    }

    public function edit($id){
        $user =  User::find($id);
        return view('pages/user/edit',compact('user'));

    }

    public function edit_select(){
        $users =  User::all();
        return view('pages/user/select-user',compact('users'));

    }

    public function update($id){
        $data = request()->all();
        $validator = validator()->make($data, [
            'name'=> ['required','min:10','unique:users,name,'. $id],
            'email'=> ['required','unique:users,email,'.$id,'email:rfc,dns'],
            'password'=>['required','min:8',]
        ]);
        $error = $validator->errors();
        if(count($error)>0){
            $_SESSION['errors'] = $error->toArray();
            $_SESSION['data'] = $data;

            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }

        $user =  User::find($id);
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->password=$data['password'];
        $user->save();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "user \"{$data['name']}\" successfully saved",

        ];
        return new RedirectResponse('/user/list');
    }

    public function edit1()
    {
        $data = request()->all();
        $user = User::find($data['id']);
        $_SESSION['mark'] = $data['mark'];
        return view('pages/user/edit', compact('user'));
    }
}
