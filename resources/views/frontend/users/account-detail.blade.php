@extends('frontend.layouts.master')

@section('content')

 <!-- Breadcumb Area -->
 <div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>My Account</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">My Account</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

  <!-- My Account Area -->
  <section class="my-account-area section_padding_100_50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="my-account-navigation mb-50">
                 @include('frontend.users.sidebar')
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="my-account-content mb-50">
                    <h5 class="mb-3">Account Details</h5>

                    <form action="{{route('update.account',$user->id)}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="firstName">First Name *</label>
                                    <input type="text" class="form-control" name="full_name" id="firstName" value="{{$user->full_name}}" placeholder="">
                                    @error('full_name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="displayName">Display Name *</label>
                                    <input type="text" class="form-control" name="username" id="displayName" placeholder="{{$user->username}}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="emailAddress">Email Address *</label>
                                    
                                    <input type="email" class="form-control" name="email" id="emailAddress" value="{{$user->email}}" placeholder="care.designingworld@gmail.com" disabled>
                                    @error('email')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                   
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="emailAddress">Phone Number*</label>
                                    <input type="number" class="form-control" name="phone" id="phone" value="{{$user->phone}}" placeholder="">
                                    @error('phone')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="currentPass">Current Password </label>
                                    <input type="password" name="old_password"  class="form-control" id="currentPass">
                                    @error('old_password')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="newPass">New Password</label>
                                    <input type="password" name="new_password" class="form-control" id="newPass">
                                    @error('new_password')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <label for="confirmPass">Confirm New Password</label>
                                    <input type="password" name="confirm_password" class="form-control" id="confirmPass">
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- My Account Area -->

    
@endsection

@section('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function() {
    var movingDiv = document.getElementById('movingDiv');
    var opacity = 1;
    var translateY = 0;

    var interval = setInterval(function() {
        opacity -= 0.02; // Giảm giá trị opacity mỗi lần gọi
        translateY -= 1; // Giảm giá trị translateY mỗi lần gọi
        movingDiv.style.opacity = opacity;
        movingDiv.style.transform = 'translateY(' + translateY + 'px)';

        if (opacity <= 0) {
            clearInterval(interval); // Dừng vòng lặp khi opacity đạt giá trị 0
            movingDiv.style.display = 'none'; // Ẩn phần tử khi opacity đạt giá trị 0
        }
    }, 20); // Thời gian trong miligiây giữa các lần gọi
});

    </script>
@endsection