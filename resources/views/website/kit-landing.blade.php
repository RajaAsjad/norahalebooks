@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $meta_description)
@section('content')
<div class="page">
    <section class="kit-hero mesh">
        <canvas id="kit-canvas" class="hero-canvas" aria-hidden="true"></canvas>
        <div class="c kit-hero-inner rev">
            <span class="badge be">Nora Hale Books</span>
            <h1 class="page-hero-title">{{ $kit['title'] ?? 'Sign Up' }}</h1>
            <p class="page-hero-sub">{{ $kit['subtitle'] ?? '' }}</p>
            <div class="kit-social">
                <span>Follow Nora:</span>
                @include('layouts.website.partials.social-icons')
            </div>
        </div>
    </section>
    <section class="sec-sm">
        <div class="c">
            <div class="kit-form-wrap gc rev" data-delay="100">
                @if(!empty($kit['embed_url']))
                    <iframe src="{{ $kit['embed_url'] }}" class="kit-iframe" title="{{ $kit['title'] ?? 'Signup form' }}" loading="lazy"></iframe>
                @elseif(!empty($kit['redirect_url']))
                    <div class="kit-fallback">
                        <p>You'll be redirected to the signup form. If nothing happens, click below:</p>
                        <a href="{{ $kit['redirect_url'] }}" class="btn btn-p" target="_blank" rel="noopener">Continue to Signup →</a>
                    </div>
                @else
                    <div class="kit-fallback">
                        <p>Signup form embed URL not configured yet. Add your Kit form URL in <code>.env</code> (see HANDOFF.md).</p>
                        <p style="margin-top:16px">Kit page: <strong>/{{ $page === 'arcreaders' ? 'ARCreaders' : $page }}</strong></p>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
@if(empty($kit['embed_url']) && !empty($kit['redirect_url']))
<script>setTimeout(function(){ window.location.href = @json($kit['redirect_url']); }, 800);</script>
@endif
<script>document.addEventListener('DOMContentLoaded', initHeroCanvas);</script>
@endpush
