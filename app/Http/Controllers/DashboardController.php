<?php

namespace App\Http\Controllers;

use App\Models\IncomingMail;
use App\Models\OutgoingMail;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countIncomingMail = IncomingMail::all()->count();

        $countOutgoingMail = OutgoingMail::all()->count();

        $countUser = User::all()->count();

        return view('dashboard.index', get_defined_vars());
    }
}
