<template>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
            <SidebarHeader/>
            <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <NavItem :label="item.label" :icon="item.icon" :href="item.href" v-for="item in $page.props.menu" :key="item.href"/>
            </ul>
            </div>
        </aside>
</template>
