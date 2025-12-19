@extends('layout.master')
@php
$segment = request()->segment(1); // Gets the first segment after domain
@endphp
<style>
    .genete-btn {
        -webkit-font-smoothing: antialiased;
        background-color: #ff9900;
        background-repeat: repeat-x;
        background-image: none;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.00);
        font-weight: bold;
        font-size: 20px;
        text-align: center;
        width: 100%;
        font-weight: 700 !important;
        margin-top: 15px;
        color: #ffffff;
        border: none;
        border-radius: 7px;
        display: flex;
        justify-content: center
    }

    .img-div {
        height: 358px;
        width: 655px;
    }



    .img-div img {
        height: 100%;
        border-radius: 30% 70% 7% 93% / 70% 30% 70% 30%;
        transform-origin: top center;
        /* Optional: smooth edges */
        display: block;
        margin: 0 auto;

        /* Animation */
        animation: swing 4s ease-in-out infinite alternate;
    }

    @keyframes swing {
        0% {
            transform: rotate(-10deg);
        }

        50% {
            transform: rotate(10deg);
        }

        100% {
            transform: rotate(-10deg);
        }
    }
</style>
@section('content')
<div class="container text-center py-5">
    @if($segment == 'secret')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 pt-5">
            <h3 class="text-start">Your secret has been expired aur already viewed 🔒</h3>
            <a href="{{url('/')}}" class="genete-btn py-3 mt-4 text-decoration-none">Generate a new secret</a>
        </div>
        <div class="col-12 col-md-8 d-flex justify-content-center">
            <div class="img-div  mt-5">
                {{-- <img src="{{ asset('images/new.svg') }}" alt="image" class="w-100 h-100"> --}}
                <img class="w-100 h-100"
                    src="https://cdn.pixabay.com/animation/2023/09/30/00/57/00-57-32-533_512.gif"
                    alt="">

            </div>
        </div>
    </div>
    @endif
    @if($segment == 'private')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 pt-5">
            <h3 class="text-start">Sorry!</h3>
            <p style="text-align: left">You have already viewed this page. For security reasons, one-time secrets cannot
                be viewed again, so you are not authorized to access this page.</p>
            <a href="{{url('/')}}" class="genete-btn py-3 mt-4 text-decoration-none">Generate a new secret</a>
            <div class="img-div mt-5">
                {{-- <img src="{{ asset('images/new.svg') }}" alt="image" class="w-100 h-100"> --}}
                <img src="https://cdn.pixabay.com/animation/2023/09/30/00/57/00-57-32-533_512.gif"
                    alt="">
            </div>
        </div>
    </div>
    @endif
</div>
@endsection