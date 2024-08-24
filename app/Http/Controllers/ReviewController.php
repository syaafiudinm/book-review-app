<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request){
        $reviews = Review::with('book','user')->orderBy('created_at', 'desc');
        
        if(!empty($request->keyword)) {
            $reviews = $reviews->where('review', 'like', '%'.$request->keyword.'%');
        }

        $reviews = $reviews->paginate(10);

        return view('account.reviews.list',[
            'reviews' => $reviews
        ]);
    }

    public function edit(int $id){
        $review = Review::findOrFail($id);
    }
}
