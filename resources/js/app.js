const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
document.querySelectorAll('.observe').forEach(el => observer.observe(el));

document.querySelectorAll('.alert[data-dismiss]').forEach(alert => {
    setTimeout(() => {
        alert.style.transition = 'opacity .35s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 350);
    }, parseInt(alert.dataset.dismiss) || 4000);
});

document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', () => {
        const btn = form.querySelector('.btn-fill');
        if (btn) { btn.disabled = true; btn.style.opacity = '.6'; }
    });
});

/* ══════════════════════════════════════
   CHARACTER — personaje animado auth
══════════════════════════════════════ */
(function () {
  if (!document.querySelector('.auth-box')) return;

  const wrap = document.createElement('div');
  wrap.id        = 'char-wrap';
  wrap.className = 'char-idle';

  wrap.innerHTML = `
    <div class="char-bubble" id="char-bubble">¡Hola!</div>
    <svg id="char-svg" viewBox="0 0 115 158"
         xmlns="http://www.w3.org/2000/svg" width="115" height="158">

      <!-- LIBRO -->
      <ellipse cx="57" cy="118" rx="34" ry="5" fill="rgba(0,0,0,.18)"/>
      <path d="M24 98 Q24 115 57 115 L57 98 Z" fill="#f5f0e8"/>
      <path d="M90 98 Q90 115 57 115 L57 98 Z" fill="#ede8dc"/>
      <rect x="53.5" y="98" width="7" height="17" rx="2.5" fill="#6d4fa8"/>
      <line x1="30" y1="104" x2="51" y2="104" stroke="#d0cbc0" stroke-width="1"/>
      <line x1="30" y1="108" x2="51" y2="108" stroke="#d0cbc0" stroke-width="1"/>
      <line x1="30" y1="112" x2="44" y2="112" stroke="#d0cbc0" stroke-width="1"/>

      <!-- LÍNEAS ANIMADAS -->
      <line class="wline" x1="63" y1="104" x2="63" y2="104"
            stroke="#a78bfa" stroke-width="1.3" stroke-linecap="round"/>
      <line class="wline" x1="63" y1="108" x2="63" y2="108"
            stroke="#a78bfa" stroke-width="1.3" stroke-linecap="round"/>
      <line class="wline" x1="63" y1="112" x2="63" y2="112"
            stroke="#a78bfa" stroke-width="1.3" stroke-linecap="round"/>

      <!-- PIERNAS -->
      <path d="M43 90 Q38 104 36 116" stroke="#2a1c48" stroke-width="10" fill="none" stroke-linecap="round"/>
      <path d="M65 90 Q70 104 72 116" stroke="#2a1c48" stroke-width="10" fill="none" stroke-linecap="round"/>
      <ellipse cx="34" cy="118" rx="9" ry="5" fill="#15101e"/>
      <ellipse cx="74" cy="118" rx="9" ry="5" fill="#15101e"/>

      <!-- TORSO -->
      <rect x="37" y="60" width="34" height="34" rx="11" fill="#4c3575"/>
      <path d="M50 60 Q54 69 58 60" fill="#6d4fa8"/>

      <!-- BRAZO IZQUIERDO -->
      <path d="M39 68 Q28 82 30 97" stroke="#e8b87a" stroke-width="7.5" fill="none" stroke-linecap="round"/>
      <circle cx="30" cy="97" r="5.5" fill="#e8b87a"/>

      <!-- BRAZO DERECHO + LÁPIZ -->
      <g id="char-arm-r">
        <path d="M69 68 Q80 82 78 95" stroke="#e8b87a" stroke-width="7.5" fill="none" stroke-linecap="round"/>
        <circle cx="78" cy="95" r="5.5" fill="#e8b87a"/>
        <g transform="translate(78,95) rotate(28)">
          <rect x="-2" y="-22" width="4" height="16" rx="2" fill="#f0e0b0"/>
          <polygon points="-2,4.5 2,4.5 0,12" fill="#e8b87a"/>
          <rect x="-2" y="-27" width="4" height="5.5" rx="1.5" fill="#a78bfa"/>
          <rect x="-2" y="-29" width="4" height="2.5" rx="1" fill="#7c5cb5"/>
        </g>
      </g>

      <!-- CABEZA -->
      <g id="char-head">
        <ellipse cx="54" cy="29" rx="20" ry="14" fill="#15101e"/>
        <ellipse cx="54" cy="22" rx="17" ry="14" fill="#15101e"/>
        <circle  cx="54" cy="36" r="19" fill="#e8b87a"/>
        <ellipse cx="42" cy="39" rx="5.5" ry="3.5" fill="rgba(235,130,90,.22)"/>
        <ellipse cx="66" cy="39" rx="5.5" ry="3.5" fill="rgba(235,130,90,.22)"/>

        <g id="eyes-open">
          <ellipse cx="46" cy="33" rx="3.2" ry="3.8" fill="#15101e"/>
          <ellipse cx="62" cy="33" rx="3.2" ry="3.8" fill="#15101e"/>
          <circle  cx="45" cy="32" r="1.3" fill="white"/>
          <circle  cx="61" cy="32" r="1.3" fill="white"/>
        </g>
        <g id="eyes-closed" display="none">
          <path d="M43,33 Q46,29.5 49,33" stroke="#15101e" stroke-width="2" fill="none" stroke-linecap="round"/>
          <path d="M59,33 Q62,29.5 65,33" stroke="#15101e" stroke-width="2" fill="none" stroke-linecap="round"/>
        </g>

        <path id="mouth-normal" d="M49 42 Q54 46 59 42"
              stroke="#c8885a" stroke-width="1.8" fill="none" stroke-linecap="round"/>
        <path id="mouth-happy"  d="M48 41 Q54 48 60 41"
              stroke="#c8885a" stroke-width="1.8" fill="none" stroke-linecap="round"
              display="none"/>
      </g>

    </svg>
  `;

  document.body.appendChild(wrap);

  /* stroke-dash para líneas de escritura */
  const LINE_LEN = 24;
  wrap.querySelectorAll('.wline').forEach(l => {
    l.style.strokeDasharray  = LINE_LEN;
    l.style.strokeDashoffset = LINE_LEN;
    l.style.transition       = 'stroke-dashoffset .28s ease';
  });

  /* máquina de estados */
  let state     = 'idle';
  let idleTimer = null;

  function setState(s) {
    if (state === s) return;
    state = s;
    wrap.className = 'char-' + s;

    if (s === 'writing') {
      wrap.querySelectorAll('.wline').forEach((l, i) => {
        setTimeout(() => { l.style.strokeDashoffset = '0'; }, i * 90);
      });
    }
    if (s === 'erasing') {
      wrap.querySelectorAll('.wline').forEach((l, i) => {
        setTimeout(() => { l.style.strokeDashoffset = LINE_LEN; }, i * 65);
      });
    }
  }

  function goIdle() {
    clearTimeout(idleTimer);
    idleTimer = setTimeout(() => setState('idle'), 750);
  }

  /* escuchar inputs */
  const lengths = new Map();

  document.querySelectorAll('.field-input').forEach(inp => {
    lengths.set(inp, 0);

    inp.addEventListener('input', () => {
      if (state === 'welcome') return;
      const curr = inp.value.length;
      const prev = lengths.get(inp) || 0;
      setState(curr < prev ? 'erasing' : 'writing');
      lengths.set(inp, curr);
      goIdle();
    });

    inp.addEventListener('keydown', e => {
      if (state === 'welcome') return;
      if (e.key === 'Backspace' || e.key === 'Delete') {
        setState('erasing');
        goIdle();
      }
    });
  });

  /* submit → bienvenida */
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', () => {
      const nameEl  = form.querySelector('[name="name"]');
      const emailEl = form.querySelector('[name="email"]');
      let nombre = '';

      if (nameEl && nameEl.value.trim()) {
        nombre = nameEl.value.trim().split(' ')[0];
      } else if (emailEl && emailEl.value.trim()) {
        nombre = emailEl.value.trim().split('@')[0];
      }

      clearTimeout(idleTimer);
      setState('welcome');
      document.getElementById('char-bubble').textContent =
        nombre ? `¡Bienvenido, ${nombre}!` : '¡Bienvenido!';
    });
  });

})();