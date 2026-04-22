@extends('master')
@section('title', 'About â€” ZXNTO')

@section('head')
<style>
    /* â”€â”€ HERO â”€â”€ */
    .about-hero {
        min-height: 80vh; display: flex; align-items: flex-end;
        position: relative; overflow: hidden; padding: 80px 32px;
    }
    .about-hero-bg {
        position: absolute; inset: 0;
        background: url('https://images.unsplash.com/photo-1556906781-9a412961a28c?auto=format&fit=crop&w=1400&q=80') center/cover no-repeat;
        filter: brightness(.2) saturate(.4);
    }
    .about-hero-inner { max-width: 1320px; margin: 0 auto; width: 100%; position: relative; z-index: 1; }
    .eyebrow { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
    .eyebrow-line { width: 40px; height: 1px; background: var(--gold); }
    .eyebrow span { font-size: .72rem; font-weight: 700; letter-spacing: .2em; text-transform: uppercase; color: var(--gold); }
    .about-hero h1 {
        font-family: var(--font-head); font-size: clamp(3.5rem, 8vw, 8rem);
        font-weight: 800; text-transform: uppercase; letter-spacing: -.02em;
        line-height: .88; max-width: 900px;
    }
    .about-hero h1 span { color: var(--gold); }

    /* â”€â”€ SHARED â”€â”€ */
    .sec-label { font-size: .7rem; font-weight: 700; color: var(--gold); text-transform: uppercase; letter-spacing: .15em; margin-bottom: 10px; }
    .about-wrap { max-width: 1320px; margin: 0 auto; padding: 0 32px; }

    /* â”€â”€ MISSION â”€â”€ */
    .mission {
        display: grid; grid-template-columns: 1fr 1fr;
        border-bottom: 1px solid var(--border);
    }
    .mission-img { overflow: hidden; aspect-ratio: 4/3; }
    .mission-img img { width: 100%; height: 100%; object-fit: cover; filter: grayscale(25%); transition: filter .5s; }
    .mission-img:hover img { filter: grayscale(0%); }
    .mission-text {
        padding: 72px 56px; display: flex; flex-direction: column; justify-content: center;
        border-left: 1px solid var(--border);
    }
    .mission-text h2 { font-family: var(--font-head); font-size: 2.4rem; font-weight: 800; text-transform: uppercase; letter-spacing: -.01em; line-height: 1.05; margin-bottom: 20px; }
    .mission-text p { color: var(--muted); font-size: .92rem; line-height: 1.85; margin-bottom: 14px; }
    .gold-link { display: inline-flex; align-items: center; gap: 8px; font-size: .8rem; font-weight: 700; color: var(--gold); text-transform: uppercase; letter-spacing: .08em; margin-top: 12px; transition: gap .2s; }
    .gold-link:hover { gap: 14px; }

    /* â”€â”€ STATS â”€â”€ */
    .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); border-bottom: 1px solid var(--border); }
    .stat-cell { padding: 52px 32px; border-right: 1px solid var(--border); text-align: center; }
    .stat-cell:last-child { border-right: none; }
    .stat-num { font-family: var(--font-head); font-size: 3.2rem; font-weight: 800; color: var(--gold); line-height: 1; }
    .stat-lbl { font-size: .72rem; color: var(--muted); text-transform: uppercase; letter-spacing: .1em; margin-top: 8px; }

    /* â”€â”€ VALUES â”€â”€ */
    .values-sec { padding: 96px 0; border-bottom: 1px solid var(--border); }
    .values-head { margin-bottom: 56px; }
    .values-head h2 { font-family: var(--font-head); font-size: 2.2rem; font-weight: 800; text-transform: uppercase; }
    .values-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: var(--border); }
    .value-card { background: var(--bg); padding: 40px 36px; transition: background .2s; }
    .value-card:hover { background: var(--bg2); }
    .value-num { font-family: var(--font-head); font-size: 3rem; font-weight: 800; color: var(--border2); line-height: 1; margin-bottom: 20px; }
    .value-title { font-family: var(--font-head); font-size: 1.1rem; font-weight: 700; text-transform: uppercase; margin-bottom: 12px; }
    .value-desc { font-size: .875rem; color: var(--muted); line-height: 1.8; }

    /* â”€â”€ TIMELINE â”€â”€ */
    .timeline-sec { padding: 96px 0; border-bottom: 1px solid var(--border); }
    .timeline-head { margin-bottom: 56px; }
    .timeline-head h2 { font-family: var(--font-head); font-size: 2.2rem; font-weight: 800; text-transform: uppercase; }
    .timeline { display: flex; flex-direction: column; gap: 0; }
    .tl-item {
        display: grid; grid-template-columns: 120px 1px 1fr;
        gap: 0 32px; align-items: start; padding: 32px 0;
        border-bottom: 1px solid var(--border);
    }
    .tl-item:last-child { border-bottom: none; }
    .tl-year { font-family: var(--font-head); font-size: 1.4rem; font-weight: 800; color: var(--gold); padding-top: 4px; }
    .tl-line { background: var(--border); width: 1px; align-self: stretch; }
    .tl-content { padding-left: 32px; }
    .tl-title { font-family: var(--font-head); font-size: 1rem; font-weight: 700; text-transform: uppercase; margin-bottom: 8px; }
    .tl-desc { font-size: .875rem; color: var(--muted); line-height: 1.8; }

    /* â”€â”€ TEAM â”€â”€ */
    .team-sec { padding: 96px 0; }
    .team-head { margin-bottom: 56px; padding-bottom: 24px; border-bottom: 1px solid var(--border); display: flex; align-items: flex-end; justify-content: space-between; }
    .team-head h2 { font-family: var(--font-head); font-size: 2.2rem; font-weight: 800; text-transform: uppercase; }
    .team-grid { display: grid; grid-template-columns: 360px; gap: 1px; background: var(--border); }
    .team-card { background: var(--bg); overflow: hidden; transition: background .2s; }
    .team-card:hover { background: var(--bg2); }
    .team-img { aspect-ratio: 3/4; overflow: hidden; }
    .team-img img { width: 100%; height: 100%; object-fit: cover; filter: grayscale(40%); transition: all .5s; }
    .team-card:hover .team-img img { filter: grayscale(0%); transform: scale(1.04); }
    .team-info { padding: 22px 24px; border-top: 1px solid var(--border); }
    .team-name { font-family: var(--font-head); font-size: 1rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; margin-bottom: 4px; }
    .team-role { font-size: .75rem; color: var(--gold); text-transform: uppercase; letter-spacing: .1em; }

    /* â”€â”€ CTA â”€â”€ */
    .about-cta {
        position: relative; overflow: hidden;
        min-height: 360px; display: flex; align-items: center;
        border-top: 1px solid var(--border);
    }
    .about-cta-bg {
        position: absolute; inset: 0;
        background: url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1400&q=80') center/cover no-repeat;
        filter: brightness(.15) saturate(.4);
    }
    .about-cta-inner {
        position: relative; z-index: 1;
        max-width: 1320px; margin: 0 auto; padding: 80px 32px;
        display: flex; align-items: center; justify-content: space-between; gap: 40px; flex-wrap: wrap;
    }
    .about-cta h2 { font-family: var(--font-head); font-size: clamp(1.8rem, 3.5vw, 3rem); font-weight: 800; text-transform: uppercase; line-height: 1.05; }
    .about-cta h2 span { color: var(--gold); }

    /* â”€â”€ RESPONSIVE â”€â”€ */
    @media (max-width: 900px) {
        .mission { grid-template-columns: 1fr; }
        .mission-text { border-left: none; border-top: 1px solid var(--border); padding: 40px 32px; }
        .stats-row { grid-template-columns: repeat(2, 1fr); }
        .stat-cell:nth-child(2) { border-right: none; }
        .values-grid { grid-template-columns: 1fr; }
        .team-grid { grid-template-columns: repeat(2, 1fr); }
        .about-cta-inner { flex-direction: column; align-items: flex-start; }
    }
    @media (max-width: 540px) {
        .stats-row { grid-template-columns: 1fr 1fr; }
        .team-grid { grid-template-columns: 1fr; }
        .about-wrap { padding: 0 20px; }
        .tl-item { grid-template-columns: 80px 1px 1fr; }
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<div class="about-hero">
    <div class="about-hero-bg"></div>
    <div class="about-hero-inner">
        <div class="eyebrow">
            <div class="eyebrow-line"></div>
            <span>Our Story</span>
        </div>
        <h1>Built for<br>Those Who<br><span>Move.</span></h1>
    </div>
</div>

<div class="about-wrap">

    {{-- MISSION --}}
    <div class="mission">
        <div class="mission-img">
            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80" alt="Our Store">
        </div>
        <div class="mission-text">
            <div class="sec-label">Who We Are</div>
            <h2>Cambodia's Premier Shoe Destination</h2>
            <p>Founded in 2014, ZXNTO started as a single storefront on Mao Tse Tung Boulevard with one mission â€” bring world-class footwear to Cambodian customers at honest prices.</p>
            <p>Today we carry 500+ styles from 15+ global brands, all 100% authentic and sourced directly from official distributors. Every pair is hand-selected for quality, style, and longevity.</p>
            <a href="/product" class="gold-link">Shop the Collection <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>

    {{-- STATS --}}
    <div class="stats-row">
        <div class="stat-cell"><div class="stat-num">10+</div><div class="stat-lbl">Years in Business</div></div>
        <div class="stat-cell"><div class="stat-num">500+</div><div class="stat-lbl">Products</div></div>
        <div class="stat-cell"><div class="stat-num">10K+</div><div class="stat-lbl">Happy Customers</div></div>
        <div class="stat-cell"><div class="stat-num">15+</div><div class="stat-lbl">Global Brands</div></div>
    </div>

    {{-- VALUES --}}
    <div class="values-sec">
        <div class="values-head">
            <div class="sec-label">What We Stand For</div>
            <h2>Our Values</h2>
        </div>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-num">01</div>
                <div class="value-title">Authenticity</div>
                <div class="value-desc">Every product we sell is 100% genuine, sourced directly from brand-authorized distributors. No fakes, no compromises â€” ever.</div>
            </div>
            <div class="value-card">
                <div class="value-num">02</div>
                <div class="value-title">Quality First</div>
                <div class="value-desc">We hand-select every style in our catalog. If it doesn't meet our standard for craftsmanship and durability, it doesn't make the cut.</div>
            </div>
            <div class="value-card">
                <div class="value-num">03</div>
                <div class="value-title">Community</div>
                <div class="value-desc">ZXNTO was built in Cambodia, for Cambodia. We reinvest in local communities and support the culture that inspires everything we do.</div>
            </div>
        </div>
    </div>

    {{-- TIMELINE --}}
    <div class="timeline-sec">
        <div class="timeline-head">
            <div class="sec-label">How We Got Here</div>
            <h2>Our Journey</h2>
        </div>
        <div class="timeline">
            <div class="tl-item">
                <div class="tl-year">2014</div>
                <div class="tl-line"></div>
                <div class="tl-content">
                    <div class="tl-title">The First Step</div>
                    <div class="tl-desc">Opened our first store on Mao Tse Tung Boulevard, Phnom Penh, with a small selection of Nike and Adidas styles.</div>
                </div>
            </div>
            <div class="tl-item">
                <div class="tl-year">2017</div>
                <div class="tl-line"></div>
                <div class="tl-content">
                    <div class="tl-title">Expanding the Range</div>
                    <div class="tl-desc">Added Puma, New Balance, and Converse to our lineup. Moved to a larger flagship location and doubled our team.</div>
                </div>
            </div>
            <div class="tl-item">
                <div class="tl-year">2020</div>
                <div class="tl-line"></div>
                <div class="tl-content">
                    <div class="tl-title">Going Digital</div>
                    <div class="tl-desc">Launched our online store, bringing ZXNTO to customers across all provinces of Cambodia for the first time.</div>
                </div>
            </div>
            <div class="tl-item">
                <div class="tl-year">2024</div>
                <div class="tl-line"></div>
                <div class="tl-content">
                    <div class="tl-title">10 Years Strong</div>
                    <div class="tl-desc">Celebrated a decade in business with 10,000+ loyal customers, 500+ products, and partnerships with 15+ global brands.</div>
                </div>
            </div>
            <div class="tl-item">
                <div class="tl-year">2026</div>
                <div class="tl-line"></div>
                <div class="tl-content">
                    <div class="tl-title">The Next Chapter</div>
                    <div class="tl-desc">Launching new exclusive collections and expanding to serve more communities across Southeast Asia.</div>
                </div>
            </div>
        </div>
    </div>

    {{-- TEAM --}}
    <div class="team-sec">
        <div class="team-head">
            <div>
                <div class="sec-label">The People</div>
                <h2>Meet the Team</h2>
            </div>
        </div>
        <div class="team-grid" style="grid-template-columns: repeat(3,1fr)">
            <div class="team-card">
                <div class="team-img">
                    <img src="{{ asset('photo/ceo.jpg') }}"
                         onerror="this.src='https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80'"
                         alt="Chan Kimkheang">
                </div>
                <div class="team-info">
                    <div class="team-name">Chan Kimkheang</div>
                    <div class="team-role">Founder & CEO</div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- CTA --}}
<div class="about-cta">
    <div class="about-cta-bg"></div>
    <div class="about-cta-inner">
        <h2>Ready to Find Your<br><span>Perfect Pair?</span></h2>
        <a href="/product" class="btn btn-gold btn-lg"><i class="fas fa-arrow-right"></i> Shop the Collection</a>
    </div>
</div>

@endsection

