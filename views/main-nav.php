<nav class="navbar navbar-expand navbar-dark bg-dark" style="margin-bottom: 80px">
    <div class="container">
        <!-- Brand -->
        <a href="dashboard.php" class="navbar-brand">
            The Company
        </a>

        <!-- Links -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a href="#" class="nav-link"><?= $_SESSION['user'] ?></a></li>
            <li class="nav-item"><a href="sign-in.php" class="nav-link text-danger">Logout</a></li>
        </ul>
    </div>
</nav>