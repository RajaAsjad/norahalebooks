/**
 * Nora Hale Books — site interactions, loader, canvas animations
 */

window.addEventListener('scroll', () => {
  const nav = document.getElementById('nav');
  if (nav) nav.classList.toggle('s', scrollY > 20);
}, { passive: true });

function tmm() {
  const m = document.getElementById('mm');
  if (!m) return;
  m.classList.toggle('open');
  document.body.style.overflow = m.classList.contains('open') ? 'hidden' : '';
}

function initMarquee() {
  const el = document.getElementById('mqt');
  if (!el || !window.SITE_MARQUEE_ITEMS) return;
  const items = window.SITE_MARQUEE_ITEMS;
  const all = [...items, ...items];
  el.innerHTML = all.map(i => `<span class="mq-i">${i}<span style="color:rgba(45,106,79,.25);margin-left:32px">·</span></span>`).join('');
}

function sbf(e) {
  const fn = document.getElementById('fn');
  const fe = document.getElementById('fe');
  const fm = document.getElementById('fm');
  let ok = true;
  const show = (id, on) => {
    const el = document.getElementById(id);
    if (el) el.classList.toggle('show', on);
  };
  if (fn && !fn.value.trim()) { show('fne', true); ok = false; } else show('fne', false);
  if (fe && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(fe.value)) { show('fee', true); ok = false; } else show('fee', false);
  if (fm && !fm.value.trim()) { show('fme', true); ok = false; } else show('fme', false);
  if (!ok) { e.preventDefault(); return false; }
  const b = document.getElementById('fsb');
  if (b) { b.disabled = true; b.textContent = 'Sending...'; }
  return true;
}

function rsf() {
  document.getElementById('cf')?.reset();
  const fv = document.getElementById('fv');
  const sv = document.getElementById('sv');
  if (fv) fv.style.display = 'block';
  if (sv) sv.style.display = 'none';
  const b = document.getElementById('fsb');
  if (b) { b.disabled = false; b.textContent = '✉ Send Message'; }
}

function ir() {
  const obs = new IntersectionObserver(entries => {
    entries.forEach(en => {
      if (en.isIntersecting) {
        const el = en.target;
        const d = parseInt(el.dataset.delay || '0', 10);
        setTimeout(() => el.classList.add('vis'), d);
        obs.unobserve(el);
      }
    });
  }, { threshold: 0.1 });
  document.querySelectorAll('.rev:not(.vis)').forEach(el => obs.observe(el));
}

function initPageLoader() {
  const loader = document.getElementById('page-loader');
  const canvas = document.getElementById('loader-canvas');
  if (!loader) return;

  let animId;
  if (canvas) {
    const ctx = canvas.getContext('2d');
    const particles = [];
    const resize = () => {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
    };
    resize();
    window.addEventListener('resize', resize);

    for (let i = 0; i < 48; i++) {
      particles.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        r: Math.random() * 3 + 1,
        dx: (Math.random() - 0.5) * 0.6,
        dy: (Math.random() - 0.5) * 0.6,
        a: Math.random() * 0.4 + 0.1,
      });
    }

    const draw = () => {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      particles.forEach(p => {
        p.x += p.dx;
        p.y += p.dy;
        if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
        if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(45, 106, 79, ${p.a})`;
        ctx.fill();
      });
      animId = requestAnimationFrame(draw);
    };
    draw();

    setTimeout(() => {
      cancelAnimationFrame(animId);
      loader.classList.add('done');
      document.body.style.overflow = '';
    }, 1400);
  } else {
    setTimeout(() => loader.classList.add('done'), 800);
  }

  document.body.style.overflow = 'hidden';
}

function initHeroCanvas() {
  if (!window.SITE_CANVAS_HERO) return;
  const canvas = document.getElementById('hero-canvas') || document.getElementById('kit-canvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  const parent = canvas.parentElement;
  let w, h, t = 0;
  const leaves = [];

  const resize = () => {
    w = canvas.width = parent.offsetWidth;
    h = canvas.height = parent.offsetHeight;
  };
  resize();
  window.addEventListener('resize', resize);

  for (let i = 0; i < 24; i++) {
    leaves.push({
      x: Math.random() * 800,
      y: Math.random() * 600,
      size: Math.random() * 8 + 4,
      speed: Math.random() * 0.4 + 0.15,
      rot: Math.random() * Math.PI,
      drift: Math.random() * 0.02 - 0.01,
    });
  }

  const drawLeaf = (x, y, size, rot) => {
    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(rot);
    ctx.beginPath();
    ctx.ellipse(0, 0, size, size * 0.5, 0, 0, Math.PI * 2);
    ctx.fillStyle = 'rgba(45, 106, 79, 0.12)';
    ctx.fill();
    ctx.restore();
  };

  const loop = () => {
    ctx.clearRect(0, 0, w, h);
    leaves.forEach(l => {
      l.y -= l.speed;
      l.x += l.drift + Math.sin(t * 0.01 + l.x) * 0.2;
      l.rot += 0.005;
      if (l.y < -20) { l.y = h + 20; l.x = Math.random() * w; }
      drawLeaf(l.x, l.y, l.size, l.rot);
    });
    t++;
    requestAnimationFrame(loop);
  };
  loop();
}

document.addEventListener('DOMContentLoaded', () => {
  initPageLoader();
  initMarquee();
  ir();
});
