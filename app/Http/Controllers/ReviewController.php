<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

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

        return view('account.reviews.edit',[
            'review' => $review
        ]);
    }

    public function updateReview(Request $request, int $id){

        $review = Review::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'review' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->route('account.reviews.edit',$id)->withInput()->withErrors($validator);
        }

        $review->review = $request->review;
        $review->status = $request->status;
        $review->save();

        session()->flash('success', 'Review Updated Successfully');
        return redirect()->route('account.reviews');

    }

    public function deleteReview(Request $request){
        $id = $request->id;

        $review = Review::find($id);

        if ($review == null) {
            session()->flash('error', 'review not found');

            return response()->json([
                'status' => false
            ]);
        } else {
            $review->delete();

            session()->flash('success', 'review deleted successfully');

            return response()->json([
                'status' => false
            ]);
        }
    }
}
