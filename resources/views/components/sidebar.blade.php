<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-soap"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Lavera Clean</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <x-menu title="Dashboard" url="dashboard" icon="fas fa-tachometer-alt" />

    <!-- Divider -->
    <hr class="sidebar-divider">
@if (Auth::user()->role === 'admin')
<x-menu title="Data Customer" url="customer" icon="fas fa-users" />

<x-menu title="Data Paket Cucian" url="paket" icon="fas fa-box-open" />

<x-menu title="Data Outlet" url="outlet" icon="	fas fa-store" />

<x-menu title="Data Transaksi" url="transaksi" icon="fas fa-file-invoice" />

<x-menu title="Data Pegawai" url="user" icon="fas fa-user" />



@elseif (Auth::user()->role === 'kasir')

<x-menu title="Data Customer" url="customer" icon="fas fa-users" />

<x-menu title="Data Transaksi" url="transaksi" icon="fas fa-file-invoice" />

@endif
<x-menu title="Logout" url="logout" icon="fas fa-sign-out-alt" />







    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
