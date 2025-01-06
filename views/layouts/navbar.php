<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?page=landing">AWAY!</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link <?= $page === 'accommodations' ? 'active' : '' ?>" href="index.php?page=accommodations">Accommodations</a>
        <a class="nav-link <?= $page === 'dashboard' ? 'active' : '' ?>" href="index.php?page=dashboard">Profile</a>
        <!-- <a class="nav-link <?= $page === 'register' ? 'active' : '' ?>" href="index.php?page=register">Register</a> -->
        <!-- <a class="nav-link <?= $page === 'login' ? 'active' : '' ?>" href="index.php?page=login">Log In</a> -->
        <a class="nav-link <?= $page === 'logout' ? 'active' : '' ?>" href="index.php?page=logout">Log Out</a>
      </div>
    </div>
  </div>
</nav>
