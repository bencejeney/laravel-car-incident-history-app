<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function togglePremium(User $user)
    {
        $user->update(['is_premium' => !$user->is_premium]);
        return redirect()->back()->with('success', 'Premium status updated.');
    }
}
