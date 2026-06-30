<footer>
    <div class="c">
        <div class="fg2">
            <div>
                <a href="{{ route('index') }}" class="logo" style="margin-bottom:0">
                    @include('layouts.website.partials.logo-mark')
                </a>
                <p class="fbrt">{{ $site['footer']['about_text'] ?? $site['description'] ?? '' }}</p>
                <div style="display:flex;gap:10px;margin-top:16px">
                    @include('layouts.website.partials.social-icons')
                </div>
            </div>
            <div>
                <div class="fhl">Navigate</div>
                <ul class="fls">
                    @foreach ($site['pages'] ?? [] as $page)
                        <li><a href="{{ route($page['route']) }}">{{ $page['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <div class="fhl">Get in Touch</div>
                @if (!empty($site['contact']['email']))
                    <a class="fci" href="mailto:{{ $site['contact']['email'] }}">
                        <div class="fcic">✉️</div>{{ $site['contact']['email'] }}
                    </a>
                @endif
                @if (!empty($site['contact']['phone']))
                    <a class="fci" href="tel:{{ $site['contact']['phone_href'] ?? preg_replace('/\D/', '', $site['contact']['phone']) }}">
                        <div class="fcic">📞</div>{{ $site['contact']['phone'] }}
                    </a>
                @endif
                @if (!empty($site['contact']['response_note']))
                    <div style="background:rgba(59,130,246,.05);border:1px solid rgba(59,130,246,.15);border-radius:12px;padding:10px 14px;font-family:var(--ff-mono);font-size:.72rem;color:var(--primary);margin-top:8px">
                        ⚡ {{ $site['contact']['response_note'] }}
                    </div>
                @endif
            </div>
        </div>
        <div class="fbot">
            <span class="fcp">
                @if (!empty($site['footer']['copyright']))
                    {{ $site['footer']['copyright'] }}
                @else
                    &copy; {{ date('Y') }} {{ $site['name'] ?? 'Website' }}. All rights reserved.
                @endif
            </span>
            @if (!empty($site['agency']['enabled']))
                <span class="fcp">
                    Made by
                    <a href="{{ $site['agency']['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" style="color:var(--primary)">
                        {{ $site['agency']['name'] ?? 'Agency' }}
                    </a>
                </span>
            @endif
        </div>
    </div>
</footer>
