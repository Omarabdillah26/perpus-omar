<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $borrowedBooks = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->whereNull('returned_at')
            ->get();
            
        $history = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->whereNotNull('returned_at')
            ->latest()
            ->get();

        return view('student.dashboard', compact('borrowedBooks', 'history'));
    }

    public function borrowForm()
    {
        $books = Book::where('status', 'available')->get();
        return view('student.borrow', compact('books'));
    }

    public function returnForm()
    {
        $borrowedBooks = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->whereNull('returned_at')
            ->get();
            
        return view('student.return', compact('borrowedBooks'));
    }
}
