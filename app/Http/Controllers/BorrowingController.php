<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrower_name' => 'required|string|max:255',
            'borrower_phone' => 'required|string|max:20',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->status !== 'available') {
            return back()->with('error', 'Maaf, buku ini sedang tidak tersedia untuk dipinjam.');
        }

        // Create the borrowing record
        Borrowing::create([
            'book_id' => $book->id,
            'borrower_name' => $request->borrower_name,
            'borrower_phone' => $request->borrower_phone,
            'user_id' => auth()->id(), // Optional: link to auth user if logged in
            'borrowed_at' => now(),
            'due_at' => now()->addDays(7), // Default 7 days
        ]);

        // Update book status
        $book->update(['status' => 'borrowed']);

        return back()->with('success', 'Buku "' . $book->title . '" berhasil dipinjam. Silakan ambil di perpustakaan dalam 24 jam.');
    }
}
