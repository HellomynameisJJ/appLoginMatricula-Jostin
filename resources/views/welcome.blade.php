<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap" rel="stylesheet">
    <style>
    /* ══════════════════════════════════════════
       NEXUS ACADEMIA — PREMIUM LANDING
       Mantiene todas las clases de app.css
    ══════════════════════════════════════════ */

    /* ── CURSOR PERSONALIZADO ── */
    * { cursor: none !important; }
    #cursor {
        width: 10px; height: 10px;
        background: var(--accent);
        border-radius: 50%;
        position: fixed; pointer-events: none;
        z-index: 9999; transform: translate(-50%,-50%);
        transition: transform .08s ease, width .2s ease, height .2s ease, opacity .2s;
    }
    #cursor-ring {
        width: 36px; height: 36px;
        border: 1px solid rgba(167,139,250,.5);
        border-radius: 50%;
        position: fixed; pointer-events: none;
        z-index: 9998; transform: translate(-50%,-50%);
        transition: left .12s ease, top .12s ease, transform .2s ease, width .2s ease, height .2s ease;
    }
    #cursor.grow { width: 16px; height: 16px; }
    #cursor-ring.grow { width: 56px; height: 56px; border-color: rgba(167,139,250,.3); }

    /* ── NOISE OVERLAY ── */
    body::after {
        content: '';
        position: fixed; inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='1'/%3E%3C/svg%3E");
        opacity: .025; pointer-events: none; z-index: 1000;
    }

    /* ── GLOW BLOB ── */
    .blob {
        position: absolute; border-radius: 50%;
        filter: blur(120px); pointer-events: none;
        animation: blobDrift 18s ease-in-out infinite;
    }
    @keyframes blobDrift {
        0%,100% { transform: translate(0,0) scale(1); }
        33%      { transform: translate(40px,-30px) scale(1.08); }
        66%      { transform: translate(-30px,20px) scale(.94); }
    }

    /* ── HERO PREMIUM ── */
    .hero-premium {
        min-height: 100vh;
        display: grid; grid-template-columns: 1fr 1fr;
        align-items: center;
        padding: 7rem 2.5rem 3rem;
        max-width: 1300px; margin: 0 auto;
        position: relative; z-index: 1;
        gap: 3rem;
    }
    .hero-eyebrow {
        display: inline-flex; align-items: center; gap: .6rem;
        padding: .38rem 1rem; border-radius: 100px;
        border: 1px solid rgba(167,139,250,.22);
        background: rgba(167,139,250,.05);
        font-size: .72rem; color: var(--accent);
        letter-spacing: .08em; text-transform: uppercase; font-weight: 600;
        margin-bottom: 2rem;
        animation: fadeUp .5s ease both;
    }
    .eyebrow-dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: #4ade80; box-shadow: 0 0 8px #4ade80;
        animation: pulse-green 2s ease infinite;
    }
    @keyframes pulse-green { 0%,100%{box-shadow:0 0 8px #4ade80} 50%{box-shadow:0 0 16px #4ade80, 0 0 32px rgba(74,222,128,.3)} }

    .hero-display {
        font-family: 'Playfair Display', serif;
        font-size: clamp(3rem, 5.5vw, 5.2rem);
        font-weight: 800; line-height: .97;
        letter-spacing: -.02em; margin-bottom: 1.6rem;
        animation: fadeUp .6s .1s ease both;
    }
    .hero-display em {
        font-style: italic; color: var(--accent);
        display: block;
    }
    .hero-lead {
        font-size: .97rem; line-height: 1.9; color: var(--muted);
        max-width: 460px; margin-bottom: 2.5rem;
        animation: fadeUp .6s .2s ease both;
    }
    .hero-actions { display: flex; gap: .8rem; flex-wrap: wrap; animation: fadeUp .6s .3s ease both; }

    /* Pill stats bajo los botones */
    .hero-pills {
        display: flex; gap: 1.2rem; flex-wrap: wrap;
        margin-top: 2rem; animation: fadeUp .6s .4s ease both;
    }
    .hero-pill {
        display: flex; align-items: center; gap: .55rem;
        font-size: .78rem; color: var(--muted);
    }
    .hero-pill strong { color: var(--text); font-weight: 600; }
    .pill-sep { width: 1px; height: 18px; background: var(--border); }

    /* ── HERO VISUAL DERECHA ── */
    .hero-visual { position: relative; height: 520px; }

    /* Imagen principal */
    .hero-img-main {
        position: absolute; right: 0; top: 50%; transform: translateY(-50%);
        width: 88%; height: 420px; border-radius: 28px; overflow: hidden;
        border: 1px solid rgba(255,255,255,.07);
        box-shadow: 0 40px 100px rgba(0,0,0,.6), 0 0 0 1px rgba(167,139,250,.06);
    }
    .hero-img-main img {
        width: 100%; height: 100%; object-fit: cover;
        filter: brightness(.85) saturate(1.1);
        transition: transform .8s ease;
    }
    .hero-img-main:hover img { transform: scale(1.04); }
    .hero-img-main::after {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(167,139,250,.15) 0%, transparent 60%),
                    linear-gradient(to top, rgba(6,6,8,.7) 0%, transparent 50%);
    }

    /* Imagen flotante pequeña */
    .hero-img-float {
        position: absolute; left: -10px; bottom: 30px;
        width: 180px; height: 140px; border-radius: 20px; overflow: hidden;
        border: 1px solid rgba(255,255,255,.1);
        box-shadow: 0 20px 60px rgba(0,0,0,.5);
        animation: floatChip 7s ease-in-out infinite;
        z-index: 2;
    }
    .hero-img-float img { width: 100%; height: 100%; object-fit: cover; filter: brightness(.8) saturate(1.2); }

    /* Chips sobre la imagen */
    .v-chip {
        position: absolute; z-index: 3;
        background: rgba(13,13,17,.92); backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 14px; padding: .65rem 1rem;
    }
    .v-chip-label { font-size: .62rem; color: var(--muted); text-transform: uppercase; letter-spacing: .07em; margin-bottom: .22rem; }
    .v-chip-val   { font-size: .92rem; font-weight: 700; color: var(--text); }
    .v-chip-val span { color: var(--accent); }
    .v-chip.vc1 { top: 18px; left: 0; animation: floatChip 5s ease-in-out infinite; }
    .v-chip.vc2 { top: 50%; right: -14px; transform: translateY(-50%); animation: floatChip 6s ease-in-out infinite 1.5s; }

    /* ── MARQUEE LOGOS / TRUST ── */
    .trust-bar {
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        padding: 1.4rem 0;
        overflow: hidden; position: relative; z-index: 1;
        background: rgba(13,13,17,.7);
    }
    .trust-track {
        display: flex; gap: 3.5rem; align-items: center;
        animation: marquee 22s linear infinite;
        white-space: nowrap;
    }
    .trust-item {
        font-size: .78rem; font-weight: 600; color: var(--muted);
        letter-spacing: .08em; text-transform: uppercase; flex-shrink: 0;
        display: flex; align-items: center; gap: .6rem;
    }
    .trust-item::before { content: '✦'; color: var(--accent); font-size: .7rem; }
    @keyframes marquee { from{transform:translateX(0)} to{transform:translateX(-50%)} }

    /* ── SECTION BASE ── */
    .lp { position: relative; z-index: 1; }
    .lp-inner {
        max-width: 1300px; margin: 0 auto;
        padding: 7rem 2.5rem;
    }
    .lp-dark {
        background: var(--sf);
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
    }
    .sec-sup {
        font-size: .68rem; letter-spacing: .16em; text-transform: uppercase;
        color: var(--accent); font-weight: 700; margin-bottom: .8rem;
    }
    .sec-h {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 3.5vw, 3.2rem);
        font-weight: 800; line-height: 1.05;
        letter-spacing: -.02em; margin-bottom: 1rem;
    }
    .sec-h em { font-style: italic; color: var(--accent); }
    .sec-p { font-size: .93rem; line-height: 1.9; color: var(--muted); max-width: 520px; }
    .sec-header { margin-bottom: 4rem; }

    /* ── MODALIDADES ── */
    .modal-trio {
        display: grid; grid-template-columns: repeat(3,1fr);
        gap: 1.5rem;
    }
    .mcard {
        border-radius: 24px; overflow: hidden;
        border: 1px solid var(--border);
        transition: transform .3s ease, border-color .3s ease, box-shadow .3s ease;
        position: relative;
    }
    .mcard:hover {
        transform: translateY(-6px);
        border-color: rgba(167,139,250,.3);
        box-shadow: 0 30px 80px rgba(0,0,0,.4), 0 0 0 1px rgba(167,139,250,.08);
    }
    .mcard-img {
        width: 100%; height: 220px; overflow: hidden; position: relative;
    }
    .mcard-img img {
        width: 100%; height: 100%; object-fit: cover;
        filter: brightness(.75) saturate(1.1);
        transition: transform .5s ease;
    }
    .mcard:hover .mcard-img img { transform: scale(1.07); }
    .mcard-img::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(to bottom, transparent 40%, rgba(6,6,8,.9));
    }
    .mcard-img-label {
        position: absolute; bottom: 1rem; left: 1.2rem; z-index: 1;
        font-size: .68rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        padding: .3rem .8rem; border-radius: 100px;
    }
    .mcard-body { background: var(--sf2); padding: 1.6rem; }
    .mcard-body h3 { font-size: 1.05rem; font-weight: 700; margin-bottom: .5rem; }
    .mcard-body p  { font-size: .84rem; color: var(--muted); line-height: 1.7; }

    /* ── CARRERAS — LAYOUT EDITORIAL ── */
    .carrera-editorial {
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    .ccard {
        background: var(--sf2); border: 1px solid var(--border);
        border-radius: 24px; overflow: hidden;
        display: flex; gap: 0;
        transition: border-color .3s, transform .3s;
        position: relative;
    }
    .ccard:hover { border-color: rgba(167,139,250,.28); transform: translateY(-4px); }
    .ccard-accent {
        width: 4px; flex-shrink: 0;
        background: var(--accent);
        transition: width .3s;
    }
    .ccard:hover .ccard-accent { width: 5px; }
    .ccard-body { padding: 1.8rem; flex: 1; }
    .ccard-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.1rem; }
    .ccard-ico {
        width: 44px; height: 44px; border-radius: 12px; font-size: 1.25rem;
        background: rgba(167,139,250,.07); border: 1px solid rgba(167,139,250,.14);
        display: flex; align-items: center; justify-content: center;
    }
    .ccard-dur {
        font-size: .68rem; color: var(--muted);
        border: 1px solid var(--border); padding: .2rem .65rem; border-radius: 100px;
    }
    .ccard h3 { font-size: 1rem; font-weight: 700; margin-bottom: .45rem; }
    .ccard p  { font-size: .83rem; color: var(--muted); line-height: 1.65; }
    .ccard-tags { display: flex; flex-wrap: wrap; gap: .4rem; margin-top: 1rem; }
    .ctag {
        font-size: .69rem; padding: .2rem .6rem; border-radius: 100px;
        background: rgba(167,139,250,.07); color: var(--accent);
        border: 1px solid rgba(167,139,250,.14);
    }
    /* card destacada (full width) */
    .ccard.featured {
        grid-column: 1 / -1;
        flex-direction: row;
    }
    .ccard.featured .ccard-body { display: flex; gap: 3rem; align-items: center; }
    .ccard.featured .ccard-info { flex: 1; }
    .ccard.featured .ccard-img-side {
        width: 280px; height: 180px; border-radius: 16px; overflow: hidden; flex-shrink: 0;
    }
    .ccard.featured .ccard-img-side img {
        width: 100%; height: 100%; object-fit: cover;
        filter: brightness(.8) saturate(1.1);
    }

    /* ── POR QUÉ — BENTO GRID ── */
    .bento {
        display: grid;
        grid-template-columns: 1.4fr 1fr 1fr;
        grid-template-rows: auto auto;
        gap: 1.4rem;
    }
    .bento-card {
        background: var(--sf2); border: 1px solid var(--border);
        border-radius: 24px; padding: 2rem;
        transition: border-color .3s, transform .3s;
        position: relative; overflow: hidden;
    }
    .bento-card:hover { border-color: var(--bh); transform: translateY(-3px); }
    .bento-card.tall { grid-row: span 2; display: flex; flex-direction: column; }
    .bento-card.tall .bcard-img {
        flex: 1; border-radius: 16px; overflow: hidden; margin-top: 1.5rem; min-height: 200px;
    }
    .bento-card.tall .bcard-img img { width: 100%; height: 100%; object-fit: cover; filter: brightness(.7); }
    .bento-ico {
        font-size: 2rem; margin-bottom: 1.2rem;
        width: 56px; height: 56px; border-radius: 16px;
        background: rgba(167,139,250,.06); border: 1px solid rgba(167,139,250,.12);
        display: flex; align-items: center; justify-content: center;
    }
    .bento-card h3 { font-size: 1rem; font-weight: 700; margin-bottom: .45rem; letter-spacing: -.01em; }
    .bento-card p  { font-size: .84rem; color: var(--muted); line-height: 1.7; }
    .bento-num {
        font-family: 'Playfair Display', serif;
        font-size: 3.2rem; font-weight: 800; color: var(--accent);
        line-height: 1; margin-bottom: .3rem; letter-spacing: -.04em;
    }

    /* ── PROCESO ── */
    .proceso-track {
        display: grid; grid-template-columns: repeat(4,1fr);
        gap: 0; margin-top: 4rem; position: relative;
    }
    .proceso-track::before {
        content: '';
        position: absolute; top: 28px; left: 5%; right: 5%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), var(--accent), transparent);
        opacity: .25;
    }
    .pstep { padding: 0 1rem; text-align: center; }
    .pstep-num {
        width: 56px; height: 56px; border-radius: 50%;
        background: var(--sf2); border: 1px solid rgba(167,139,250,.25);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700;
        color: var(--accent); margin: 0 auto 1.5rem;
        position: relative; z-index: 1;
        transition: background .3s, border-color .3s, box-shadow .3s;
    }
    .pstep:hover .pstep-num {
        background: rgba(167,139,250,.1);
        border-color: var(--accent);
        box-shadow: 0 0 30px rgba(167,139,250,.2);
    }
    .pstep h4 { font-size: .95rem; font-weight: 700; margin-bottom: .5rem; }
    .pstep p  { font-size: .82rem; color: var(--muted); line-height: 1.65; }

    /* ── TESTIMONIOS ── */
    .testi-grid {
        display: grid; grid-template-columns: repeat(3,1fr);
        gap: 1.4rem; margin-top: 1rem;
    }
    .tcard {
        background: var(--sf2); border: 1px solid var(--border);
        border-radius: 20px; padding: 1.8rem;
        transition: border-color .3s;
    }
    .tcard:hover { border-color: var(--bh); }
    .tcard-stars { color: #facc15; font-size: .9rem; margin-bottom: 1rem; letter-spacing: 2px; }
    .tcard-quote { font-size: .88rem; color: var(--muted); line-height: 1.8; margin-bottom: 1.5rem; font-style: italic; }
    .tcard-author { display: flex; align-items: center; gap: .8rem; }
    .tcard-avatar {
        width: 38px; height: 38px; border-radius: 50%; overflow: hidden;
        border: 1px solid rgba(167,139,250,.2);
        background: rgba(167,139,250,.08);
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: .85rem; color: var(--accent);
    }
    .tcard-name { font-size: .85rem; font-weight: 600; }
    .tcard-role { font-size: .74rem; color: var(--muted); }

    /* ── CTA BANNER ── */
    .cta-banner {
        position: relative; overflow: hidden;
        border-top: 1px solid var(--border);
        background: var(--sf);
    }
    .cta-banner-inner {
        max-width: 1300px; margin: 0 auto;
        padding: 7rem 2.5rem;
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 4rem; align-items: center;
    }
    .cta-img {
        border-radius: 24px; overflow: hidden; height: 360px;
        border: 1px solid rgba(255,255,255,.07);
        box-shadow: 0 40px 100px rgba(0,0,0,.5);
    }
    .cta-img img { width: 100%; height: 100%; object-fit: cover; filter: brightness(.8) saturate(1.1); }
    .cta-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem,3vw,2.8rem);
        font-weight: 800; margin-bottom: 1rem; line-height: 1.1;
    }
    .cta-content h2 em { font-style: italic; color: var(--accent); }
    .cta-content p { font-size: .93rem; color: var(--muted); line-height: 1.9; margin-bottom: 2rem; }
    .cta-btns { display: flex; gap: .8rem; flex-wrap: wrap; }

    /* ── FOOTER PREMIUM ── */
    .lp-footer {
        border-top: 1px solid var(--border);
        background: var(--sf2);
        padding: 4rem 2.5rem 2rem;
        position: relative; z-index: 1;
    }
    .lp-footer-grid {
        max-width: 1300px; margin: 0 auto;
        display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr;
        gap: 3rem; margin-bottom: 3rem;
    }
    .footer-brand p { font-size: .85rem; color: var(--muted); line-height: 1.8; margin-top: .8rem; max-width: 240px; }
    .footer-col h5 { font-size: .72rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--muted); margin-bottom: 1rem; }
    .footer-col a {
        display: block; color: var(--muted); text-decoration: none;
        font-size: .85rem; margin-bottom: .55rem; transition: color .2s;
    }
    .footer-col a:hover { color: var(--text); }
    .footer-bottom {
        max-width: 1300px; margin: 0 auto;
        padding-top: 1.5rem; border-top: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    .footer-bottom p { font-size: .78rem; color: var(--muted); }

    /* ── SCROLL REVEAL (usa la clase observe de app.css) ── */
    /* .observe y .observe.visible ya están en app.css */

    /* ── RESPONSIVE ── */
    @media(max-width:1024px){
        .hero-premium { grid-template-columns: 1fr; padding-top: 8rem; }
        .hero-visual  { height: 320px; }
        .modal-trio, .testi-grid { grid-template-columns: 1fr; }
        .carrera-editorial { grid-template-columns: 1fr; }
        .ccard.featured .ccard-body { flex-direction: column; }
        .ccard.featured .ccard-img-side { width: 100%; }
        .bento { grid-template-columns: 1fr 1fr; }
        .bento-card.tall { grid-row: auto; }
        .proceso-track { grid-template-columns: repeat(2,1fr); gap: 2rem; }
        .proceso-track::before { display: none; }
        .cta-banner-inner { grid-template-columns: 1fr; }
        .lp-footer-grid { grid-template-columns: 1fr 1fr; }
    }
    @media(max-width:640px){
        .bento { grid-template-columns: 1fr; }
        .proceso-track { grid-template-columns: 1fr; }
        .lp-footer-grid { grid-template-columns: 1fr; }
        #cursor, #cursor-ring { display: none; }
        * { cursor: auto !important; }
    }

    /* ── SCROLLBAR PREMIUM (GLOBAL) ── */
        /* Para navegadores WebKit (Chrome, Edge, Brave, Safari) */
        ::-webkit-scrollbar {
            width: 8px;  /* Grosor para scroll vertical */
            height: 8px; /* Grosor para scroll horizontal */
        }
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02); /* Fondo oscuro súper sutil */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(167, 139, 250, 0.25); /* Tu morado en versión translúcida */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(167, 139, 250, 0.5); /* Se ilumina cuando pasas el mouse */
        }

        /* Para Firefox (Usa una sintaxis distinta) */
        * {
            scrollbar-width: thin;
            scrollbar-color: rgba(167, 139, 250, 0.25) transparent;
        }
    </style>
