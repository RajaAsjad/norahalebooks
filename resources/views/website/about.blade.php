@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', 'Meet Nora Hale — retired Registered Nurse, wellness author of Castor Oil for Life and Simple Habits for a Vibrant Life.')
@section('content')
<div class="page">
    <section class="page-hero mesh">
        <div class="c">
            <span class="badge bp">About Nora</span>
            <h1 class="page-hero-title">Meet <span class="gt">Nora Hale</span></h1>
            <p class="page-hero-sub">Registered Nurse · Wellness Author · Advocate for Simple, Vibrant Living</p>
        </div>
    </section>
    <section class="sec">
        <div class="c">
            <div class="abt-og">
                <div class="rev">
                    <h2 class="sttl lg" style="margin-bottom:24px">It's Never Too Late to Reinvent Your Life</h2>
                    <div class="ogp">
                        <p>Meet Nora Hale, a 68-year-old dynamo who proves that age is just a number when it comes to living well. After an accomplished career as a Registered Nurse, Nora traded her scrubs for a pen and a mission: to empower people of all ages to embrace the power of small, positive changes.</p>
                        <p>Nora's passion for wellness and her decades of experience in healthcare come together in her delightful, practical guide, <strong>Simple Habits for a Vibrant Life</strong>. With her signature warmth and wisdom, she shows that feeling energized, focused, and joyful doesn't require drastic life overhauls — just simple, science-backed habits that make a world of difference.</p>
                        <p>In <strong>Castor Oil for Life</strong>, Nora brings the same passion and depth to an ancient remedy with a fascinating history. With science-backed benefits, practical recipes, and inspiring insights, she guides readers through the many ways castor oil can transform beauty, health, and vitality.</p>
                        <p>Because sometimes, the most powerful solutions are the simplest ones.</p>
                    </div>
                    <div class="hbtns" style="margin-top:28px">
                        <a href="{{ route('books') }}" class="btn btn-p">Browse Books</a>
                        <a href="{{ route('connect') }}" class="btn btn-s">Join Newsletter</a>
                    </div>
                </div>
                <div class="rev" data-delay="150">
                    <div class="author-portrait gc">
                        <div class="author-portrait-inner">
                            <span class="author-initials">NH</span>
                            <p>Nora Hale</p>
                            <small>Author & Registered Nurse</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
