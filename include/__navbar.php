 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> -->
      <ul class="navbar-nav ml-auto">
      <?php session_start() ?>
      <?php if(isset($_SESSION['account'])):?>
        <li class="nav-item">
          <a class="nav-link"><?= "歡迎! " . $_SESSION['account'] ?>
          <!-- session_start();  -->
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">登出</a>
        </li>

        <?php else:?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">登入</a>
        </li>
        <?php endif ?>
      </ul>

    </div>
  </nav>