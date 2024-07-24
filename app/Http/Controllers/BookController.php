<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index(){
        return view('books.list');
    }

    public function create(){
        return view('books.create');
    }

    public function store(Request $request){

        $rules = [
            'title' => 'required|min:5',
            'author' => 'required|min:3',
            'status' => 'required'
        ];

        if (!empty($request->image)) {
            $rules = ['image'];
        }

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('books.create')->withInput()->withErrors($validator);
        }


        $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->status = $request->status;
        $book->save();

        return redirect()->route('books.index')->with('success', 'Book added successfully');

    }
}
