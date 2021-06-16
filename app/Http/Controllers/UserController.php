<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    //* Upload function
    public function uploadAvatar(Request $request)
    {
        //upload image using model for clean code
        if ($request->hasFile('image')) { //image is the name of the input
            User::uploadAvatar($request->image);
            //flash message but in short an clean way
            return \redirect()->back()->with('message', 'Image Upload Success');

            //flash message
            // $request->session()->flash('message', 'Image Upload Success');
            // return \redirect()->back();
        }
        // $request->session()->flash('error', 'Something went wrong!');
        return \redirect()->back()->with('error', 'Something went wrong!');


        //upload image
        // if ($request->hasFile('image')) {
        //     $filename = $request->image->getClientOriginalName();
        //     $this->deleteOldImage();
        //     $request->image->storeAs('images', $filename, 'public'); //image is the name of the inout field
        //     \auth()->user()->update(['avatar' => $filename]);
        // }
        // return \redirect()->back();

        // dd($request->file('image'));
        //or
        // dd($request->image); //because we declare enctype multipart on view
        // dd($request->hasFile('image')); //true or false
    }

    public function index()
    {
        //! CRUD using raw sql
        //* Create
        // DB::insert('insert into users (name,email,password) values (?,?,?)', [
        //     'kimpoy',
        //     'kimpoy@gmail.com',
        //     'password',
        // ]);

        //* Read
        // $users = DB::select('select * from users');
        // return $users;

        //* Update
        // DB::update('update users set name = ?, email = ?, password = ? where id = 1', [
        //     'bit',
        //     'bit@gmail.com',
        //     'bit'
        // ]);

        //* Delete
        // DB::delete('delete from users where id = 1');

        //! CRUD using Eloquent
        $user = new User(); //new object for User model

        //* Create
        // $user->name = 'sample name';
        // $user->email = 'sample email';
        // $user->password = \bcrypt('sample password');
        // $user->save();

        //* Reduce code for Create
        $data = [
            'name' => 'fna',
            'email' => 'fna@gmail.com',
            'password' => 'fna'
        ];
        // User::create($data);

        //* Read
        $user = User::all();
        return $user;

        //* Delete
        // User::where('id', 2)->delete();

        //* Update
        // User::where('id', 3)->update(['name' => 'new sample name']);

        // return \view('home');
    }
}