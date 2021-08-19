<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function index(){
        $items = Item::all();
        return view('livewire/items/show')->with('items',$items);
    }
    public function getAllItems(){
        $items = Item::all();
        return response()->json($items);
    }
    public function add(Request $req){
        $item = new Item;
        $item->name = $req->name;
        $item->category = $req->category;
        $item->description = $req->description;
        $item->thickness = $req->thickness;
        $item->supplier = $req->supplier;
        $item->jigs = $req->jigs;
        $item->per_box = $req->per_box;
        $item->status = 'active';
        $item->save();
        return redirect('/item');
    }
    public function update(Request $req){
        $item = Item::find($req->id);
        $item->category = $req->category;
        $item->name = $req->name;
        $item->description = $req->description;
        $item->thickness = $req->thickness;
        $item->supplier = $req->supplier;
        $item->jigs = $req->jigs;
        $item->per_box = $req->per_box;
        $item->status = $req->status;
        $item->save();
        return redirect('/item');
    }
    public function delete(Request $req){
        $item = Item::find($req->id);
        $item->delete();
        return redirect('/item');
    }
}
