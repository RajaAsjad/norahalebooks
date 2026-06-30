@extends('layouts.website.master')

@section('title', $page_title)
@section('meta_description', 'Contact ' . ($site['name'] ?? 'us'))

@section('content')
<div class="page">
    <section style="padding:80px 0 48px;text-align:center;position:relative;overflow:hidden" class="mesh">
        <div class="c" style="position:relative;z-index:1">
            <span class="badge be" style="margin-bottom:16px">Get in Touch</span>
            <h1 style="font-family:var(--ff-display);font-weight:700;font-size:clamp(2.5rem,6vw,4rem);line-height:1.1;color:var(--text);margin-bottom:12px">
                Contact <span class="gt">{{ $site['name'] ?? 'Us' }}</span>
            </h1>
            <p style="color:var(--muted);max-width:480px;margin:0 auto">
                Send us a message and we'll get back to you as soon as possible.
            </p>
        </div>
    </section>

    <div class="sec-sm">
        <div class="c">
            <div class="ctcg">
                <div class="ctcfc gc gb">
                    @if(session('status'))
                        <div class="alert-success" style="background:rgba(45,106,79,.1);border:1px solid rgba(45,106,79,.25);border-radius:12px;padding:14px 18px;margin-bottom:20px;color:var(--primary)">{{ session('status') }}</div>
                    @endif
                    <div id="fv">
                        <div class="ctcft">Send a Message</div>
                        <form id="cf" action="{{ url('contactus') }}" method="POST" onsubmit="return sbf(event)" novalidate>
                            @csrf
                            <div class="frow">
                                <div class="fg" style="margin-bottom:0">
                                    <label class="fl" for="fn">Full Name</label>
                                    <input class="fi2" id="fn" name="full_name" type="text" placeholder="Your full name" autocomplete="name" required>
                                    <div class="ferr" id="fne">Your name is required.</div>
                                </div>
                                <div class="fg" style="margin-bottom:0">
                                    <label class="fl" for="fe">Email Address</label>
                                    <input class="fi2" id="fe" name="email" type="email" placeholder="you@example.com" autocomplete="email" required>
                                    <div class="ferr" id="fee">Valid email required.</div>
                                </div>
                            </div>
                            <div class="fg" style="margin-top:20px">
                                <label class="fl" for="fp">Phone (optional)</label>
                                <input class="fi2" id="fp" name="phone" type="tel" placeholder="Your phone number" autocomplete="tel">
                            </div>
                            <div class="fg">
                                <label class="fl" for="fm">Message</label>
                                <textarea class="fta" id="fm" name="message" rows="5" placeholder="How can we help you?" required></textarea>
                                <div class="ferr" id="fme">Message is required.</div>
                            </div>
                            <button type="submit" class="btn btn-p" id="fsb" style="margin-top:24px;width:100%;justify-content:center">
                                ✉ Send Message
                            </button>
                        </form>
                    </div>
                    <div id="sv" style="display:none;text-align:center;padding:40px 20px">
                        <div style="font-size:3rem;margin-bottom:16px">✅</div>
                        <h3 style="font-family:var(--ff-head);margin-bottom:8px">Message Sent!</h3>
                        <p style="color:var(--muted);margin-bottom:24px">Thank you for reaching out. We'll be in touch soon.</p>
                        <button type="button" class="btn btn-s" onclick="rsf()">Send Another</button>
                    </div>
                </div>
                <div class="ctci">
                    @if (!empty($site['contact']['email']))
                        <div class="ctcic gc rev">
                            <div class="ctcii">✉️</div>
                            <div class="ctcit">Email</div>
                            <a href="mailto:{{ $site['contact']['email'] }}" style="color:var(--primary)">{{ $site['contact']['email'] }}</a>
                        </div>
                    @endif
                    @if (!empty($site['contact']['phone']))
                        <div class="ctcic gc rev" data-delay="100">
                            <div class="ctcii">📞</div>
                            <div class="ctcit">Phone</div>
                            <a href="tel:{{ $site['contact']['phone_href'] ?? preg_replace('/\D/', '', $site['contact']['phone']) }}" style="color:var(--primary)">{{ $site['contact']['phone'] }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