</head>
<body>

{{-- CURSOR --}}
<div id="cursor"></div>
<div id="cursor-ring"></div>

{{-- ── NAV ── (clases originales de app.css) --}}
<nav class="n">
    <a href="/" class="n-brand">
        <div class="n-logo">✦</div>
        <span class="n-name">{{ config('app.name') }}</span>
    </a>
    <div style="display:flex;gap:2.2rem;align-items:center;">
        <a href="#modalidades" style="color:var(--muted);text-decoration:none;font-size:.85rem;transition:color .2s" onmouseover="this.style.color='var(--text)'" onmouseout="this.style.color='var(--muted)'">Modalidades</a>
        <a href="#carreras"    style="color:var(--muted);text-decoration:none;font-size:.85rem;transition:color .2s" onmouseover="this.style.color='var(--text)'" onmouseout="this.style.color='var(--muted)'">Carreras</a>
        <a href="#proceso"     style="color:var(--muted);text-decoration:none;font-size:.85rem;transition:color .2s" onmouseover="this.style.color='var(--text)'" onmouseout="this.style.color='var(--muted)'">Matrícula</a>
        <a href="#por-que"     style="color:var(--muted);text-decoration:none;font-size:.85rem;transition:color .2s" onmouseover="this.style.color='var(--text)'" onmouseout="this.style.color='var(--muted)'">¿Por qué?</a>
    </div>
    @if (Route::has('login'))
        <div class="n-actions">
            @auth
                <a href="{{ url('/home') }}" class="btn btn-line">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost">Iniciar sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-fill">Crear cuenta</a>
                @endif
            @endauth
        </div>
    @endif
