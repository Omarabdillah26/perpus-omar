<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with('book')->latest()->get();
        return view('admin.borrowings.index', compact('borrowings'));
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->returned_at) {
            return back()->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        // Update borrowing record
        $borrowing->update([
            'returned_at' => now(),
        ]);

        // Update book status
        $borrowing->book->update([
            'status' => 'available',
        ]);

        return back()->with('success', 'Buku "' . $borrowing->book->title . '" berhasil ditandai sebagai dikembalikan.');
    }
}
