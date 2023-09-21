<template>
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" :href="`${$page.props.appUrl}`" target="_blank">
        <SiteLogo />
        <span class="ms-1 font-weight-bold text-white">{{ $page.props.appName }}</span>
      </a>
      <hr class="horizontal light mt-0 mb-2">
    </div>
</template>