</nav>

{{-- ── HERO ── --}}
<section style="position:relative;overflow:hidden;">
    <div class="blob" style="width:600px;height:600px;background:rgba(139,92,246,.07);top:-100px;right:-100px;"></div>
    <div class="blob" style="width:400px;height:400px;background:rgba(34,211,238,.04);bottom:0;left:100px;animation-delay:-8s;"></div>

    <div class="hero-premium">
        <div>
            <div class="hero-eyebrow">
                <span class="eyebrow-dot"></span>
                Plataforma activa — Ciclo 2025
            </div>
            <h1 class="hero-display">
                Evoluciona tu<br>
                <em>experiencia</em><br>
                académica.
            </h1>
            <p class="hero-lead">
                Una nueva generación de plataformas universitarias. Gestiona matrículas, visualiza cursos y controla tu progreso desde una interfaz moderna y precisa.
            </p>
            <div class="hero-actions">
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-fill btn-lg">Entrar al sistema →</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-fill btn-lg">Comenzar ahora →</a>
                    <a href="{{ route('login') }}" class="btn btn-line btn-lg">Ya tengo cuenta</a>
                @endauth
            </div>
            <div class="hero-pills">
                <div class="hero-pill"><strong>+2,400</strong> estudiantes</div>
                <div class="pill-sep"></div>
                <div class="hero-pill"><strong>5</strong> carreras</div>
                <div class="pill-sep"></div>
                <div class="hero-pill"><strong>92%</strong> empleabilidad</div>
                <div class="pill-sep"></div>
                <div class="hero-pill"><strong>3</strong> modalidades</div>
            </div>
        </div>

        <div class="hero-visual">
            <div class="v-chip vc1">
                <div class="v-chip-label">Estado</div>
                <div class="v-chip-val">Sistema <span>activo</span></div>
            </div>
            <div class="hero-img-main">
                <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=900&auto=format&fit=crop&q=80" alt="Estudiantes universitarios">
            </div>
            <div class="v-chip vc2">
                <div class="v-chip-label">Estudiantes</div>
                <div class="v-chip-val"><span>+2,400</span> activos</div>
            </div>
            <div class="hero-img-float">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&auto=format&fit=crop&q=80" alt="Trabajo en equipo">
            </div>
        </div>
    </div>
