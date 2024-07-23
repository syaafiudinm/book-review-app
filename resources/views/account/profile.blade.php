@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-lg">
                <div class="card-header  text-white">
                    Welcome, {{Auth::user()->name}}                       
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if (Auth::user()->image != "")
                            <img src="{{asset('uploads/profile/'.Auth::user()->image)}}" class="img-fluid rounded" alt="" width="150">  
                        @endif                       
                    </div>
                    <div class="h5 text-center">
                        <strong>{{Auth::user()->name}}</strong>
                        <p class="h6 mt-2 text-muted">5 Reviews</p>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-lg mt-3">
                <div class="card-header  text-white">
                    Navigation
                </div>
                <div class="card-body sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="book-listing.html">Books</a>                               
                        </li>
                        <li class="nav-item">
                            <a href="reviews.html">Reviews</a>                               
                        </li>
                        <li class="nav-item">
                            <a href="profile.html">Profile</a>                               
                        </li>
                        <li class="nav-item">
                            <a href="my-reviews.html">My Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a href="change-password.html">Change Password</a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{route('account.logout')}}">Logout</a>
                        </li>                           
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @include('layouts.message')
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Profile
                </div>
                <div class="card-body">
                    <form action="{{route('account.updateProfile')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{old('name',$user->name)}}" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" id="" />
                            @error('name')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label @error('email') is-invalid @enderror">Email</label>
                            <input type="text" value="{{old('email',$user->email)}}" class="form-control" placeholder="Email"  name="email" id="email"/>
                            @error('email')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                            @if (Auth::user()->image != "")
                                <img src="{{asset('uploads/profile/'.Auth::user()->image)}}" class="img-fluid mt-4" alt="" width="100">
                            @endif
                        </div>   
                        <button class="btn btn-primary mt-2">Update</button>                     
                    </form>
                </div>
            </div>                
        </div>
    </div>       
</div>
@endsection