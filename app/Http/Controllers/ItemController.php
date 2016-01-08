<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\GameTitle;
use App\Models\Item;

use Input;
use Redirect;
use View;

class ItemController extends Controller
{

	public function __construct() {
        $this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $games = GameTitle::all();
        $item_types = [
            'Weapon' => 'Weapon', 
            'Specialist' => 'Specialist', 
            'Equipment' => 'Equipment',
            'Streak' => 'Streak'
        ];
        return View::make('admin.item.create', compact('games', 'item_types'));
    }

    public function manage()
    {
        $items = Item::with('game')->get();

        return View::make('admin.item.manage', compact('items'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $item = new Item;
        $item->name = Input::get('name');
        $item->type = Input::get('type');
        $item->game_title_id = Input::get('game');
        $item->save();
		return Redirect::action('AdminController@dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        Item::destroy($id);
		return Redirect::action('AdminController@dashboard');
        //
    }
}