</section>

{{-- ── TRUST BAR ── --}}
<div class="trust-bar">
    <div class="trust-track">
        <span class="trust-item">Ingeniería de Software</span>
        <span class="trust-item">Ciencia de Datos</span>
        <span class="trust-item">Ciberseguridad</span>
        <span class="trust-item">Sistemas de Información</span>
        <span class="trust-item">Inteligencia Artificial</span>
        <span class="trust-item">Modalidad Presencial</span>
        <span class="trust-item">Semi-Presencial</span>
        <span class="trust-item">100% Virtual</span>
        <span class="trust-item">Matrícula Online</span>
        <span class="trust-item">Campus Digital</span>
        {{-- duplicado para loop infinito --}}
        <span class="trust-item">Ingeniería de Software</span>
        <span class="trust-item">Ciencia de Datos</span>
        <span class="trust-item">Ciberseguridad</span>
        <span class="trust-item">Sistemas de Información</span>
        <span class="trust-item">Inteligencia Artificial</span>
        <span class="trust-item">Modalidad Presencial</span>
        <span class="trust-item">Semi-Presencial</span>
        <span class="trust-item">100% Virtual</span>
        <span class="trust-item">Matrícula Online</span>
        <span class="trust-item">Campus Digital</span>
    </div>
</div>

