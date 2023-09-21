<template>
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">

        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><Link class="opacity-5 text-dark" href="/dashboard" >Home</Link></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page" style="text-transform: capitalize;">{{$page.url.substring(1,)}}</li>
          </ol>
          <h6 class="font-weight-bolder mb-0"  style="text-transform: capitalize;" >{{$page.props.user.type}} - {{$page.url.substring(1,).split('-').join(' ')}}</h6>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <NavSearch></NavSearch>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>

            <!-- <NavNotification /> -->
            <li class="nav-item d-flex align-items-center">
              <Link :href="$page.props.auth ? 'logout': 'login'" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none" v-text="$page.props.auth ? 'LOGOUT' : 'LOGIN'"></span>
              </Link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</template>
