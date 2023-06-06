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
        return response()->json($return = ['error' => 'alert', 'alert' => 'danger', 'title' => 'INVALID CODE', 'message' => 'Code is not found']);
        if(empty($request->get('code'))){
            return ['error' => 'input'];
        }
        $check = Code::where('code', $request->get('code'))->first();
        if(!$check) {
            $return = ['error' => 'alert', 'alert' => 'danger', 'title' => 'INVALID CODE', 'message' => 'Code is not found'];
        } else {
            if($check->state) {
                $return = ['error' => 'alert', 'alert' => 'warning', 'title' => 'VALID CODE', 'message' => 'Code was checked'];
            } else {
                $return = ['error' => 'alert', 'alert' => 'success', 'title' => 'VALID CODE', 'message' => 'Code is found'];
            }
        }
        return response()->json($return);
    }
}