{{-- ── MODALIDADES ── --}}
<div id="modalidades" class="lp">
    <div class="lp-inner">
        <div class="sec-header">
            <div class="sec-sup observe">Modalidades de estudio</div>
            <h2 class="sec-h observe">Tú decides <em>cómo aprender</em></h2>
            <p class="sec-p observe">Elige la modalidad que mejor se adapte a tu ritmo de vida, sin sacrificar la calidad académica que mereces.</p>
        </div>
        <div class="modal-trio">
            <div class="mcard observe">
                <div class="mcard-img">
                    <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=600&auto=format&fit=crop&q=80" alt="Presencial">
                    <div class="mcard-img-label" style="background:rgba(74,222,128,.15);color:#4ade80;border:1px solid rgba(74,222,128,.2);">Presencial</div>
                </div>
                <div class="mcard-body">
                    <h3>🎓 Clases Presenciales</h3>
                    <p>Campus equipado con laboratorios de última generación, biblioteca digital y espacios de colaboración diseñados para tu éxito.</p>
                </div>
            </div>
            <div class="mcard observe">
                <div class="mcard-img">
                    <img src="https://images.unsplash.com/photo-1588196749597-9ff075ee6b5b?w=600&auto=format&fit=crop&q=80" alt="Semi-presencial">
                    <div class="mcard-img-label" style="background:rgba(167,139,250,.15);color:#a78bfa;border:1px solid rgba(167,139,250,.2);">Semi-Presencial</div>
                </div>
                <div class="mcard-body">
                    <h3>🖥️ Formato Híbrido</h3>
                    <p>Lo mejor de ambos mundos. Clases virtuales entre semana y encuentros presenciales los fines de semana para quienes trabajan.</p>
                </div>
            </div>
            <div class="mcard observe">
                <div class="mcard-img">
                    <img src="https://images.unsplash.com/photo-1610484826967-09c5720778c7?w=600&auto=format&fit=crop&q=80" alt="Virtual">
                    <div class="mcard-img-label" style="background:rgba(34,211,238,.15);color:#67e8f9;border:1px solid rgba(34,211,238,.2);">100% Virtual</div>
                </div>
                <div class="mcard-body">
                    <h3>🌐 Totalmente Online</h3>
                    <p>Estudia desde cualquier parte del mundo. Clases en vivo, grabadas y material asincrónico disponible las 24 horas del día.</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── CARRERAS ── --}}
