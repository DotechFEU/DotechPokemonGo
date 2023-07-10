<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  <!-- Container wrapper -->
  <div class="container">
    <a class="navbar-brand" href="store.php">
        <img
          src="https://seeklogo.com/images/P/pokemon-go-logo-6A54081537-seeklogo.com.png"
          height="60"
          alt="PokemonGo"
          loading="lazy"
        />
    </a>
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarCenteredExample"
      aria-controls="navbarCenteredExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div
      class="collapse navbar-collapse"
      id="navbarCenteredExample"
    >
      <!-- Left links -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="store.php"><i class="fas fa-store"style="color: white;" onmouseover="this.style.color='black'" onmouseout="this.style.color='white'"> Store</i></a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link active" href="cart.php"><i class="fas fa-cart-shopping"style="color: white;" onmouseover="this.style.color='black'" onmouseout="this.style.color='white'"> Cart</i></a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="transactions.php"><i class="fas fa-file-invoice-dollar"style="color: white;" onmouseover="this.style.color='black'" onmouseout="this.style.color='white'"> Transactions</i></a>
        </li>

        <li class="nav-item">
<?php
  if(!$_SESSION['logged']):
?>
          <a class="nav-link active" href="signInUp.php"><i class="fas fa-circle-user"style="color: white;" onmouseover="this.style.color='black'" onmouseout="this.style.color='white'"> Sign In/Up</i></a>

<?php
  else:
?>
          <div class="dropdown">
            <a
              class="nav-link active dropdown-toggle"
              role="button"
              id="dropdownMenuLink"
              data-mdb-toggle="dropdown"
              aria-expanded="false"
              style="color: white;" 
              onmouseover="this.style.color='black'" 
              onmouseout="this.style.color='white'"
            >
            <i class="fas fa-circle-user"> Account</i>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="background-color: #54B4D3;">
              <li><a class="dropdown-item" style="color: white;" onmouseover="this.style.color='black'" onmouseout="this.style.color='white'" href="profile.php"><i class="fas fa-circle-user"> Profile</i></a></li>
              <li><a class="dropdown-item" style="color: white;" onmouseover="this.style.color='red'" onmouseout="this.style.color='white'" href="userSignOut.php"><i class="fas fa-right-from-bracket"> Signout</i></a></li>
            </ul>
          </div>
<?php
  endif;
?>
        </li>
        
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->