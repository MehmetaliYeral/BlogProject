<div class="app-sidebar">
    <div class="logo">
        <a href="index.html" class="logo-icon"><span class="logo-text">Petite Blog</span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="#">
                <img src="{{ asset("assets/admin/images/avatars/avatar.png") }}">
                <span class="activity-indicator"></span>
                <span class="user-info-text">Chloe<br><span class="user-state-info">On a call</span></span>
            </a>
        </div>
    </div>
    <div class="app-menu">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Apps
            </li>
            <li class="active-page">
                <a href="{{ route("home") }}" class="{{ Route::is("home") ? "active" : "" }}">
                    <i class="material-icons-two-tone">dashboard</i>
                    Dashboard
                </a>
            </li>

                        <li>
                <a href="{{ route("userlist") }}">
                    <i class="fas fa-users"></i> User List
                </a>
            </li>

            <li>
                        <a href="#" class=" {{ Route::is("article.index") || Route::is("article.create") ? "active" : "" }}">
                            <i class="material-icons">tune</i>Article Man.
                            <i class="material-icons has-sub-menu">keyboard_arrow_right</i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route("article.create") }}">Add an article</a>
                            </li>
                            <li>
                                <a href="{{ route("article.index") }}">Article list</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class=" {{ Route::is("category.index") || Route::is("category.create") ? "active" : "" }}">
                            <i class="material-icons">tune</i>Category Man.
                            <i class="material-icons has-sub-menu">keyboard_arrow_right</i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route("category.create") }}">Add an category</a>
                            </li>
                            <li>
                                <a href="{{ route("category.index") }}">Category list</a>
                            </li>
                        </ul>
                    </li>  
        </ul>
    </div>
</div>