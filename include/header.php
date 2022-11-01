<?php
    // load all data to be used 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");
?>

<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo($rootUrl). 'index.php'; ?>">Recipe Site</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo($rootUrl). 'index.php'; ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo($rootUrl). 'contact.php'; ?>">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo($rootUrl). 'recipes/create.php'; ?>">Add A Recipe</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<!-- bootstrap script needed here so navbar toggle functionality will work -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>