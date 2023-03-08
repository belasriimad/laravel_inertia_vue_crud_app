<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <Link class="navbar-brand" href="/">Laravel Vue CRUD App</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <Link class="nav-link" aria-current="page"
                            href="/"><i class="fas fa-home"></i> Home</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" href="/tasks/create"><i class="fas fa-edit"></i> Create Task</Link>
                    </li>
                </ul>
                <ul v-if="!user" class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <Link class="nav-link" aria-current="page"
                            :href="route('login')"><i class="fas fa-sign-in"></i> Login</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :href="route('register')"><i class="fas fa-user-plus"></i> Register</Link>
                    </li>
                </ul>
                <ul v-else class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <Link class="nav-link" aria-current="page"
                            :href="route('profile')"><i class="fas fa-user"></i> {{ user.name }}</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link border-0 bg-white" method="post" as="button" :href="route('logout')"><i class="fas fa-sign-out"></i> Logout</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <slot></slot>
</template>

<script setup>
    import { Link, usePage } from '@inertiajs/vue3'; 
    import { computed } from 'vue';

    const user = computed(() => usePage().props.auth.user);
</script>

<style>

</style>