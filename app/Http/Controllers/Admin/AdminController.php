<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\File;

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

    public function profile()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }
    public function profile_data(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'current_password' => 'required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $admin = Auth::user();
        $data = [
            'name' => $request->name,
        ];
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $admin->update($data);

        if ($request->hasFile('image')) {
            if ($admin->image) {
                File::delete(public_path('images/' . $admin->image->path));
                $admin->image()->delete();
            }
            $img = $request->File('image');
            $img_name = rand() . time() . $img->getClientOriginalName();
            $img->move(public_path('images'), $img_name);
            $admin->image()->create([
                'path' => $img_name,
            ]);
        }

        return redirect()->back()->with('msg', 'Profile Update Successfully');
    }

    public function check_password(Request $request)
    {

        return (Hash::check($request->password, Auth::user()->password));
    }
}
