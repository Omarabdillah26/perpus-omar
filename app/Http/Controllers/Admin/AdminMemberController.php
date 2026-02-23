<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminMemberController extends Controller
{
    public function index()
    {
        $members = User::where('is_admin', false)->latest()->get();
        return view('admin.members.index', compact('members'));
    }

    public function destroy(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'Tidak dapat menghapus admin.');
        }

        $user->delete();
        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
