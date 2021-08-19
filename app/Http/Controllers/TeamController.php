<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    //
    public function index(){
        $teams = Team::all();
        return view('livewire/team/show')->with('teams',$teams);
    }
    public function add(Request $req){
        $team = new Team;
        $team->name = $req->name;
        $team->description = $req->description;
        $team->save();
        return redirect('/team');
    }
    public function update(Request $req){
        $team = Team::find($req->id);
        $team->name = $req->name;
        $team->description = $req->description;
        $team->save();
        return redirect('/team');
    }
    public function delete(Request $req){
        $team = Team::find($req->id);
        $team->delete();
        return redirect('/team');
    }
}
