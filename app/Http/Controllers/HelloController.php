<?php

namespace App\Http\Controllers; //indentifier yang menunjukkan file/class controller berada dinamespace mana yang nanti pathnya digunakan di use pada route

use Illuminate\Http\Request; //

class HelloController extends Controller
{
    function index() {
        echo "Hello Robi Rahman";
    }

    function world_message() {
        echo "World";
    }
}
