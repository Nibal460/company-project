<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Import the base controller class
use Illuminate\Support\Facades\Auth;

class HomeController1 extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // You can remove the check for authentication
        // $isLoggedIn = Auth::check();

        // You can pass any other data to the view if needed
        // For example:
        // $someData = ...

        // Return the view
        return view('home1');
    }
}
