<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function check(Request $request)
    {
        if(empty($request->get('code'))){
            return ['error' => 'input'];
        }
        if(strlen($request->get('code')) != 14) {
            return ['error' => 'input'];
        }
        $check = Code::where('code', $request->get('code'))->first();
        if(!$check) {
            $return = ['error' => 'alert', 'alert' => 'danger', 'title' => 'INVALID CODE', 'message' => 'Code is not found'];
        } else {
            if($check->state) {
                $return = ['error' => 'alert', 'alert' => 'warning', 'title' => 'VALID CODE', 'message' => 'Code was checked'];
            } else {
                $check->update(['state' => true]);
                $return = ['error' => 'alert', 'alert' => 'success', 'title' => 'VALID CODE', 'message' => 'Code is found'];
            }
        }
        return response()->json($return);
    }
}
