<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap" rel="stylesheet">
    <style>
        /* ── CURSOR ── */
        * { cursor: none !important; }
        #cur  { width:9px; height:9px; background:var(--accent); border-radius:50%; position:fixed; pointer-events:none; z-index:9999; transform:translate(-50%,-50%); transition:width .15s,height .15s; }
        #cur-r{ width:34px; height:34px; border:1px solid rgba(167,139,250,.4); border-radius:50%; position:fixed; pointer-events:none; z-index:9998; transform:translate(-50%,-50%); transition:left .1s,top .1s,width .2s,height .2s; }
        #cur.g { width:14px; height:14px; } #cur-r.g { width:52px; height:52px; }
        @media(max-width:640px){ #cur,#cur-r{display:none;} *{cursor:auto!important;} }

        /* ── NOISE ── */
        body::after { content:''; position:fixed; inset:0; background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E"); opacity:.025; pointer-events:none; z-index:1000; }

        /* ── BLOB ── */
        .blob { position:fixed; border-radius:50%; filter:blur(130px); pointer-events:none; animation:blobD 18s ease-in-out infinite; }
        @keyframes blobD { 0%,100%{transform:translate(0,0) scale(1)} 33%{transform:translate(40px,-30px) scale(1.07)} 66%{transform:translate(-25px,20px) scale(.94)} }

        /* ── TOPBAR DEL DASH ── */
        .dash-topbar {
            display:flex; align-items:center; justify-content:space-between;
            margin-bottom:3.5rem; padding-bottom:2rem;
            border-bottom:1px solid var(--border);
        }
        .topbar-left {}
        .topbar-greeting {
            font-size:.72rem; letter-spacing:.12em; text-transform:uppercase;
            color:var(--muted); margin-bottom:.3rem;
        }
        .topbar-name {
            font-family:'Playfair Display',serif;
            font-size:clamp(1.8rem,3vw,2.4rem); font-weight:800;
            letter-spacing:-.02em; line-height:1.1;
        }
        .topbar-name em { font-style:italic; color:var(--accent); }

        /* ── LAYOUT PRINCIPAL DEL DASH ── */
        .dash-layout {
            max-width:1300px; margin:0 auto;
            padding:8rem 2.5rem 4rem;
            position:relative; z-index:1;
        }

        /* ── QUICK STATS ── */
        .qstats { display:grid; grid-template-columns:repeat(4,1fr); gap:1.2rem; margin-bottom:3rem; }
        .qstat-card {
            background:var(--sf); border:1px solid var(--border);
            border-radius:20px; padding:1.6rem;
            transition:border-color .25s, transform .25s;
            position:relative; overflow:hidden;
        }
        .qstat-card:hover { border-color:rgba(167,139,250,.28); transform:translateY(-3px); }
        .qstat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:var(--accent); opacity:0; transition:.25s; }
        .qstat-card:hover::before { opacity:.6; }
        .qstat-icon { font-size:1.5rem; margin-bottom:1rem; }
        .qstat-num { font-family:'Playfair Display',serif; font-size:2rem; font-weight:800; color:var(--accent); letter-spacing:-.04em; }
        .qstat-label { font-size:.73rem; color:var(--muted); margin-top:.3rem; text-transform:uppercase; letter-spacing:.07em; }

        /* ── GRID BENTO DASHBOARD ── */
        .dash-bento {
            display:grid;
            grid-template-columns:1.5fr 1fr;
            grid-template-rows:auto auto;
            gap:1.5rem;
        }
        .db-card {
            background:var(--sf); border:1px solid var(--border);
            border-radius:22px; overflow:hidden;
            transition:border-color .25s;
        }
        .db-card:hover { border-color:rgba(167,139,250,.2); }
        .db-card-head {
            padding:1.4rem 1.6rem; border-bottom:1px solid var(--border);
            display:flex; align-items:center; justify-content:space-between;
        }
        .db-card-title { font-size:.88rem; font-weight:600; display:flex; align-items:center; gap:.6rem; }
        .db-card-title span { color:var(--accent); }
        .db-card-body { padding:1.4rem 1.6rem; }

        /* Card principal con imagen */
        .db-card.hero-card { grid-row:span 2; position:relative; }
        .db-hero-img {
            width:100%; height:220px; object-fit:cover;
            filter:brightness(.65) saturate(1.1);
            display:block;
        }
        .db-hero-overlay {
            position:absolute; top:0; left:0; right:0; height:220px;
            background:linear-gradient(to bottom, transparent 30%, rgba(13,13,17,.98));
        }
        .db-hero-content { padding:1.6rem; }
        .db-hero-content .status { margin-bottom:1rem; }
        .db-hero-title {
            font-family:'Playfair Display',serif;
            font-size:1.7rem; font-weight:800; letter-spacing:-.02em;
            margin-bottom:.6rem; line-height:1.15;
        }
        .db-hero-title em { font-style:italic; color:var(--accent); }
        .db-hero-desc { font-size:.85rem; color:var(--muted); line-height:1.8; margin-bottom:1.5rem; }
        .db-hero-date { font-size:.72rem; color:var(--muted); text-transform:capitalize; letter-spacing:.04em; margin-bottom:.5rem; }

        /* Mini stats */
        .mini-stats { display:grid; grid-template-columns:repeat(3,1fr); gap:.8rem; margin-top:1.4rem; }
        .mini-stat {
            padding:.9rem 1rem; border:1px solid var(--border);
            border-radius:14px; background:var(--sf2);
        }
        .mini-stat-n { font-size:1.3rem; font-weight:700; color:var(--accent); letter-spacing:-.03em; }
        .mini-stat-l { font-size:.7rem; color:var(--muted); margin-top:.2rem; }

        /* Status panel */
        .status-list { }
        .status-row {
            display:flex; align-items:center; justify-content:space-between;
            padding:.9rem 0; border-bottom:1px solid var(--border);
            transition:.2s;
        }
        .status-row:last-child { border-bottom:none; }
        .status-row:hover { padding-left:.3rem; }
        .status-row-label { font-size:.82rem; color:var(--muted); }
        .status-row-val { font-size:.82rem; font-weight:600; }

        /* Nav links rápidos */
        .quick-nav { display:grid; grid-template-columns:1fr 1fr; gap:.8rem; }
        .qnav-item {
            display:flex; align-items:center; gap:.8rem;
            padding:1rem 1.1rem; border:1px solid var(--border);
            border-radius:14px; background:var(--sf2);
            text-decoration:none; color:var(--text);
            transition:border-color .2s, transform .2s, background .2s;
            font-size:.83rem; font-weight:500;
        }
        .qnav-item:hover { border-color:rgba(167,139,250,.3); transform:translateY(-2px); background:rgba(167,139,250,.04); }
        .qnav-ico { font-size:1.1rem; width:32px; height:32px; background:rgba(167,139,250,.06); border-radius:9px; display:flex; align-items:center; justify-content:center; }

        /* Imagen de bienvenida decorativa */
        .db-img-deco {
            width:100%; height:160px; object-fit:cover;
            filter:brightness(.6) saturate(1.1);
            display:block;
        }

        @media(max-width:1024px){ .dash-bento { grid-template-columns:1fr; } .qstats { grid-template-columns:repeat(2,1fr); } .db-card.hero-card { grid-row:auto; } }
        @media(max-width:600px){ .qstats { grid-template-columns:1fr 1fr; } }
    </style>
</head>
<body>

<div id="cur"></div><div id="cur-r"></div>
<div class="blob" style="width:500px;height:500px;background:rgba(139,92,246,.06);top:-80px;right:-80px;"></div>
<div class="blob" style="width:350px;height:350px;background:rgba(34,211,238,.03);bottom:0;left:50px;animation-delay:-7s;"></div>

{{-- NAV --}}
<nav class="n">
    <div class="n-brand">
        <div class="n-logo">✦</div>
        <div>
            <div class="n-name">{{ config('app.name') }}</div>
            <div class="n-sub">Plataforma académica</div>
        </div>
    </div>
    <div class="n-user">
        <div class="n-user-info">
            <span>Sesión iniciada</span>
            <strong>{{ Auth::user()->name }}</strong>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-ghost">Salir</button>
        </form>
    </div>
</nav>

<div class="dash-layout">

    {{-- TOPBAR --}}
    <div class="dash-topbar observe">
        <div class="topbar-left">
            <div class="topbar-greeting">Bienvenido de nuevo</div>
            <h1 class="topbar-name">
                Hola, <em>{{ explode(' ', Auth::user()->name)[0] }}.</em>
            </h1>
        </div>
        <div>
            <a href="{{ route('registers.create') }}" class="btn btn-fill btn-lg">+ Nueva Matrícula</a>
        </div>
    </div>

    {{-- QUICK STATS --}}
    <div class="qstats">
        <div class="qstat-card observe">
            <div class="qstat-icon">🎓</div>
            <div class="qstat-num">12</div>
            <div class="qstat-label">Cursos activos</div>
        </div>
        <div class="qstat-card observe" style="transition-delay:.05s">
            <div class="qstat-icon">👥</div>
            <div class="qstat-num">1,247</div>
            <div class="qstat-label">Estudiantes activos</div>
        </div>
        <div class="qstat-card observe" style="transition-delay:.1s">
            <div class="qstat-icon">📋</div>
            <div class="qstat-num">98%</div>
            <div class="qstat-label">Rendimiento</div>
        </div>
        <div class="qstat-card observe" style="transition-delay:.15s">
            <div class="qstat-icon">⚡</div>
            <div class="qstat-num">24/7</div>
            <div class="qstat-label">Sistema online</div>
        </div>
    </div>

    {{-- BENTO GRID --}}
    <div class="dash-bento">

        {{-- CARD HERO --}}
        <div class="db-card hero-card observe">
            <img class="db-hero-img" src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=900&auto=format&fit=crop&q=80" alt="Campus">
            <div class="db-hero-overlay"></div>
            <div class="db-hero-content">
                <div class="status">
                    <span class="status-dot"></span>
                    Plataforma sincronizada
                </div>
                <div class="db-hero-date">
                    {{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                </div>
                <h2 class="db-hero-title">
                    Tu entorno <em>académico</em><br>está listo.
                </h2>
                <p class="db-hero-desc">Gestiona matrículas, revisa el progreso de estudiantes y controla toda la experiencia universitaria desde aquí.</p>
                <a href="{{ route('students.index') }}" class="btn btn-fill">Explorar plataforma →</a>

                <div class="mini-stats">
                    <div class="mini-stat observe">
                        <div class="mini-stat-n">12</div>
                        <div class="mini-stat-l">Cursos activos</div>
                    </div>
                    <div class="mini-stat observe" style="transition-delay:.08s">
                        <div class="mini-stat-n">98%</div>
                        <div class="mini-stat-l">Rendimiento</div>
                    </div>
                    <div class="mini-stat observe" style="transition-delay:.16s">
                        <div class="mini-stat-n">24/7</div>
                        <div class="mini-stat-l">Online</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STATUS DEL SISTEMA --}}
        <div class="db-card observe">
            <div class="db-card-head">
                <div class="db-card-title">
                    <span>✦</span> Estado del sistema
                </div>
                <span class="dash-row-badge">En vivo</span>
            </div>
            <div class="db-card-body">
                <div class="status-list">
                    <div class="status-row">
                        <span class="status-row-label">Plataforma</span>
                        <span class="dash-row-badge">Operativa</span>
                    </div>
                    <div class="status-row">
                        <span class="status-row-label">Google OAuth</span>
                        <span class="dash-row-badge">Activo</span>
                    </div>
                    <div class="status-row">
                        <span class="status-row-label">Seguridad</span>
                        <span class="dash-row-badge">Protegido</span>
                    </div>
                    <div class="status-row">
                        <span class="status-row-label">Versión</span>
                        <span class="status-row-val">v2.0</span>
                    </div>
                    <div class="status-row">
                        <span class="status-row-label">Estudiantes activos</span>
                        <span class="status-row-val">1,247</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ACCESO RÁPIDO --}}
        <div class="db-card observe">
            <img class="db-img-deco" src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&auto=format&fit=crop&q=80" alt="Equipo">
            <div class="db-card-head" style="border-top:1px solid var(--border);">
                <div class="db-card-title"><span>⚡</span> Acceso rápido</div>
            </div>
            <div class="db-card-body">
                <div class="quick-nav">
                    <a href="{{ route('students.index') }}"  class="qnav-item"><div class="qnav-ico">👥</div> Estudiantes</a>
                    <a href="{{ route('courses.index') }}"   class="qnav-item"><div class="qnav-ico">📚</div> Cursos</a>
                    <a href="{{ route('teachers.index') }}"  class="qnav-item"><div class="qnav-ico">🧑‍🏫</div> Profesores</a>
                    <a href="{{ route('registers.index') }}" class="qnav-item"><div class="qnav-ico">📋</div> Matrículas</a>
                    <a href="{{ route('schedules.index') }}" class="qnav-item"><div class="qnav-ico">🗓️</div> Horarios</a>
                    <a href="{{ route('registers.create') }}"class="qnav-item" style="border-color:rgba(167,139,250,.2);background:rgba(167,139,250,.04);"><div class="qnav-ico">✦</div> Nueva matrícula</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
const cur=document.getElementById('cur'),ring=document.getElementById('cur-r');
document.addEventListener('mousemove',e=>{
    cur.style.left=e.clientX+'px'; cur.style.top=e.clientY+'px';
    setTimeout(()=>{ring.style.left=e.clientX+'px'; ring.style.top=e.clientY+'px';},90);
});
document.querySelectorAll('a,button,.qstat-card,.db-card,.qnav-item').forEach(el=>{
    el.addEventListener('mouseenter',()=>{cur.classList.add('g');ring.classList.add('g');});
    el.addEventListener('mouseleave',()=>{cur.classList.remove('g');ring.classList.remove('g');});
});
const io=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');io.unobserve(e.target);}});},{threshold:.1});
document.querySelectorAll('.observe').forEach(el=>io.observe(el));
</script>
</body>
</html>