{{-- <style>
    .nav-item{
        font-size: 18px;
    }
    .nav-link{
        padding:2px;
    }
    .nav-treeview .nav-item{
        font-size: 16px;
    }
</style> --}}

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('backend/adminlte/dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image">
      <span class="brand-text font-weight-bold">PHARMA-AID</span>
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
                    <li class="nav-item" >
                        <a href="{{route('storelocation.home')}}" class="nav-link {{ Route::currentRouteName() == 'storelocation.home'||Route::currentRouteName() == 'storelocation.create'||Route::currentRouteName() == 'storelocation.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Store Location</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('manufacturer.home')}}" class="nav-link {{ Route::currentRouteName() == 'manufacturer.home'||Route::currentRouteName() == 'manufacturer.create'||Route::currentRouteName() == 'manufacturer.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Manufacturer</p>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{route('supplier.home')}}" class="nav-link {{ Route::currentRouteName() == 'supplierS.home'||Route::currentRouteName() == 'supplierS.create'||Route::currentRouteName() == 'supplierS.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Supplier</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('producttype.home')}}" class="nav-link {{ Route::currentRouteName() == 'producttype.home'||Route::currentRouteName() == 'producttype.create'||Route::currentRouteName() == 'producttype.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Product Type</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('productcategory.home')}}" class="nav-link {{ Route::currentRouteName() == 'productcategory.home'||Route::currentRouteName() == 'productcategory.create'||Route::currentRouteName() == 'productcategory.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Product Category</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('productsubcategory.home')}}" class="nav-link {{ Route::currentRouteName() == 'productsubcategory.home'||Route::currentRouteName() == 'productsubcategory.create'||Route::currentRouteName() == 'productsubcategory.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Product Sub Categories</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('medicineusage.home')}}" class="nav-link {{ Route::currentRouteName() == 'medicineusage.home'||Route::currentRouteName() == 'medicineusage.create'||Route::currentRouteName() == 'medicineusage.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Medicine Usage</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('medecine.home')}}" class="nav-link {{ Route::currentRouteName() == 'medecine.home'||Route::currentRouteName() == 'medecine.create'||Route::currentRouteName() == 'medecine.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Medecines</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('otherproducts.home')}}" class="nav-link {{ Route::currentRouteName() == 'otherproducts.home'||Route::currentRouteName() == 'otherproducts.create'||Route::currentRouteName() == 'otherproducts.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Other Products</p>
                        </a>
                    </li>
                </ul>
            </li>
             <!-- Demand Note Management -->
            <li class="nav-item ">
                <a href="#" class="nav-link">
               <i class="nav-icon fas fa-clipboard"></i>
                <p>Demand Note
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item" >
                        <a href="{{route('storelocation.home')}}" class="nav-link {{ Route::currentRouteName() == 'storelocation.home'||Route::currentRouteName() == 'storelocation.create'||Route::currentRouteName() == 'storelocation.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Demand Note</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('manufacturer.home')}}" class="nav-link {{ Route::currentRouteName() == 'manufacturer.home'||Route::currentRouteName() == 'manufacturer.create'||Route::currentRouteName() == 'manufacturer.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Demand Note Receive</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('producttype.home')}}" class="nav-link {{ Route::currentRouteName() == 'producttype.home'||Route::currentRouteName() == 'producttype.create'||Route::currentRouteName() == 'producttype.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Product Type</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('productcategory.home')}}" class="nav-link {{ Route::currentRouteName() == 'productcategory.home'||Route::currentRouteName() == 'productcategory.create'||Route::currentRouteName() == 'productcategory.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Product Category</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('productsubcategory.home')}}" class="nav-link {{ Route::currentRouteName() == 'productsubcategory.home'||Route::currentRouteName() == 'productsubcategory.create'||Route::currentRouteName() == 'productsubcategory.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Product Sub Categories</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('medicineusage.home')}}" class="nav-link {{ Route::currentRouteName() == 'medicineusage.home'||Route::currentRouteName() == 'medicineusage.create'||Route::currentRouteName() == 'medicineusage.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Medicine Usage</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('medecine.home')}}" class="nav-link {{ Route::currentRouteName() == 'medecine.home'||Route::currentRouteName() == 'medecine.create'||Route::currentRouteName() == 'medecine.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Medecines</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('otherproducts.home')}}" class="nav-link {{ Route::currentRouteName() == 'otherproducts.home'||Route::currentRouteName() == 'otherproducts.create'||Route::currentRouteName() == 'otherproducts.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Other Products</p>
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
                        <a href="{{route('stockentry.home')}}" class="nav-link {{ Route::currentRouteName() == 'stockentry.home'||Route::currentRouteName() == 'stockentry.create'||Route::currentRouteName() == 'stockentry.edit' ? 'active' : ''}}" >
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
                        <a href="{{route('stockentrysummary.home')}}" class="nav-link {{ Route::currentRouteName() == 'stockentrysummary.home'||Route::currentRouteName() == 'stockentrysummary.create'||Route::currentRouteName() == 'stockentrysummary.edit' ? 'active' : ''}}" >
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
