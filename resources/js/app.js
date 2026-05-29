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