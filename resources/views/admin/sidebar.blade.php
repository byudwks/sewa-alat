<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is ('admin*') ? 'active' : '' }}" aria-current="page" href="/admin">
              <span data-feather="home"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is ('orders*') ? 'active' : '' }}" href="/orders">
              <span data-feather="shopping-cart"></span>
              Orders
            </a>
          </li>
        </ul>
      </div>
    </nav>