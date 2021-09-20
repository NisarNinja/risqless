<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">

        <!-- Main -->
        <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{Request::is('admin/dashboard') ? 'active' : ''}}">
                <i class="icon-home4"></i>
                <span>
					Dashboard
                </span>
            </a>
        </li>
       <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{Request::is(['admin/users','admin/users/*']) ? 'active' : ''}}">
                <i class="icon-user"></i>
                <span>
					User Management
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('posts.index') }}" class="nav-link {{Request::is(['admin/posts','admin/posts/*']) ? 'active' : ''}}">
                <i class="fas fa-sticky-note"></i>
                <span>
                    Blog Post Management
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link {{Request::is(['admin/categories','admin/categories/*']) ? 'active' : ''}}">
                <i class="fa fa-list-alt" aria-hidden="true"></i>
                <span>
                    Category Management
                </span>
            </a>
        </li>
        <br>
        
    </ul>
</div>
