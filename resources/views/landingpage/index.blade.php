@extends('landingpage.app')

@section('content')
    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center my-5 py-5">
            <h1 class="text-white mt-4 mb-4">Online TOEIC Registration</h1>
            <h1 class="text-white display-1 mb-5">Smart TOEIC Access</h1>
            <h1 class="text-white mt-4 mb-4">Politeknik Negeri Malang</h1>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="{{ asset('landingpage/img/bg-section.png') }}" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">About Us</h6>
                        <h1 class="display-4">Integrated TOEIC Registration System</h1>
                    </div>
                    <p>This system enables students to register for the TOEIC exam online. From account creation by the
                        Language Center (UPA Bahasa), form submission, data validation, to exam scheduling and certificate
                        collection — all processes are structured and accessible anytime, anywhere.
                    </p>
                    <div class="row pt-3 mx-0">
                        <div class="col-3 px-0">
                            <div class="bg-success text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">123</h1>
                                <h6 class="text-uppercase text-white">10+ AUTOMATED<span class="d-block">PROCCESS
                                        STAGES</span>
                                </h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-primary text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">1234</h1>
                                <h6 class="text-uppercase text-white">100% <span class="d-block">ONLINE ACCESS</span></h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-secondary text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">123</h1>
                                <h6 class="text-uppercase text-white">VERIFIED<span class="d-block">BY UPA BAHASA</span>
                                </h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-warning text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">1234</h1>
                                <h6 class="text-uppercase text-white">OFFICIAL CERTIFICATE<span class="d-block">FROM ITC</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Feature Start -->
    <div class="container-fluid bg-image" style="margin: 90px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 my-5 pt-5 pb-lg-5">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Why Choose Us?</h6>
                        <h1 class="display-4">Why Should You Use the
                            TOEIC Registration System?</h1>
                    </div>
                    <p class="mb-4 pb-2">The system is designed to provide simplicity, data security, and a clear
                        step-by-step process — from registration to certification.</p>
                    <div class="d-flex mb-3">
                        <div class="btn-icon bg-primary mr-4">
                            <i class="fa fa-2x fa-graduation-cap text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Automated Data Validation</h4>
                            <p>The Language Center verifies your registration and payment data systematically and securely.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="btn-icon bg-secondary mr-4">
                            <i class="fa fa-2x fa-certificate text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>International Certificate</h4>
                            <p>The TOEIC exam is held by ITC and the certificates are internationally recognized.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="btn-icon bg-warning mr-4">
                            <i class="fa fa-2x fa-book-reader text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Online Registration Process</h4>
                            <p class="m-0">Students simply log in, fill out the form, and follow the guided steps — no
                                physical presence required.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="{{ asset('landingpage/img/bg-section-why.png') }}"
                            style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Start -->


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="section-title text-center position-relative mb-5">
                <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">KELOMPOK 1 PBL</h6>
                <h1 class="display-4">Meet Our Team</h1>
            </div>
            <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
                <div class="team-item">
                    <img class="img-fluid w-100" src="{{ asset('landingpage/img/nata.jpg') }}" alt="">
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3">An Naastasya Sakina</h5>
                        <p class="mb-2">2341760131</p>
                    </div>
                </div>
                <div class="team-item">
                    <img class="img-fluid w-10" src="{{ asset('landingpage/img/titan1.jpg') }}" alt="">
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3">Titania Aurellia P. D.</h5>
                        <p class="mb-2">2341760112</p>
                    </div>
                </div>
                 <div class="team-item">
                    <img class="img-fluid w-100" src="{{ asset('landingpage/img/vera1.jpg') }}" alt="">
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3">Vera Efita Hudi Putri</h5>
                        <p class="mb-2">2341760047</p>
                    </div>
                </div>
                 <div class="team-item">
                    <img class="img-fluid w-100" src="{{ asset('landingpage/img/zaki.jpg') }}" alt="">
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3">Mochamad Zacky Y. A.</h5>
                        <p class="mb-2">2341760147</p>
                    </div>
                </div>
                 <div class="team-item">
                    <img class="img-fluid w-100" src="{{ asset('landingpage/img/ivan.jpg') }}" alt="">
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3">Ivan Rizal Ahmadi</h5>
                        <p class="mb-2">2341760128</p>
                    </div>
                </div>
                <!-- Add more team items as necessary -->
            </div>
        </div>
    </div>
    <!-- Team End -->
@endsection