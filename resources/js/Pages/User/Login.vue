<template>
    <div class="container">
        <div className="row my-5">
            <div className="col-md-6 mx-auto">
                <div v-if="failed" class="text-white bg-danger p-2 rounded my-2">{{ failed }}</div>
                <div className="card">
                    <div className="card-header bg-white">
                        <h5 className="text-center mt-2">
                            Login
                        </h5>
                    </div>
                    <div className="card-body">
                        <form @submit.prevent="auth" className="mt-5">
                            <div className="mb-3">
                                <label htmlFor="email" className="form-label">Email*</label>
                                <input 
                                    type="text" 
                                    v-model="form.email"
                                    className="form-control" 
                                    placeholder="Email*">
                                <div v-if="form.errors.email" class="text-white bg-danger p-2 rounded my-2">{{ form.errors.email }}</div>
                            </div>
                            <div className="mb-3">
                                <label htmlFor="password" className="form-label">Password*</label>
                                <input 
                                    type="password" 
                                    v-model="form.password"
                                    className="form-control" 
                                    placeholder="Password*">
                                <div v-if="form.errors.password" class="text-white bg-danger p-2 rounded my-2">{{ form.errors.password }}</div>
                            </div>
                            <div className="mb-3">
                                <button
                                    type="submit" 
                                    className="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { useForm } from "@inertiajs/vue3";

    const form = useForm({
        email: '',
        password: '',
    });

    const props = defineProps({
        failed: {
            type: String,
            required: false
        }
    });

    const auth = () => {
        form.post(route('login'));
    }
</script>

<style>

</style>