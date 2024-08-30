<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageDisplayController extends Controller
{
    public function show()
    {
        return view('image_display'); // Assuming you have an image_display.blade.php file
    }
}
