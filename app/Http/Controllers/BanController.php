<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ban;

class BanController extends Controller
{
    public function index()
    {
        $bans = Ban::all();

        return view('Admin.Banoverzicht', ['bans' => $bans]);
    }

    public function unbanStudent($id)
    {
        $ban = Ban::find($id);
        if ($ban) {
            $ban->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Student niet gevonden.']);
        }
    }
}