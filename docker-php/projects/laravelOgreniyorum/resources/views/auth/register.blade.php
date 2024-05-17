@extends("layouts.auth")

@section("title")
Register
@endsection

@section("css")
@endsection 

@section("content")
<div class="app app-auth-sign-up align-content-stretch d-flex flex-wrap justify-content-end">
    <div class="app-auth-background">
    </div>
    
    <div class="app-auth-container">
        <div class="logo">
            <a href="index.html">Petite Blog</a>
        </div>
        
        <form action="{{ route('Register') }}" method="POST">
            @csrf
            <div class="auth-credentials m-b-xxl">
                <label for="name" class="form-label">Username</label>
                <input type="text" name="name" class="form-control m-b-md" id="name" aria-describedby="name" placeholder="Enter username">

                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control m-b-md" id="email" aria-describedby="email" placeholder="example@neptune.com">

                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" aria-describedby="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                <div id="emailHelp" class="form-text">Password must be minimum 8 characters length*</div>
            </div>

            <div class="auth-submit">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
        </form>

        <div class="divider"></div>
        <div class="auth-alts">
            <a href="#" class="auth-alts-google"></a>
            <a href="#" class="auth-alts-facebook"></a>
            <a href="#" class="auth-alts-twitter"></a>
        </div>
    </div>
</div>
@endsection 

@section("js")
@endsection