<div id="carreras" class="lp lp-dark">
    <div class="lp-inner">
        <div class="sec-header">
            <div class="sec-sup observe">Programas académicos</div>
            <h2 class="sec-h observe">Encuentra tu <em>camino</em></h2>
            <p class="sec-p observe">Cinco carreras diseñadas para las demandas del mercado tecnológico actual, con enfoque práctico y orientado al futuro.</p>
        </div>
        <div class="carrera-editorial">
            {{-- CARD DESTACADA --}}
            <div class="ccard featured observe">
                <div class="ccard-accent"></div>
                <div class="ccard-body">
                    <div class="ccard-info">
                        <div class="ccard-top">
                            <div class="ccard-ico">💻</div>
                            <span class="ccard-dur">5 años · Ingeniería</span>
                        </div>
                        <h3 style="font-size:1.1rem;margin-bottom:.5rem;">Ingeniería de Software</h3>
                        <p>Diseña, desarrolla y mantiene sistemas de software escalables con las mejores prácticas de la industria tecnológica global. Aprende desde arquitecturas de microservicios hasta inteligencia artificial aplicada.</p>
                        <div class="ccard-tags">
                            <span class="ctag">Desarrollo Web</span>
                            <span class="ctag">Arquitectura de Software</span>
                            <span class="ctag">Cloud Computing</span>
                            <span class="ctag">DevOps</span>
                            <span class="ctag">Inteligencia Artificial</span>
                        </div>
                    </div>
                    <div class="ccard-img-side">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500&auto=format&fit=crop&q=80" alt="Ingeniería de Software">
                    </div>
                </div>
            </div>
            {{-- RESTO --}}
            <div class="ccard observe">
                <div class="ccard-accent" style="background:#67e8f9;"></div>
                <div class="ccard-body">
                    <div class="ccard-top">
                        <div class="ccard-ico">📊</div>
                        <span class="ccard-dur">5 años</span>
                    </div>
                    <h3>Ciencia de Datos</h3>
                    <p>Transforma datos masivos en decisiones estratégicas. Machine learning, estadística avanzada y visualización de datos para el mercado empresarial.</p>
                    <div class="ccard-tags">
                        <span class="ctag">Machine Learning</span>
                        <span class="ctag">Python</span>
                        <span class="ctag">Big Data</span>
                    </div>
                </div>
            </div>
            <div class="ccard observe">
                <div class="ccard-accent" style="background:#f87171;"></div>
                <div class="ccard-body">
                    <div class="ccard-top">
                        <div class="ccard-ico">🔐</div>
                        <span class="ccard-dur">5 años</span>
                    </div>
                    <h3>Ciberseguridad</h3>
                    <p>Protege sistemas, redes y datos ante las amenazas digitales más avanzadas del entorno corporativo y gubernamental.</p>
                    <div class="ccard-tags">
                        <span class="ctag">Ethical Hacking</span>
                        <span class="ctag">Redes</span>
                        <span class="ctag">Forense Digital</span>
                    </div>
                </div>
            </div>
            <div class="ccard observe">
                <div class="ccard-accent" style="background:#facc15;"></div>
                <div class="ccard-body">
                    <div class="ccard-top">
                        <div class="ccard-ico">📱</div>
                        <span class="ccard-dur">4 años</span>
                    </div>
                    <h3>Sistemas de Información</h3>
                    <p>Gestiona tecnología organizacional para optimizar procesos empresariales y apoyar la toma de decisiones de alto nivel.</p>
                    <div class="ccard-tags">
                        <span class="ctag">ERP</span>
                        <span class="ctag">Gestión TI</span>
                        <span class="ctag">Bases de Datos</span>
                    </div>
                </div>
            </div>
            <div class="ccard observe">
                <div class="ccard-accent" style="background:#4ade80;"></div>
                <div class="ccard-body">
                    <div class="ccard-top">
                        <div class="ccard-ico">🤖</div>
                        <span class="ccard-dur">5 años</span>
                    </div>
                    <h3>Inteligencia Artificial</h3>
                    <p>Construye el futuro con sistemas inteligentes, redes neuronales, visión por computadora y procesamiento del lenguaje natural.</p>
                    <div class="ccard-tags">
                        <span class="ctag">Deep Learning</span>
                        <span class="ctag">NLP</span>
                        <span class="ctag">Robótica</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── POR QUÉ — BENTO ── --}}
