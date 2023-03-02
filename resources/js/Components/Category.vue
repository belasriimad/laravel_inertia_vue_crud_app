<template>
    <div className="card">
        <div className="card-body">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by category
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li>
                        <Link class="dropdown-item" :href="route('home')">All</Link>
                    </li>
                    <li v-for="category in categories" :key="category.id">
                        <Link class="dropdown-item" :href="route('category.tasks', category)">{{ category.name }}</Link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'; 

    const props = defineProps({
        categories: {
            type: Array,
            required: true
        }
    });
</script>

<style>
</style>