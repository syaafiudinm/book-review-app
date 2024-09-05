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
                        Change Password
                    </div>
                    <div class="card-body">
                        <form action="{{route('account.reset-password')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Old Password</label>
                                <input type="password" class="form-control  @error('current_password') is-invalid @enderror" placeholder="Old Password" name="current_password" id="current_password" />
                                @error('current_password')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password"  name="new_password" id="new_password"/>
                                @error('new_password')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" placeholder="Confirm Password"  name="new_password_confirmation" id="new_password_confirmation"/>
                                @error('new_password_confirmation')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>                   
                    </div>
                </div>                
            </div>
        </div>       
    </div>
@endsection