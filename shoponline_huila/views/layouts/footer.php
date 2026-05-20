<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Botón volver arriba -->
<script>
(function() {
    var btn = document.createElement('button');
    btn.innerHTML = '<i class="fas fa-arrow-up"></i>';
    btn.style.position = 'fixed';
    btn.style.bottom = '24px';
    btn.style.right = '24px';
    btn.style.width = '44px';
    btn.style.height = '44px';
    btn.style.borderRadius = '12px';
    btn.style.backgroundColor = '#f97316';
    btn.style.color = 'white';
    btn.style.border = 'none';
    btn.style.cursor = 'pointer';
    btn.style.display = 'none';
    btn.style.zIndex = '999';
    btn.style.boxShadow = '0 4px 12px rgba(249,115,22,0.3)';
    btn.style.transition = 'all 0.3s ease';
    btn.style.fontSize = '1.2rem';
    
    btn.onmouseover = function() {
        this.style.transform = 'translateY(-3px)';
        this.style.boxShadow = '0 6px 16px rgba(249,115,22,0.4)';
    };
    btn.onmouseout = function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = '0 4px 12px rgba(249,115,22,0.3)';
    };
    
    btn.onclick = function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };
    
    document.body.appendChild(btn);
    
    window.onscroll = function() {
        if (window.scrollY > 300) {
            btn.style.display = 'block';
        } else {
            btn.style.display = 'none';
        }
    };
})();
</script>

</body>
</html>