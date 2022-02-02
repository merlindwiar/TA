<?php

namespace App\Http\Controllers;
namespace App\Events\Kekeruhan;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        event(new Kekeruhan('Someone'));
        return "Event has been sent!";
    }
}
