<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count = [
            'rw' => Rw::count(),
            'rt' => Rt::count(),
            'warga' => Warga::count(),
            'user' => User::count()
        ];
       return view('admin.pages.dashboard',[
        'title' => 'Dashboard',
        'count' => $count,
       ]);
    }
}
