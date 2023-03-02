<template>
    <div className="row my-3">
        <div className="col-md-4">
            <form @submit.prevent="searchTasks">
                <div class="d-flex align-items-center">
                    <div className="form-group">
                        <input type="text"
                            v-model="form.term"
                            placeholder="Search..."
                            className="form-control border border-dark" />
                    </div>
                    <div class="form-group mx-1">
                        <button type="submit" class="btn btn-sm btn-primary"
                            :disabled="!form.term">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
    import { useForm } from "@inertiajs/vue3";

    const form = useForm({
        term: ''
    });

    const searchTasks = () => {
        form.get(route('search.tasks'));
    }
</script>

<style>

</style>