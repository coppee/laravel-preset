<?php
namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function index()
    {
        return view('open.homepage.index');
    }
}