<div id="por-que" class="lp">
    <div class="lp-inner">
        <div class="sec-header">
            <div class="sec-sup observe">¿Por qué elegirnos?</div>
            <h2 class="sec-h observe">Razones que nos <em>distinguen</em></h2>
            <p class="sec-p observe">Más que una universidad. Somos el puente entre tu formación y el futuro profesional que mereces.</p>
        </div>
        <div class="bento">
            <div class="bento-card tall observe">
                <div class="bento-ico">🏆</div>
                <h3>Calidad Académica Certificada</h3>
                <p>Reconocida por prestigiosos rankings nacionales e internacionales. Docentes con experiencia real en la industria tecnológica global.</p>
                <div class="bcard-img">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=500&auto=format&fit=crop&q=80" alt="Campus universitario">
                </div>
            </div>
            <div class="bento-card observe">
                <div class="bento-num">92%</div>
                <h3>Tasa de empleabilidad</h3>
                <p>9 de cada 10 egresados trabajan en su área dentro de los primeros 6 meses. (Ipsos 2024)</p>
            </div>
            <div class="bento-card observe">
                <div class="bento-ico">🌍</div>
                <h3>Modelo Educativo Innovador</h3>
                <p>Metodologías activas, proyectos reales con empresas líderes y enfoque práctico desde el primer ciclo.</p>
            </div>
            <div class="bento-card observe">
                <div class="bento-num">+2,400</div>
                <h3>Estudiantes activos</h3>
                <p>Una comunidad en crecimiento constante, con red de alumni en las empresas tech más importantes del país.</p>
            </div>
            <div class="bento-card observe">
                <div class="bento-ico">⚡</div>
                <h3>Tecnología de Vanguardia</h3>
                <p>Laboratorios con hardware y software de última generación. Espacios diseñados para las metodologías del futuro.</p>
            </div>
        </div>
    </div>
</div>

{{-- ── TESTIMONIOS ── --}}
<div class="lp lp-dark">
    <div class="lp-inner">
        <div class="sec-header">
            <div class="sec-sup observe">Testimonios</div>
            <h2 class="sec-h observe">Lo que dicen <em>nuestros estudiantes</em></h2>
        </div>
        <div class="testi-grid">
            <div class="tcard observe">
                <div class="tcard-stars">★★★★★</div>
                <p class="tcard-quote">"La plataforma de matrícula es increíblemente intuitiva. En menos de 10 minutos ya estaba inscrito y con acceso al campus virtual."</p>
                <div class="tcard-author">
                    <div class="tcard-avatar">AL</div>
                    <div>
                        <div class="tcard-name">Alejandro Landa</div>
                        <div class="tcard-role">Ingeniería de Software · 3er ciclo</div>
                    </div>
                </div>
            </div>
            <div class="tcard observe">
                <div class="tcard-stars">★★★★★</div>
                <p class="tcard-quote">"Estudiar en modalidad virtual me permitió trabajar y estudiar al mismo tiempo. La calidad de los docentes es excelente y siempre disponibles."</p>
                <div class="tcard-author">
                    <div class="tcard-avatar">MC</div>
                    <div>
                        <div class="tcard-name">María Castillo</div>
                        <div class="tcard-role">Ciencia de Datos · 5to ciclo</div>
                    </div>
                </div>
            </div>
            <div class="tcard observe">
                <div class="tcard-stars">★★★★★</div>
                <p class="tcard-quote">"Los proyectos reales con empresas desde el primer año marcan la diferencia. Conseguí prácticas profesionales en mi segundo ciclo."</p>
                <div class="tcard-author">
                    <div class="tcard-avatar">RP</div>
                    <div>
                        <div class="tcard-name">Rodrigo Pimentel</div>
                        <div class="tcard-role">Ciberseguridad · 4to ciclo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── PROCESO ── --}}
