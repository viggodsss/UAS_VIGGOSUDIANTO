<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $Game = Game::latest()-> paginate(5);
        return view('Game.index',compact('Game'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('Game.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Game' => 'required',
            'Developers' => 'required',
        ]);
  
        Game::create($request->all());
   
        return redirect()->route('admin.game.index')->with('success','Game created successfully.');
    }

    public function show(Game $Game)
    {
        return view('Game.show',compact('Game'));
    }

    public function edit(Game $Game)
    {
        return view('Game.edit',compact('Game'));
    }

    public function update(Request $request, Student $Game)
    {
        $request->validate([
            'Game' => 'required',
            'Developers' => 'required',
        ]);
  
        $Game->update($request->all());
  
        return redirect()->route('admin.Game.index')->with('success','Game updated successfully');
    }

    public function destroy(Student $product)
    {
        $product->delete();
  
        return redirect()->route('admin.Game.index')->with('success','Game deleted successfully');
    }
}
