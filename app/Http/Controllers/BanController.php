<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use Illuminate\Http\Request;


class BanController extends Controller
{
    public function index()
    {
        $bans = Ban::all();

        return view('admin.Banoverzicht', ['bans' => $bans]);
    }

    public function unbanStudent($userId)
{
    $ban = Ban::where('user_id', $userId)->first();
    if ($ban) {
        $ban->delete();
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'Gebruiker niet gevonden.']);
    }
}


    public function banUser(Request $request)
    {
        $userId = $request->input('user_id');
        $name = $request->input('name');
        $ban = new Ban();
        $ban->user_id = $userId;
        $ban->name = $name;
        $ban->status = 'banned'; 
        $ban->save();
    
        return response()->json(['success' => true]);
    }
    
}