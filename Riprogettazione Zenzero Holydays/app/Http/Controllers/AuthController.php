<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;



class AuthController extends Controller
{
    public function authentication() {

        return view('auth.auth');
    }

    public function loginCheckForEmail(Request $req) {
        $dl = new DataLayer();
        if($dl->findUserByEmail($req->input('email'))) {
            $response = array('found'=>true);
        } else {
            $response = array('found'=>false);
        }
        return response()->json($response);
    }

    public function loginCheckForPassword(Request $req) {
        $dl = new DataLayer();
        if($dl->validPassword($req->input('email'), $req->input('password'))) {
            $response = array('found'=>true);
        } else {
            $response = array('found'=>false);
        }
        return response()->json($response);
    }

    public function login(Request $request) {

        session_start();
        $dl = new DataLayer();
        session(['logged' => true]);
        session(['loggedID' => $dl->getUserID($request->input('email'))]);
        session(['loggedName' => $dl->getUserName($request->input('email'))]);
        session(['role' => $dl->getUserRole($request->input('email'))]);
        session(['user_email' => $request->input('email')]);
        return Redirect::to(route('home'));


        /*if($dl->validUser($request->input('email'), $request->input('password')))
        {
            session(['logged' => true]);
            session(['loggedID' => $dl->getUserID($request->input('email'))]);
            session(['loggedName' => $dl->getUserName($request->input('email'))]);
            session(['role' => $dl->getUserRole($request->input('email'))]);
            session(['user_email' => $request->input('email')]);

            return Redirect::to(route('home'));
        } else
        {
            return view('errors.404')->with('message','Wrong authentication credentials!');
        }*/
    }

    public function logout() {

        session_start();
        session_destroy();
        session()->forget('logged');
        session()->forget('loggedID');
        session()->forget('loggedName');
        session()->forget('role');
        session()->forget('user_email');

        return Redirect::to(route('home'));
    }

    public function registration(Request $request) {
        $dl = new DataLayer();

        $dl->addUser($request->input('name'), $request->input('registration-password'), $request->input('registration-email'));

        return Redirect::to(route('user.login'))->with('registration_success', __('messages.registration_success'));
    }

    public function ajaxCheckForEmail(Request $request)
    {
        $dl = new DataLayer();

        if($dl->findUserByEmail($request->input('email')))
        {
            $response = array('found'=>true);
        } else {
            $response = array('found'=>false);
        }
        return response()->json($response);
    }
}
