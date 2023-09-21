<template>
    <div>
        <Sidebar/>
         <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <Navbar/>
            <div class="container-fluid py-4">
                <slot></slot>
            </div>
        </main>
    </div>
</template>
