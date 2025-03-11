<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('backend/adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image" style="background:white">
      <span class="brand-text font-weight-light">PHARMA-AID</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="{{asset('backend/adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Application Setup -->
            <li class="nav-item ">
                <a href="#" class="nav-link">
                <i class="nav-icon fab fa-app-store"></i>
                <p>Application Setup
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('store.home')}}" class="nav-link {{ Route::currentRouteName() == 'store.home'||Route::currentRouteName() == 'store.create'||Route::currentRouteName() == 'store.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Stores</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('manufacturer.home')}}" class="nav-link {{ Route::currentRouteName() == 'manufacturer.home'||Route::currentRouteName() == 'manufacturer.create'||Route::currentRouteName() == 'manufacturer.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Manufacturer</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('medecine.home')}}" class="nav-link {{ Route::currentRouteName() == 'medecine.home'||Route::currentRouteName() == 'medecine.create'||Route::currentRouteName() == 'medecine.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Medecines</p>
                        </a>
                    </li>
                </ul>
            </li>
             <!-- Stock Management Setup -->
             <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon far fa-sticky-note"></i>
                <p>Stock Management
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('medecinestock.home')}}" class="nav-link {{ Route::currentRouteName() == 'medecinestock.home'||Route::currentRouteName() == 'medecinestock.create'||Route::currentRouteName() == 'medecinestock.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Stock Entry</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('stockmedecine.home')}}" class="nav-link {{ Route::currentRouteName() == 'stockmedecine.home'||Route::currentRouteName() == 'stockmedecine.create'||Route::currentRouteName() == 'stockmedecine.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Store</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('stockentry.home')}}" class="nav-link {{ Route::currentRouteName() == 'stockentry.home'||Route::currentRouteName() == 'stockentry.create'||Route::currentRouteName() == 'stockentry.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Stock Entry Report</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Stock Management Setup -->
            <li class="nav-item">
                            <a href="#" class="nav-link">
                            <!-- <i class="nav-icon far fa-sticky-note"></i> -->
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>Sales Management
                                <i class="fas fa-angle-left right"></i>

                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item " >
                                    <a href="{{route('sales.home')}}" class="nav-link {{ Route::currentRouteName() == 'sales.home'||Route::currentRouteName() == 'sales.create'||Route::currentRouteName() == 'sales.edit' ? 'active' : ''}}" >
                                        <i class="nav-icon fas fa-angle-double-right"></i>
                                        <p>Sale Entry</p>
                                    </a>
                                </li>
                                <li class="nav-item " >
                                    <a href="{{route('stockmedecine.home')}}" class="nav-link {{ Route::currentRouteName() == 'stockmedecine.home'||Route::currentRouteName() == 'stockmedecine.create'||Route::currentRouteName() == 'stockmedecine.edit' ? 'active' : ''}}" >
                                        <i class="nav-icon fas fa-angle-double-right"></i>
                                        <p>Store</p>
                                    </a>
                                </li>
                                <li class="nav-item " >
                                    <a href="{{route('stockentry.home')}}" class="nav-link {{ Route::currentRouteName() == 'stockentry.home'||Route::currentRouteName() == 'stockentry.create'||Route::currentRouteName() == 'stockentry.edit' ? 'active' : ''}}" >
                                        <i class="nav-icon fas fa-angle-double-right"></i>
                                        <p>Stock Entry Report</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
          <!-- Log Out Button Start -->
          <li class="nav-item">

            <a href="{{route('logout.get')}}" class="nav-link">
            <i class="nav-icon fas fa-sign-in-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          <!-- Log Out Button End -->

        </ul>
      </nav>
    </div>
  </aside>
