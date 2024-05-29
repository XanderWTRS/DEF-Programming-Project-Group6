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

    public function unbanStudent($name)
{
    $ban = Ban::where('name', $name)->first();
    if ($ban) {
        $ban->delete();
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'Student niet gevonden.']);
    }
}

    public function banUser(Request $request)
    {
        // Verkrijg de gegevens van het verzoek
        $userId = $request->input('user_id');
        $name = $request->input('name');
    
        // Opslaan van de gegevens in de bans tabel
        $ban = new Ban();
        $ban->user_id = $userId;
        $ban->name = $name;
        $ban->status = 'banned'; // Update de status naar 'banned'
        $ban->save();
    
        return response()->json(['success' => true]);
    }
    
}