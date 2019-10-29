<?php

namespace App\Http\Controllers\Admin\Games;

use App\Http\Controllers\Controller;

class GamesController extends Controller
{
    public function index()
    {
        return view('admin.games.index');
    }
}
