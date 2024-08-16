<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $books = Book::orderBy('created_at', 'DESC');

        if (!empty($request->keyword)) {
            $books->where('title','like','%'.$request->keyword.'%');
        }
        
        $books = $books->where('status',1)->paginate(4)->withQueryString();

        return view('home',[
            'books' => $books
        ]);
    }
}
