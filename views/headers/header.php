<div id="ebazar-layout" class="theme-blue">

    <!-- sidebar -->
    <div class="sidebar px-4 py-4 py-md-4 me-0">
        <div class="d-flex flex-column h-100">
            <a href="/dashboard" class="mb-0 brand-icon">
                    <span class="logo-icon">
                        <i class="bi bi-bag-check-fill fs-4"></i>
                    </span>
                <span class="logo-text">Boosted</span>
            </a>
            <!-- Menu: main ul -->
            <ul class="menu-list flex-grow-1 mt-3">
                <li><a class="m-link" id="dashboard-link" href="/dashboard"><i class="icofont-home fs-5"></i> <span>Dashboard</span></a></li>
                <li class="collapsed">
                    <a class="m-link" id="items-link" data-bs-toggle="collapse" data-bs-target="#menu-product" href="#">
                        <i class="icofont-truck-loaded fs-5"></i> <span>Items & Services</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-product">
                        <li><a class="ms-link" href="/items/add">New</a></li>
                        <li><a class="ms-link" href="/items">Items & Services</a></li>
                        <li><a class="ms-link" href="/items/rooms">Accommodation</a></li>
                    </ul>
                </li>

                <li class="collapsed">
                    <a class="m-link" id="invoices-link" data-bs-toggle="collapse" data-bs-target="#menu-order" href="#">
                        <i class="icofont-notepad fs-5"></i> <span>Invoices</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-order">
                        <li><a class="ms-link" href="/orders/new">New Invoice</a></li>
                        <li><a class="ms-link" href="/orders">Invoices</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link" id="customers-link" data-bs-toggle="collapse" data-bs-target="#customers-info" href="#">
                        <i class="icofont-funky-man fs-5"></i> <span>Customers</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="customers-info">
                        <li><a class="ms-link" href="/customers">Customers List</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link" id="users-link" data-bs-toggle="collapse" data-bs-target="#user-info" href="#">
                        <i class="icofont-chicken-fry fs-5"></i> <span>Users</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="user-info">
                        <li><a class="ms-link" href="/users">Users</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Menu: menu collepce btn -->
            <button type="button" class="btn btn-link sidebar-mini-btn text-light">
                <span class="ms-2"><i class="icofont-bubble-right"></i></span>
            </button>
        </div>
    </div>
    <div class="main px-lg-4 px-md-4">

        <!-- Body: Header -->
        <div class="header">
            <nav class="navbar py-4">
                <div class="container-xxl">
                    <!-- header rightbar icon -->
                    <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">

                        <div class="dropdown notifications">
                            <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="icofont-alarm fs-5"></i>
                                <span class="pulse-ring"></span>
                            </a>
                            <div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-md-end p-0 m-0 mt-3">
                                <div class="card border-0 w380">
                                    <div class="card-header border-0 p-3">
                                        <h5 class="mb-0 font-weight-light d-flex justify-content-between">
                                            <span>Notifications</span>
                                            <span class="badge text-white">00</span>
                                        </h5>
                                    </div>
                                    <div class="tab-content card-body">
                                        <div class="tab-pane fade show active">
                                            <ul class="list-unstyled list mb-0">

                                            </ul>
                                        </div>
                                    </div>
                                    <a class="card-footer text-center border-top-0" href="#"> View all notifications</a>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                            <div class="u-info me-2">
                                <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold"><?=$_SESSION['user']['name']?></span></p>
                                <small><?=$_SESSION['user']['role']?></small>
                            </div>
                            <a class="nav-link dropdown-toggle pulse p-0" href="/dashboard" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                                <img class="avatar lg rounded-circle img-thumbnail" src="/media/blank.jpg" alt="profile">
                            </a>
                            <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                <div class="card border-0 w280">
                                    <div class="card-body pb-0">
                                        <div class="d-flex py-1">
                                            <img class="avatar rounded-circle" src="/media/blank.jpg" alt="profile">
                                            <div class="flex-fill ms-3">
                                                <p class="mb-0"><span class="font-weight-bold"><?=$_SESSION['user']['name']?></span></p>
                                                <small class=""><?=$_SESSION['user']['email']?></small>
                                            </div>
                                        </div>

                                        <div><hr class="dropdown-divider border-dark"></div>
                                    </div>
                                    <div class="list-group m-2 ">
                                        <a href="/logout" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-5 me-3"></i>Signout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- menu toggler -->
                    <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                        <span class="fa fa-bars"></span>
                    </button>
                    <!-- main menu Search-->
                    <div class="order-0 col-lg-8 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">
                        <form action="/items" method="get">
                            <div class="input-group flex-nowrap input-group-lg">
                                <input type="text" class="form-control" name="q" placeholder="Search item" aria-label="search" aria-describedby="addon-wrapping">
                                <button type="submit" class="input-group-text" id="addon-wrapping"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                </div>
            </nav>
        </div>


