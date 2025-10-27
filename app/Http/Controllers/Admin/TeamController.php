<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Team::latest('id')->paginate();
        return view('admin.team.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
        ]);

        $data = Team::create([
            'name' => $request->name,
            'body' => $request->body,
        ]);
        // dd($data);

        $img = $request->file('image');
        $img_name = rand() . time() . $img->getClientOriginalName();
        $img->move(public_path('images'), $img_name);
        $data->image()->create([
            'path' => $img_name,
        ]);

        return redirect()->route('admin.team.index')->with('msg', 'Add Team was Successfully')
            ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $team->update([
            'name' => $request->name,
            'body' => $request->body,
        ]);

        if ($request->hasFile('image')) {
            if ($team->image) {
                File::delete(public_path('images/' . $team->image->path));
                $team->image()->delete();
            }
            $img = $request->file('image');
            $img_name = rand() . time() . $img->getClientOriginalName();
            $img->move(public_path('images'), $img_name);
            $team->image()->create([
                'path' => $img_name,
            ]);
        }

        return redirect()->route('admin.team.index')
            ->with('msg', 'Edit Team was Successfully')
            ->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        if ($team->image) {
            File::delete(public_path('images/' . $team->image->path));
            $team->image()->delete();
        }
        $team->delete();
        return redirect()->route('admin.team.index')
            ->with('msg', 'Delete Team was Successfully')
            ->with('type', 'danger');
    }
}
