<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->except(Auth::id());
        return view('user.index', compact('users'));
    }
    public function show(User $user)
    {
        $friends = $user->friend();
        return view('user.show',  compact('user', 'friends'));
    }
    public function viewFriend(User $user)
    {
        return view('user.friends', compact('user'));
    }
    public function befriend(User $user)
    {
        auth()->user()->befriend($user);

        return redirect()->back();

    }
    public function acceptFriend(User $user)
    {
        auth()->user()->acceptFriendRequest($user);
        return redirect()->back();
    }
    public function removeFriend(User $user)
    {
        auth()->user()->unfriend($user);
        return redirect()->back();
    }
    public function denyFriend(User $user)
    {
        auth()->user()->denyFriendRequest($user);
        return redirect()->back();
    }
}
