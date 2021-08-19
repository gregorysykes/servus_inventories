<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\State;

class StateController extends Controller
{
    //
    public function index(){
        $states = State::orderBy('sequence')->get();
        return view('livewire/state/show')->with('states',$states);
    }
    public function add(Request $req){
        $s = State::all();
        $state = new State;
        $state->state = $req->state;
        $state->sequence = count($s)+1;
        $state->save();
        return redirect('/state');
    }
    public function update(Request $req){

        $state = State::find($req->id);
        $states = State::orderBy('sequence')->get();

        // dd($states[0]->index);

        if($state->sequence != $req->sequence){
            //target sequence
            $s = State::where('sequence',$req->sequence)->first();

            if($req->sequence > $state->sequence){
                for($i=$state->sequence;$i<$req->sequence;$i++){
                    $states[$i]->sequence -= 1;
                    $states[$i]->save();
                }
            }else if($req->sequence < $state->sequence){
                for($i=$req->sequence-1;$i<$state->sequence;$i++){
                    $states[$i]->sequence += 1;
                    $states[$i]->save();
                }
            }

        }

        $state->state = $req->state;
        $state->sequence = $req->sequence;
        $state->save();

        return redirect('/state');
    }
    public function delete(Request $req){
        $state = State::find($req->id);
        $state->delete();
        return redirect('/state');
    }
}
