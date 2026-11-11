<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function weather()
    {
        return view('blog.weather');

    }
    public function Promotional()
    {
        return view('blog.Promotional');
    }
    public function Nizami()
    {
        return view('blog.Nizami');
    }
}
