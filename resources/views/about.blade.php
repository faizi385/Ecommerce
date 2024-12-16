@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-o shadow-sm">
                    <div class="card-header">
                        <h3 class="mb-0">About Us</h3>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">Our Mission</h4>
                        <p>
                            Welcome to [Your Company Name], where we are dedicated to providing the best products and services to our customers. Our mission is to deliver exceptional quality and value in everything we do, and we are committed to continuously improving and innovating to meet the needs of our customers.
                        </p>
                        
                        <h4 class="mb-4">Our Story</h4>
                        <p>
                            Founded in [Year], [Your Company Name] started with a simple idea: to make high-quality products accessible and affordable for everyone. Over the years, we have grown from a small startup to a leading player in our industry, thanks to the hard work and dedication of our team and the support of our loyal customers.
                        </p>
                        
                        <h4 class="mb-4">Our Values</h4>
                        <ul>
                            <li><strong>Customer Satisfaction:</strong> We prioritize our customers and strive to exceed their expectations.</li>
                            <li><strong>Integrity:</strong> We conduct our business with honesty and transparency.</li>
                            <li><strong>Innovation:</strong> We embrace new ideas and technologies to improve our products and services.</li>
                            <li><strong>Teamwork:</strong> We believe in working together to achieve common goals.</li>
                        </ul>
                        
                        <h4 class="mb-4">Meet the Team</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="team-member text-center">
                                    <img src="{{ asset('storage/images/testimonial-edward.png') }}" alt="Team Member" class="img-fluid rounded-circle mb-2">
                                    <h5>Jane Doe</h5>
                                    <p>CEO & Founder</p>
                                    <p>Jane is the visionary behind [Your Company Name], leading the company with a passion for excellence and innovation.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="team-member text-center">
                                    <img src="{{ asset('storage/images/Matt-T-Testimonial-pic.jpg') }}" alt="Team Member" class="img-fluid rounded-circle mb-2">
                                    <h5>John Smith</h5>
                                    <p>Chief Technology Officer</p>
                                    <p>John is responsible for overseeing the technology and innovation strategies that drive our products forward.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="team-member text-center">
                                    <img src="{{ asset('storage/images/depositphotos_420021494-stock-photo-portrait-female-owner-gift-store.jpg') }}"alt="Team Member" class="img-fluid rounded-circle mb-2">
                                    <h5>Emily Johnson</h5>
                                    <p>Head of Marketing</p>
                                    <p>Emily leads our marketing efforts, ensuring that our brand message resonates with our audience.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
