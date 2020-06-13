@extends('layouts.guest')

@section('content')
<section class="main">
    <div class="row">
        <div class="layer offset-md-3 col-md-6">
            <div class="m-portlet m-portlet--danger m-portlet--head-solid-bg m-portlet--rounded">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="la la-thumb-tack"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                SESSION PORTAL
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-center">
                                <i class="la la-clock-o text-danger"></i> This is an online session portal
                            </h5>
                            <h1 class="text-center digital-clock">
                                00:00:00
                            </h1>
                            <h5 class="text-center">
                                Please click "Sign In" for signing in, and "Sign Off" for signing out
                            </h5>

                            <div class="text-center">
                                <button type="button" action-taken="signin" class="action-btn btn btn-md">
                                    Sign In
                                </button>
                                <button type="button" action-taken="signout" class="action-btn btn btn-md">
                                    Sign Off
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="camera-layer">
                                <i id="dummy-pic" class="flaticon-profile-1"></i>
                                <video class="hidden" id="preview"></video>
                                <div id="custom-pic" class="hidden">
                                    <img link="{{ asset('images') }}" src="{{ asset('images/1824.jpg') }}" />
                                    <h6>
                                        <span name="firstname">sss</span> <span name="lastname">sss</span><br/>
                                        <span name="stud_no">ss</span>
                                    <h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden alert alert-danger alert-dismissible fade show m-alert m-alert--air m-alert--outline m-alert--outline-2x" role="alert">
                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button> -->
                <strong>
                    Well done <span name="firstname"></span>! 
                </strong>
                You have successfully <span class="actions"></span>.
            </div>
        </div>
    </div>
    <div class="row">
        <audio id="access_granted">
            <source src="{{ asset('audio/access_granted.mp3') }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <audio id="try_again">
            <source src="{{ asset('audio/try_again.mp3') }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>
</section>
@endsection

<!-- {{-- @push('styles')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush --}}
@push('scripts')
<script src="{{ asset('js/try.js') }}"></script>
@endpush
 -->