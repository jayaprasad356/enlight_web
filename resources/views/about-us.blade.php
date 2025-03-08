@extends('layouts.app')

@section('page-title', 'About Us')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Welcome to <span class="text-primary">Enlight</span></h1>
        <p class="lead">Your trusted partner in achieving a healthier, happier, and more fulfilling life.</p>
    </div>

    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <div class="text-center">
                <img src="https://pharmaceutical-journal.com/wp-content/uploads/2021/01/herbal-medicines-ss-18-scaled.jpg" 
                    class="img-fluid rounded-4 shadow-lg w-100" 
                    alt="Wellbeing">
            </div>
        </div>

        <div class="col-md-6">
            <h2 class="fw-bold">Our Mission</h2>
            <p>At <strong>Enlight</strong>, we are dedicated to empowering individuals to unlock their full potential by embracing a holistic approach to wellbeing.</p>
            <p>True wellness isn’t just about avoiding illness—it’s about thriving physically, emotionally, and mentally, every single day.</p>
        </div>
    </div>

    <div class="text-center my-5">
        <h2 class="fw-bold text-success">Transform Your Life with Our Wellbeing Program</h2>
    </div>

    <div class="row text-center">
        <div class="col-md-4">
            <div class="card shadow-sm p-4 border-0 rounded">
                <i class="fas fa-apple-alt fa-3x text-primary mb-3"></i>
                <h4 class="text-primary fw-bold">Nourishing Foods</h4>
                <p>Fuel your body with nutrient-rich, wholesome foods that enhance your energy, vitality, and overall health.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-4 border-0 rounded">
                <i class="fas fa-utensils fa-3x text-primary mb-3"></i>
                <h4 class="text-primary fw-bold">Personalized Diet Plans</h4>
                <p>Enjoy customized meal plans tailored to your body’s unique needs, helping you achieve optimal health effortlessly.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-4 border-0 rounded">
                <i class="fas fa-spa fa-3x text-primary mb-3"></i>
                <h4 class="text-primary fw-bold">Revitalizing Yoga</h4>
                <p>Discover the transformative power of yoga to achieve balance, mindfulness, and inner peace.</p>
            </div>
        </div>
    </div>

    <div class="row align-items-center my-5">
        <div class="col-md-6 order-md-2">
            <img src="https://pharmaceutical-journal.com/wp-content/uploads/2021/01/herbal-medicines-ss-18-scaled.jpg" class="img-fluid rounded shadow" alt="Herbal Products">
        </div>
        <div class="col-md-6 order-md-1">
            <h2 class="fw-bold text-success">Harness the Power of Herbal Remedies</h2>
            <p>We offer a premium selection of natural herbal products designed to enhance your overall health and vitality.</p>
            <p>Whether you seek stress relief, immune system support, or natural healing solutions, our carefully curated products help you restore balance and harmony in life.</p>
        </div>
    </div>

    <div class="text-center my-5">
        <h2 class="fw-bold text-warning">Turn Your Passion into Prosperity</h2>
    </div>

    <div class="row text-center">
        <div class="col-md-8 offset-md-2">
            <p>Join <strong>Enlight</strong> and unlock an incredible opportunity to earn up to <span class="fw-bold text-success">₹40,000 per month</span> by engaging in our rewarding business model.</p>
            <p>As a member, you’ll not only improve lives but also create a sustainable income stream doing something meaningful and impactful.</p>
            <a href="{{ route('mobile.login') }}" class="btn btn-lg btn-primary mt-3">Join Now</a>

        </div>
    </div>
</div>
@endsection
