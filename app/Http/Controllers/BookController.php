<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = \App\Models\Book::with('category')->latest()->get();
        $categories = \App\Models\Category::all();
        return view('welcome', compact('books', 'categories'));
    }
}
