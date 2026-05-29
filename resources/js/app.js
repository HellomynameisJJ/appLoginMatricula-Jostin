// Fade-in on scroll
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('visible');
    });
}, { threshold: 0.1 });

document.querySelectorAll('.observe').forEach(el => observer.observe(el));

// Auto-dismiss alerts
document.querySelectorAll('.alert[data-dismiss]').forEach(alert => {
    setTimeout(() => {
        alert.style.transition = 'opacity 0.4s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 400);
    }, parseInt(alert.dataset.dismiss) || 4000);
});

// Button loading state on submit
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', () => {
        const btn = form.querySelector('.btn-primary');
        if (btn) { btn.disabled = true; btn.style.opacity = '0.7'; }
    });
});