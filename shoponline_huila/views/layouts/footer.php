</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Volver arriba
var btn = document.createElement('button');
btn.innerHTML = '<i class="fas fa-arrow-up"></i>';
btn.style.position = 'fixed';
btn.style.bottom = '20px';
btn.style.right = '20px';
btn.style.width = '45px';
btn.style.height = '45px';
btn.style.borderRadius = '50%';
btn.style.backgroundColor = '#f97316';
btn.style.color = 'white';
btn.style.border = 'none';
btn.style.cursor = 'pointer';
btn.style.display = 'none';
btn.onclick = function() { window.scrollTo({top:0, behavior:'smooth'}); };
document.body.appendChild(btn);
window.onscroll = function() { btn.style.display = window.scrollY > 300 ? 'block' : 'none'; };
</script>
</body>
</html>