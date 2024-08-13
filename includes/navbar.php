<nav class="navbar sticky-top">
    <a href="index.php" class="navbar-logo">E-<span>Commerce</span></a>

    <div class="navbar-menu">
        <a href="../index.php">Beranda</a>
        <a href="#about">Tentang Kami</a>
        <a href="pages/produk.php">Produk</a>
        <a href="#kontak">Kontak</a>

    </div>

    <!-- toggle -->
    <div class="navbar-icon">
        <a href="#"><i class="fas fa-search"></i></a>
        <a href="keranjang.php"><i class="fas fa-shopping-cart"></i></a>
        <a href="#" id="btn-user"><i class="fas fa-user"></i></a>
        <a href="#" id="btn-menu"><i class="fas fa-bars"></i></a>
    </div>

    <div class="user">
        <?php if (isset($_SESSION['pelanggan'])): ?>
        <ul class="list-unstyled mt-3">
            <li><a href="../pages/profil.php">
                    <i class="fas fa-user-plus mb-2 mr-2"></i> Profil
                </a></li>
            <li><a href="./pages/logout.php">
                    <i class="fas fa-sign-in-alt mr-2"></i> Logout
                </a></li>
        </ul>
        <?php else: ?>
        <ul class="list-unstyled mt-3">
            <li><a href="./pages/login.php">
                    <i class="fas fa-sign-in-alt mb-2 mr-2"></i> Login
                </a></li>
            <li><a href="./pages/daftar.php">
                    <i class="fas fa-user-plus mr-2"></i> Daftar
                </a></li>
        </ul>
        <?php endif; ?>

    </div>
</nav>