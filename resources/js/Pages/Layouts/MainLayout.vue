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
            </div>
        </div>
    </nav>
    <slot></slot>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'; 
</script>

<style>

</style>