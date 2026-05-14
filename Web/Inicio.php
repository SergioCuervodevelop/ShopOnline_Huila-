<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopOnline Huila</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">

    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand" href="#">
            <i class="bi bi-bag-heart-fill"></i>
            ShopOnline Huila
        </a>

        <!-- BOTON MOVIL -->
        <button class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#menu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="menu">

            <!-- BUSCADOR -->
            <form class="d-flex mx-auto search-form">

                <input class="form-control search-input"
                type="search"
                placeholder="Buscar productos...">

                <button class="btn search-btn" type="submit">
                    <i class="bi bi-search"></i>
                </button>

            </form>

            <!-- ICONOS -->
            <div class="d-flex align-items-center gap-4">

                <a href="#" class="nav-icon">
                    <i class="bi bi-person-circle"></i>
                </a>

                <a href="#" class="nav-icon position-relative">

                    <i class="bi bi-cart3"></i>

                    <span class="cart-badge">
                        0
                    </span>

                </a>

            </div>

        </div>

    </div>

</nav>

<!-- HERO -->
<section class="hero-section">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <span class="hero-badge">
                    🔥 Ofertas Exclusivas
                </span>

                <h1 class="hero-title">
                    Compra productos increíbles al mejor precio
                </h1>

                <p class="hero-text">
                    Tecnología, moda, gaming y mucho más.
                    Descubre ofertas únicas todos los días.
                </p>

                <button class="btn hero-btn">
                    Comprar ahora
                </button>

            </div>

            <div class="col-lg-6 text-center">

                <img src="https://cdn-icons-png.flaticon.com/512/3514/3514491.png"
                class="hero-img">

            </div>

        </div>

    </div>

</section>

<!-- CATEGORIAS -->
<section class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="section-title">
            Categorías
        </h2>

        <a href="#" class="see-more">
            Ver más
        </a>

    </div>

    <div class="row g-4">

        <div class="col-md-3 col-6">

            <div class="category-card">

                <div class="category-icon">
                    <i class="bi bi-phone"></i>
                </div>

                <h5>Tecnología</h5>

            </div>

        </div>

        <div class="col-md-3 col-6">

            <div class="category-card">

                <div class="category-icon">
                    <i class="bi bi-bag"></i>
                </div>

                <h5>Moda</h5>

            </div>

        </div>

        <div class="col-md-3 col-6">

            <div class="category-card">

                <div class="category-icon">
                    <i class="bi bi-house"></i>
                </div>

                <h5>Hogar</h5>

            </div>

        </div>

        <div class="col-md-3 col-6">

            <div class="category-card">

                <div class="category-icon">
                    <i class="bi bi-controller"></i>
                </div>

                <h5>Gaming</h5>

            </div>

        </div>

    </div>

</section>

<!-- PRODUCTOS -->
<section class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="section-title">
            Productos destacados
        </h2>

        <a href="#" class="see-more">
            Ver todos
        </a>

    </div>

    <div class="row g-4">

        <!-- PRODUCTO -->
        <div class="col-lg-3 col-md-6">

            <div class="product-card">

                <span class="offer-badge">
                    -20%
                </span>

                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1000"
                class="product-img">

                <h5 class="product-title">
                    Audífonos Gamer RGB
                </h5>

                <p class="product-price">
                    $120.000
                </p>

                <button class="btn product-btn">
                    <i class="bi bi-cart-plus"></i>
                    Agregar al carrito
                </button>

            </div>

        </div>

        <!-- PRODUCTO -->
        <div class="col-lg-3 col-md-6">

            <div class="product-card">

                <span class="offer-badge">
                    -15%
                </span>

                <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=1000"
                class="product-img">

                <h5 class="product-title">
                    Smartwatch Pro
                </h5>

                <p class="product-price">
                    $180.000
                </p>

                <button class="btn product-btn">
                    <i class="bi bi-cart-plus"></i>
                    Agregar al carrito
                </button>

            </div>

        </div>

        <!-- PRODUCTO -->
        <div class="col-lg-3 col-md-6">

            <div class="product-card">

                <span class="offer-badge">
                    -10%
                </span>

                <img src="https://images.unsplash.com/photo-1527814050087-3793815479db?q=80&w=1000"
                class="product-img">

                <h5 class="product-title">
                    Mouse Gamer RGB
                </h5>

                <p class="product-price">
                    $65.000
                </p>

                <button class="btn product-btn">
                    <i class="bi bi-cart-plus"></i>
                    Agregar al carrito
                </button>

            </div>

        </div>

        <!-- PRODUCTO -->
        <div class="col-lg-3 col-md-6">

            <div class="product-card">

                <span class="offer-badge">
                    -30%
                </span>

                <img src="https://images.unsplash.com/photo-1517336714739-489689fd1ca8?q=80&w=1000"
                class="product-img">

                <h5 class="product-title">
                    Laptop Ultra HD
                </h5>

                <p class="product-price">
                    $2.500.000
                </p>

                <button class="btn product-btn">
                    <i class="bi bi-cart-plus"></i>
                    Agregar al carrito
                </button>

            </div>

        </div>

    </div>

</section>

<!-- BANNER EXTRA -->
<section class="offer-section">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h2 class="offer-title">
                    Hasta 50% OFF
                </h2>

                <p class="offer-text">
                    Aprovecha nuestras ofertas especiales
                    por tiempo limitado.
                </p>

                <button class="btn offer-btn">
                    Ver ofertas
                </button>

            </div>

            <div class="col-lg-6 text-center">

                <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png"
                class="offer-img">

            </div>

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="footer">

    <div class="container">

        <div class="row">

            <div class="col-md-4">

                <h4 class="footer-title">
                    ShopOnline Huila
                </h4>

                <p>
                    Tu tienda online favorita con las mejores ofertas.
                </p>

            </div>

            <div class="col-md-4">

                <h5 class="footer-subtitle">
                    Enlaces
                </h5>

                <ul class="footer-links">

                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Productos</a></li>
                    <li><a href="#">Categorías</a></li>
                    <li><a href="#">Contacto</a></li>

                </ul>

            </div>

            <div class="col-md-4">

                <h5 class="footer-subtitle">
                    Síguenos
                </h5>

                <div class="social-icons">

                    <i class="bi bi-facebook"></i>
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-twitter-x"></i>
                    <i class="bi bi-tiktok"></i>

                </div>

            </div>

        </div>

        <hr>

        <p class="text-center copyright">
            © 2026 ShopOnline Huila - Todos los derechos reservados
        </p>

    </div>

</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>