@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            @include('layouts.message')
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Books
                </div>
                <div class="card-body pb-0"> 
                    <div class="d-flex justify-content-between">     
                        <a href="{{route('books.create')}}" class="btn btn-primary">Add Book</a>
                        <form action="" method="get" >
                            <div class="d-flex" style="gap: 5px;">
                                <input type="text" class="form-control" value="{{Request::get('keyword')}}" name="keyword" placeholder="search books..">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{route('books.index')}}" class="btn btn-secondary" style="gap: 5px;">Clear</a>   
                            </div>            
                        </form>
                    </div>           
                    <table class="table  table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th width="150">Action</th>
                            </tr>
                            <tbody>
                                @if ($books->isNotEmpty())
                                    @foreach ($books as $book)

                                @php
                                    if ($book->reviews_count > 0) {
                                        $avgRating = $book->reviews_sum_rating/$book->reviews_count;
                                    } else {
                                        $avgRating  = 0 ;
                                    }
                                @endphp

                                    <tr>
                                        <td>{{$book->title}}</td>
                                        <td>{{$book->author}}</td>
                                        <td>{{number_format($avgRating,1)}} ({{($book->reviews_count > 1) ? $book->reviews_count. ' Reviews' : $book->reviews_count. ' Review' }})</td>
                                        <td>
                                            @if ($book->status == 1)
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Block</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm"><i class="fa-regular fa-star"></i></a>
                                            <a href="{{route('books.edit',$book->id)}}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{route('books.destroy',$book->id)}}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('yakin mau hapus?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5">Books not found</td>
                                    </tr>
                                @endif   
                            </tbody>
                        </thead>
                    </table>
                    @if ($books->isNotEmpty())
                        {{$books->links('pagination::bootstrap-5')}}               
                    @endif
                </div>
                
            </div>                
        </div>
    </div>       
</div>
@endsection