<div id="proceso" class="lp">
    <div class="lp-inner">
        <div class="sec-header" style="text-align:center;">
            <div class="sec-sup observe">Matrícula</div>
            <h2 class="sec-h observe">Proceso <em>simple y rápido</em></h2>
            <p class="sec-p observe" style="margin:0 auto;">En 4 pasos estarás listo para comenzar tu carrera universitaria en Nexus Academia.</p>
        </div>
        <div class="proceso-track">
            <div class="pstep observe">
                <div class="pstep-num">01</div>
                <h4>Crea tu cuenta</h4>
                <p>Regístrate con tu correo y datos personales en menos de 2 minutos desde cualquier dispositivo.</p>
            </div>
            <div class="pstep observe">
                <div class="pstep-num">02</div>
                <h4>Elige tu carrera</h4>
                <p>Selecciona la carrera y modalidad que mejor se adapte a tus metas y disponibilidad de tiempo.</p>
            </div>
            <div class="pstep observe">
                <div class="pstep-num">03</div>
                <h4>Sube documentos</h4>
                <p>Adjunta tu DNI, certificado de estudios y foto en formato digital directamente desde el portal.</p>
            </div>
            <div class="pstep observe">
                <div class="pstep-num">04</div>
                <h4>Confirma y paga</h4>
                <p>Pago en línea seguro. Recibe acceso inmediato al campus virtual y materiales del ciclo.</p>
            </div>
        </div>
    </div>
</div>

{{-- ── CTA FINAL CON IMAGEN ── --}}
<div class="cta-banner">
    <div class="blob" style="width:500px;height:500px;background:rgba(139,92,246,.06);top:-50px;right:-100px;"></div>
    <div class="cta-banner-inner">
        <div class="cta-img observe">
            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=800&auto=format&fit=crop&q=80" alt="Estudiantes en campus">
        </div>
        <div class="cta-content observe">
            <div class="sec-sup">Únete ahora</div>
            <h2>Comienza tu <em>futuro</em> hoy mismo</h2>
            <p>Las inscripciones están abiertas para el ciclo 2025-II. No dejes que otro semestre pase sin dar el primer paso hacia la carrera que siempre quisiste.</p>
            <div class="cta-btns">
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-fill btn-lg">Entrar al sistema →</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-fill btn-lg">Iniciar matrícula →</a>
                    <a href="{{ route('login') }}" class="btn btn-line btn-lg">Iniciar sesión</a>
                @endauth
            </div>
        </div>
    </div>
</div>

{{-- ── FOOTER ── --}}
<footer class="lp-footer">
    <div class="lp-footer-grid">
        <div class="footer-brand">
            <a href="/" class="n-brand" style="text-decoration:none;color:var(--text);">
                <div class="n-logo">✦</div>
                <span class="n-name">{{ config('app.name') }}</span>
            </a>
            <p>Una nueva generación de plataformas universitarias. Gestiona tu experiencia académica de forma moderna y precisa.</p>
        </div>
        <div class="footer-col">
            <h5>Carreras</h5>
            <a href="#carreras">Ingeniería de Software</a>
            <a href="#carreras">Ciencia de Datos</a>
            <a href="#carreras">Ciberseguridad</a>
            <a href="#carreras">Sistemas de Información</a>
            <a href="#carreras">Inteligencia Artificial</a>
        </div>
        <div class="footer-col">
            <h5>Plataforma</h5>
            <a href="#modalidades">Modalidades</a>
            <a href="#proceso">Proceso de matrícula</a>
            <a href="#por-que">¿Por qué Nexus?</a>
            @if (Route::has('login'))
                <a href="{{ route('login') }}">Iniciar sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Crear cuenta</a>
                @endif
            @endif
        </div>
        <div class="footer-col">
            <h5>Contacto</h5>
            <a href="mailto:admisiones@nexusacademia.edu">admisiones@nexusacademia.edu</a>
            <a href="tel:+51012345678">+51 01 234-5678</a>
            <a href="#">Sede Central — Lima</a>
            <a href="#">Sede Norte — Trujillo</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
        <div style="display:flex;gap:1.5rem;">
            <a href="#" style="color:var(--muted);text-decoration:none;font-size:.78rem;transition:color .2s" onmouseover="this.style.color='var(--text)'" onmouseout="this.style.color='var(--muted)'">Privacidad</a>
            <a href="#" style="color:var(--muted);text-decoration:none;font-size:.78rem;transition:color .2s" onmouseover="this.style.color='var(--text)'" onmouseout="this.style.color='var(--muted)'">Términos</a>
            <a href="#" style="color:var(--muted);text-decoration:none;font-size:.78rem;transition:color .2s" onmouseover="this.style.color='var(--text)'" onmouseout="this.style.color='var(--muted)'">Cookies</a>
        </div>
    </div>
</footer>

<script>
// ── CURSOR PERSONALIZADO ──
const cur  = document.getElementById('cursor');
const ring = document.getElementById('cursor-ring');
let rx = 0, ry = 0;

document.addEventListener('mousemove', e => {
    cur.style.left  = e.clientX + 'px';
    cur.style.top   = e.clientY + 'px';
    setTimeout(() => {
        ring.style.left = e.clientX + 'px';
        ring.style.top  = e.clientY + 'px';
    }, 80);
});

document.querySelectorAll('a,button,.mcard,.ccard,.bento-card,.tcard,.pstep').forEach(el => {
    el.addEventListener('mouseenter', () => { cur.classList.add('grow'); ring.classList.add('grow'); });
    el.addEventListener('mouseleave', () => { cur.classList.remove('grow'); ring.classList.remove('grow'); });
});

// ── SCROLL REVEAL ── (usa .observe y .visible de app.css)
const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.observe').forEach(el => io.observe(el));

// ── SMOOTH SCROLL ──
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const t = document.querySelector(a.getAttribute('href'));
        if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
    });
});
</script>

</body>
</html>