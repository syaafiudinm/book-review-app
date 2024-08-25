@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            @include('layouts.sidebar')              
        </div>
        <div class="col-md-9">
            
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    My Reviews
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-end">     
                        <form action="" method="get" >
                            <div class="d-flex" style="gap: 5px;">
                                <input type="text" class="form-control" value="{{Request::get('keyword')}}" name="keyword" placeholder="search books..">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{route('account.reviews.myReviews')}}" class="btn btn-secondary" style="gap: 5px;">Clear</a>   
                            </div>            
                        </form>
                    </div>                 
                    <table class="table  table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Book</th>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Status</th>                                  
                                <th width="100">Action</th>
                            </tr>
                            <tbody>
                                @if ($reviews->isNotEmpty())
                                    @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{$review->book->title}}</td>
                                        <td>{{$review->review}}</td>                                        
                                        <td>{{$review->rating}}</td>
                                        <td>
                                            @if ($review->status == 1)
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">block</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="edit-review.html" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif                             
                            </tbody>
                        </thead>
                    </table>   
                    @if ($reviews->isNotEmpty())
                        {{$reviews->links('pagination::bootstrap-5')}}               
                    @endif             
                </div>
                
            </div>                
        </div>
    </div>       
</div>
@endsection