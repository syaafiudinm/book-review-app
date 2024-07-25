<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index(Request $request){

        $books = Book::orderBy('created_at', 'DESC');

        if (!empty($request->keyword)){
            $books->where('title', 'like','%'.$request->keyword.'%');
        }

        $books = $books->paginate(5)->withQueryString();

        return view('books.list',[
            'books' => $books
        ]);
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
            $rules['image'] = 'image';
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

        if(!empty($request->image)){
            File::delete(public_path('uploads/books/'.$book->image));

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $image->move(public_path('uploads/books'),$imageName);

            $book->image = $imageName;
            $book->save();
        }

        return redirect()->route('books.index')->with('success', 'Book added successfully');

    }

    public function edit(int $id){
        $book = Book::findOrFail($id);

        return view('books.edit',[
            'book' => $book
        ]);
    }

    public function update(int $id,Request $request){

        $book = Book::findOrFail($id);

        $rules = [
            'title' => 'required|min:5',
            'author' => 'required|min:3',
            'status' => 'required'
        ];

        if (!empty($request->image)) {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('books.edit',$book->id)->withInput()->withErrors($validator);
        }


        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->status = $request->status;
        $book->save();

        if(!empty($request->image)){
            File::delete(public_path('uploads/books/'.$book->image));

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $image->move(public_path('uploads/books'),$imageName);

            $book->image = $imageName;
            $book->save();
        }

        return redirect()->route('books.index')->with('success', 'Book updated successfully');

    }
}
