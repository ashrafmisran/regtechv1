<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">CRSys</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?p=order-48-upload">Order 48</span></a>
      </li>
      <!--li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Upload
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="?p=upload-deposit">Deposit record</a>
          <a class="dropdown-item" href="#">Withdrawal record</a>
          <a class="dropdown-item" href="#">Order record</a>
        </div>
      </li-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Shariah
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Checklist</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Monthly summary</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Compliance
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Checklist</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Monthly summary</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Money-Laundering
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="?p=ml-checklist">Checklist</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Monthly summary</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Setting
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Holiday</a>
          <a class="dropdown-item" href="#">Shariah Compliant Securities List</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="?p=search" method="post">
      <input class="form-control mr-sm-2" type="search" placeholder="Acc/Receipt/Payment" aria-label="Search" name="s">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search record</button>
    </form>
  </div>
</nav>
<hr class="mt-0">