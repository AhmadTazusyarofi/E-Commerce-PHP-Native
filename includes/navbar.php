<header class="top-header py-1">
    <div class="d-flex justify-content-between align-items-center">
        <div class="social-icons d-flex align-items-center">
            <a href="#" class=" me-2"><i class="bx bxl-facebook"></i></a>
            <a href="#" class=" me-2"><i class="bx bxs-phone"></i></a>
            <a href="#" class=" me-2"><i class="bx bxl-whatsapp"></i></a>
            <a href="#" class=" me-2"><i class="bx bxl-instagram-alt"></i></a>
            <p class="mb-1 ml-2"> | </p>
            <p class="mb-1 ml-2 text-dark">Follow Us</p>
        </div>
        <div class="contact-info d-flex align-items-center">
            <?php if (isset($_SESSION['pelanggan'])): ?>
            <a href="./pages/logout.php" class="btn btn-sm btn-contact-info font-weight-bold"><i
                    class="bi bi-box-arrow-right mr-2 text-center"></i>Logout</a>
            <a href="../pages/profil.php" id="btn-user"><i class='bx bx-user-circle bx-icon'></i></a>
            <?php else: ?>
            <a href="./pages/login.php" class="btn btn-sm btn-contact-info">Login</a>
            <a href="./pages/daftar.php" class="btn btn-sm btn-contact-info">Daftar</a>
            <?php endif; ?>
        </div>
    </div>
</header>
<!-- nav header start -->
<nav class=" navbar sticky-top">
    <a href="index.php" class="navbar-logo">Fashion-<span>Shop</span></a>

    <div class="navbar-menu">
        <a href="../index.php">Beranda</a>
        <a href="#about">Tentang Kami</a>
        <a href="/pages/produk.php">Produk</a>
        <a href="#kontak">Kontak</a>

    </div>

    <!-- toggle -->
    <div class="navbar-icon">
        <a href="#"><i class="fas fa-search"></i></a>
        <a href="../includes/keranjang.php"><i class="bi bi-cart-dash-fill"></i></a>
        <a href="#" id="btn-menu"><i class="fas fa-bars"></i></a>
    </div>
</nav>
<!-- nav header end -->