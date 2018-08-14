<nav class="navbar navbar-light bg-light navbar-expand-lg">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/logout">Logout</a>
      </li>
    </ul>
    <form autocomplete="off" class="form-inline my-2 my-lg-0">
      <input name="q" autofocus value="<?=htmlspecialchars($query["q"])?>" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
