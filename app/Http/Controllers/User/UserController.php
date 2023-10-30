<?php

namespace App\Http\Controllers\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use DateTime;
use DateTimeZone; // Import DateTimeZone


class UserController extends Controller
{

    public function index()
    {
            return view('user.index', [
                'title' => 'Dashboard',
                'secction' => 'Dashboard',
                'active' => 'Dashboard'
            ]);
    }

}
