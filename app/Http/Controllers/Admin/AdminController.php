<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }

    public function users()
    {
        $data = User::latest('id')->paginate();
        $teams = Team::all();
        return view('admin.users', compact('data', 'teams'));
    }

    public function select_user(Request $request, $id)
    {
        $item = User::findOrFail($id);
        $item->update([
            'team_id' => $request->team_id,
        ]);
        return back()->with('msg', ' The team has been updated successfully ✅')
            ->with('type', 'success');
    }
}
