<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') — {{ config('app.name') }}</title>
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
        .blob { position:fixed; border-radius:50%; filter:blur(130px); pointer-events:none; animation:blobD 18s ease-in-out infinite; z-index:0; }
        @keyframes blobD { 0%,100%{transform:translate(0,0) scale(1)} 33%{transform:translate(40px,-30px) scale(1.07)} 66%{transform:translate(-25px,20px) scale(.94)} }

        /* ── SIDEBAR ── */
        .layout { display:flex; min-height:100vh; }

        .sidebar {
            width: 240px; flex-shrink:0;
            background:var(--sf); border-right:1px solid var(--border);
            position:fixed; top:0; left:0; bottom:0;
            display:flex; flex-direction:column;
            padding:0; z-index:90; overflow-y:auto;
        }
        .sb-brand {
            display:flex; align-items:center; gap:.8rem;
            padding:1.4rem 1.5rem; border-bottom:1px solid var(--border);
            text-decoration:none; color:var(--text);
        }
        .sb-name { font-size:.88rem; font-weight:600; letter-spacing:-.02em; }
        .sb-sub  { font-size:.68rem; color:var(--muted); }

        .sb-section { padding:.8rem .8rem .3rem; font-size:.62rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--muted); }

        .sb-link {
            display:flex; align-items:center; gap:.7rem;
            padding:.7rem 1rem; border-radius:12px; margin:0 .5rem .15rem;
            text-decoration:none; color:var(--muted); font-size:.83rem; font-weight:500;
            transition:background .2s, color .2s, border-color .2s;
            border:1px solid transparent;
        }
        .sb-link:hover { background:rgba(167,139,250,.06); color:var(--text); border-color:rgba(167,139,250,.12); }
        .sb-link.active { background:rgba(167,139,250,.08); color:var(--text); border-color:rgba(167,139,250,.18); }
        .sb-link .sb-ico { font-size:1rem; width:28px; height:28px; border-radius:8px; display:flex; align-items:center; justify-content:center; background:rgba(255,255,255,.03); flex-shrink:0; }
        .sb-link.active .sb-ico { background:rgba(167,139,250,.1); }
        .sb-link .sb-badge { margin-left:auto; font-size:.65rem; padding:.18rem .55rem; border-radius:100px; background:rgba(167,139,250,.12); color:var(--accent); }

        .sb-footer { margin-top:auto; padding:1rem .8rem; border-top:1px solid var(--border); }
        .sb-user { display:flex; align-items:center; gap:.7rem; padding:.7rem .8rem; border-radius:12px; }
        .sb-avatar { width:32px; height:32px; border-radius:9px; background:rgba(167,139,250,.1); border:1px solid rgba(167,139,250,.2); display:flex; align-items:center; justify-content:center; font-size:.8rem; font-weight:700; color:var(--accent); flex-shrink:0; }
        .sb-user-info .sb-uname { font-size:.8rem; font-weight:600; }
        .sb-user-info .sb-uemail{ font-size:.68rem; color:var(--muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:120px; }

        /* ── MAIN CONTENT ── */
        .main-content {
            margin-left:240px; flex:1;
            min-height:100vh; position:relative; z-index:1;
        }

        /* ── TOP NAV (dentro del main) ── */
        .top-nav {
            position:sticky; top:0; z-index:80;
            background:rgba(6,6,8,.9); backdrop-filter:blur(14px);
            border-bottom:1px solid var(--border);
            padding:.9rem 2rem;
            display:flex; align-items:center; justify-content:space-between;
        }
        .top-nav-title {
            font-family:'Playfair Display',serif;
            font-size:1.1rem; font-weight:700; letter-spacing:-.02em;
        }
        .top-nav-title em { font-style:italic; color:var(--accent); }
        .top-nav-right { display:flex; align-items:center; gap:.8rem; }
        .top-nav-user { font-size:.8rem; color:var(--muted); }
        .top-nav-user strong { color:var(--text); font-weight:600; }

        /* ── PAGE HEADER CON IMAGEN ── */
        .page-hero {
            position:relative; height:160px; overflow:hidden;
            border-bottom:1px solid var(--border);
        }
        .page-hero img { width:100%; height:100%; object-fit:cover; filter:brightness(.45) saturate(1.1); }
        .page-hero-overlay { position:absolute; inset:0; background:linear-gradient(90deg, rgba(6,6,8,.9) 0%, rgba(6,6,8,.4) 100%); }
        .page-hero-content {
            position:absolute; inset:0; display:flex; align-items:center;
            padding:0 2rem; gap:1rem;
        }
        .page-hero-icon {
            width:52px; height:52px; border-radius:14px;
            background:rgba(167,139,250,.12); border:1px solid rgba(167,139,250,.25);
            display:flex; align-items:center; justify-content:center; font-size:1.4rem; flex-shrink:0;
        }
        .page-hero-text h1 {
            font-family:'Playfair Display',serif;
            font-size:1.6rem; font-weight:800; letter-spacing:-.02em; line-height:1.1;
        }
        .page-hero-text h1 em { font-style:italic; color:var(--accent); }
        .page-hero-text p { font-size:.8rem; color:rgba(255,255,255,.5); margin-top:.25rem; }

        /* ── CONTENT AREA ── */
        .content-area { padding:2rem; }

        /* ── TOOLBAR PREMIUM ── */
        .prem-toolbar {
            display:flex; align-items:center; justify-content:space-between;
            gap:1rem; flex-wrap:wrap; margin-bottom:1.5rem;
        }
        .prem-toolbar-left { display:flex; align-items:center; gap:1rem; }
        .prem-toolbar-right { display:flex; align-items:center; gap:.8rem; }

        .search-wrap { position:relative; }
        .search-wrap::before { content:'🔍'; position:absolute; left:.9rem; top:50%; transform:translateY(-50%); font-size:.8rem; pointer-events:none; }
        .search-wrap .field-input { padding-left:2.4rem; height:40px; border-radius:12px; }

        /* ── TABLE PREMIUM ── */
        .table-card {
            background:var(--sf); border:1px solid var(--border);
            border-radius:20px; overflow:hidden;
        }
        .table-card-head {
            padding:1rem 1.5rem; border-bottom:1px solid var(--border);
            display:flex; align-items:center; justify-content:space-between;
            background:var(--sf2);
        }
        .tbl-info { font-size:.78rem; color:var(--muted); }

        /* ── MODAL PREMIUM ── */
        .modal-overlay {
            display:none; position:fixed; inset:0;
            background:rgba(0,0,0,.75); backdrop-filter:blur(8px);
            justify-content:center; align-items:center; z-index:2000;
        }
        .modal-content {
            background:var(--sf); padding:2.2rem;
            border-radius:22px; border:1px solid var(--border);
            text-align:center; width:90%; max-width:400px;
            box-shadow:0 40px 100px rgba(0,0,0,.6);
            animation:fadeUp .3s ease both;
        }
        .modal-icon { font-size:2.5rem; margin-bottom:1rem; }
        .modal-content h3 { font-family:'Playfair Display',serif; font-size:1.3rem; font-weight:700; margin-bottom:.6rem; }
        .modal-content p  { color:var(--muted); font-size:.85rem; line-height:1.7; margin-bottom:1.8rem; }
        .modal-actions { display:flex; gap:.7rem; justify-content:center; }

        @media(max-width:900px){ .sidebar{display:none;} .main-content{margin-left:0;} }
    </style>
</head>
<body>

<div id="cur"></div><div id="cur-r"></div>
<div class="blob" style="width:500px;height:500px;background:rgba(139,92,246,.05);top:-100px;right:-50px;"></div>

<div class="layout">

    {{-- ── SIDEBAR ── --}}
    <aside class="sidebar">
        <a href="{{ url('/home') }}" class="sb-brand">
            <div class="n-logo">✦</div>
            <div>
                <div class="sb-name">{{ config('app.name') }}</div>
                <div class="sb-sub">Panel de control</div>
            </div>
        </a>

        <div style="padding:.8rem .5rem; flex:1;">
            <div class="sb-section">Principal</div>
            <a href="{{ url('/home') }}" class="sb-link {{ request()->is('home') ? 'active' : '' }}">
                <div class="sb-ico">🏠</div> Dashboard
            </a>

            <div class="sb-section" style="margin-top:.8rem;">Gestión</div>
            <a href="{{ route('students.index') }}"  class="sb-link {{ request()->is('students*') ? 'active' : '' }}">
                <div class="sb-ico">👥</div> Estudiantes
            </a>
            <a href="{{ route('courses.index') }}"   class="sb-link {{ request()->is('courses*') ? 'active' : '' }}">
                <div class="sb-ico">📚</div> Cursos
            </a>
            <a href="{{ route('teachers.index') }}"  class="sb-link {{ request()->is('teachers*') ? 'active' : '' }}">
                <div class="sb-ico">🧑‍🏫</div> Profesores
            </a>
            <a href="{{ route('registers.index') }}" class="sb-link {{ request()->is('registers*') ? 'active' : '' }}">
                <div class="sb-ico">📋</div> Matrículas
            </a>
            <a href="{{ route('schedules.index') }}" class="sb-link {{ request()->is('schedules*') ? 'active' : '' }}">
                <div class="sb-ico">🗓️</div> Horarios
            </a>
        </div>


        <div class="sb-footer">
            <div class="sb-user">
                <div class="sb-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div class="sb-user-info">
                    <div class="sb-uname">{{ explode(' ', Auth::user()->name)[0] }}</div>
                    <div class="sb-uemail">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin-top:.5rem;">
                @csrf
                <button type="submit" class="btn btn-ghost btn-full" style="font-size:.8rem;height:38px;">Cerrar sesión</button>
            </form>
        </div>
    </aside>

    {{-- ── MAIN ── --}}
    <div class="main-content">

        {{-- Top nav --}}
        <div class="top-nav">
            <div class="top-nav-title">@yield('title')</div>
            <div class="top-nav-right">
                <span class="top-nav-user">Sesión: <strong>{{ Auth::user()->name }}</strong></span>
                <span class="dash-row-badge">Sistema activo</span>
            </div>
        </div>

        {{-- Page hero --}}
        <div class="page-hero">
            <img src="@yield('hero_img', 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=1400&auto=format&fit=crop&q=80')" alt="header">
            <div class="page-hero-overlay"></div>
            <div class="page-hero-content">
                <div class="page-hero-icon">@yield('hero_icon', '✦')</div>
                <div class="page-hero-text">
                    <h1>@yield('hero_title')</h1>
                    <p>@yield('hero_subtitle')</p>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="content-area">
            @yield('content')
        </div>

    </div>
</div>

<script>
const cur=document.getElementById('cur'),ring=document.getElementById('cur-r');
document.addEventListener('mousemove',e=>{
    cur.style.left=e.clientX+'px'; cur.style.top=e.clientY+'px';
    setTimeout(()=>{ring.style.left=e.clientX+'px'; ring.style.top=e.clientY+'px';},90);
});
document.querySelectorAll('a,button,.qstat-card,.table-card tr').forEach(el=>{
    el.addEventListener('mouseenter',()=>{cur.classList.add('g');ring.classList.add('g');});
    el.addEventListener('mouseleave',()=>{cur.classList.remove('g');ring.classList.remove('g');});
});
const io=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');io.unobserve(e.target);}});},{threshold:.08});
document.querySelectorAll('.observe').forEach(el=>io.observe(el));

// Search filter
document.querySelectorAll('.search-input').forEach(input=>{
    input.addEventListener('input',function(){
        const q=this.value.toLowerCase();
        document.querySelectorAll('.data-table tbody tr').forEach(row=>{
            row.style.display=row.textContent.toLowerCase().includes(q)?'':'none';
        });
    });
});

// Modal
function openModal(id, resource){
    document.getElementById('deleteForm').action='/'+resource+'/'+id;
    document.getElementById('deleteModal').style.display='flex';
}
function closeModal(){
    document.getElementById('deleteModal').style.display='none';
}
document.getElementById('deleteModal')?.addEventListener('click',function(e){
    if(e.target===this) closeModal();
});
</script>
@stack('scripts')
</body>
</html>
