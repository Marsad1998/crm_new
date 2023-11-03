<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tenant = Tenant::create([
            'id' => 'quotegen1',
        ]);

        $tenant->domains()->create([
            'domain' => 'test1.localhost',
        ]);
        return;
        return view('central.index');
    }

    public function index2()
    {
        return view('tenant.index');
    }

    public function index3()
    {
        return view('tenant.quote_generator');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
