<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LendingController extends Controller
{
    public function index()
    {
        return view('enlight_lending.index');
    }
}
