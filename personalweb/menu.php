<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">My Web</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link <?php echo $page=='home'?'active':''; ?>" href="index.php?page=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $page=='about'?'active':''; ?>" href="index.php?page=about">About Me</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $page=='contact'?'active':''; ?>" href="index.php?page=contact">Contact Me</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php echo ($page=='level'||$page=='studies')?'active':''; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            My Studies
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?page=level">Level</a></li>
            <li><a class="dropdown-item" href="index.php?page=studies">Studies</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="navbar-nav ms-auto">
        <?php if(isset($_SESSION['user_id'])): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_SESSION['nama']; ?> (<?php echo $_SESSION['role']; ?>)
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link <?php echo $page=='login'?'active':''; ?>" href="index.php?page=login">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
