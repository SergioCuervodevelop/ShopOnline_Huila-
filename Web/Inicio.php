<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopOnline Huila</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="Style/Inicio.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container">

        <a class="navbar-brand fw-bold" href="#">
            ShopOnline Huila
        </a>

        <!-- Buscador -->
        <form class="d-flex w-50">
            <input class="form-control me-2"
            type="search"
            placeholder="Buscar productos...">

            <button class="btn btn-light" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

        <!-- Botones -->
        <div class="d-flex gap-3">

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
</nav>

<!-- HERO -->
<section class="hero-section">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">
                <h1 class="hero-title">
                    Las mejores ofertas del momento
                </h1>

                <p class="hero-text">
                    Compra productos increíbles al mejor precio.
                </p>

                <button class="btn hero-btn">
                    Comprar ahora
                </button>
            </div>

            <div class="col-lg-6 text-center">

                <img src="https://cdn-icons-png.flaticon.com/512/3144/3144456.png"
                class="hero-img">

            </div>

        </div>

    </div>

</section>

<!-- CATEGORÍAS -->
<section class="container my-5">

    <h2 class="section-title">
        Categorías
    </h2>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="category-card">
                <i class="bi bi-phone"></i>
                <h5>Tecnología</h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="category-card">
                <i class="bi bi-bag"></i>
                <h5>Moda</h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="category-card">
                <i class="bi bi-house"></i>
                <h5>Hogar</h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="category-card">
                <i class="bi bi-controller"></i>
                <h5>Gaming</h5>
            </div>
        </div>

    </div>

</section>

<!-- PRODUCTOS -->
<section class="container my-5">

    <h2 class="section-title">
        Productos destacados
    </h2>

    <div class="row g-4">

        <!-- PRODUCTO -->
        <div class="col-md-3">

            <div class="product-card">

                <span class="offer-badge">
                    -20%
                </span>

                <img src="https://m.media-amazon.com/images/I/61CGHv6kmWL.jpg"
                class="product-img">

                <h5 class="product-title">
                    Audífonos Gamer
                </h5>

                <p class="product-price">
                    $120.000
                </p>

                <button class="btn product-btn">
                    Agregar al carrito
                </button>

            </div>

        </div>

        <!-- PRODUCTO -->
        <div class="col-md-3">

            <div class="product-card">

                <img src="https://m.media-amazon.com/images/I/61LtuGzXeaL.jpg"
                class="product-img">

                <h5 class="product-title">
                    Smartwatch
                </h5>

                <p class="product-price">
                    $180.000
                </p>

                <button class="btn product-btn">
                    Agregar al carrito
                </button>

            </div>

        </div>

        <!-- PRODUCTO -->
        <div class="col-md-3">

            <div class="product-card">

                <img src="https://m.media-amazon.com/images/I/61Qe0euJJZL.jpg"
                class="product-img">

                <h5 class="product-title">
                    Mouse RGB
                </h5>

                <p class="product-price">
                    $65.000
                </p>

                <button class="btn product-btn">
                    Agregar al carrito
                </button>

            </div>

        </div>

        <!-- PRODUCTO -->
        <div class="col-md-3">

            <div class="product-card">

                <img src="https://m.media-amazon.com/images/I/71Y9Xx6tA9L.jpg"
                class="product-img">

                <h5 class="product-title">
                    Teclado Mecánico
                </h5>

                <p class="product-price">
                    $210.000
                </p>

                <button class="btn product-btn">
                    Agregar al carrito
                </button>

            </div>

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="footer">

    <div class="container text-center">

        <h4>
            ShopOnline Huila
        </h4>

        <p>
            Tu tienda online favorita
        </p>

        <div class="social-icons">

            <i class="bi bi-facebook"></i>
            <i class="bi bi-instagram"></i>
            <i class="bi bi-twitter-x"></i>

        </div>

    </div>

</footer>

</body>
</html>