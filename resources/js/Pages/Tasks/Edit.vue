<template>
    <div class="container">
        <div className="row my-5">
            <div className="col-md-6 mx-auto">
                <div className="card">
                    <div className="card-header bg-white">
                        <h5 className="text-center mt-2">
                            Edit task
                        </h5>
                    </div>
                    <div className="card-body">
                        <form @submit.prevent="updateTask" className="mt-5">
                            <div className="mb-3">
                                <label htmlFor="title" className="form-label">Title*</label>
                                <input 
                                    type="text" 
                                    v-model="form.title"
                                    className="form-control" 
                                    placeholder="Title*">
                                <div v-if="form.errors.title" class="text-white bg-danger p-2 rounded my-2">{{ form.errors.title }}</div>
                            </div>
                            <div className="mb-3">
                                <label htmlFor="body" className="form-label">Description*</label>
                                <textarea 
                                    className="form-control" 
                                    v-model="form.body"
                                    placeholder="Body*"
                                    rows="3"></textarea>
                                <div v-if="form.errors.body" class="text-white bg-danger p-2 rounded my-2">{{ form.errors.body }}</div>
                            </div>
                            <div className="mb-3">
                                <label htmlFor="category_id" className="form-label">Category*</label>
                                <select v-model="form.category_id" class="form-control">
                                    <option disabled selected value="">Choose a category</option>
                                    <option v-for="category in categories" :key="category.id" 
                                        :value="category.id">{{ category.name }}</option>
                                </select>
                                <div v-if="form.errors.category_id" class="text-white bg-danger p-2 rounded my-2">{{ form.errors.category_id }}</div>
                            </div>
                            <div className="form-check mb-3">
                                <input className="form-check-input" 
                                    v-model="form.done"
                                    type="checkbox" 
                                    :checked="form.done"/>
                                <label className="form-check-label" htmlFor="done">
                                    Done
                                </label>
                            </div>
                            <div className="mb-3">
                                <button
                                    type="submit" 
                                    className="btn btn-primary">
                                    Update
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
        title: props.task.title,
        body: props.task.body,
        category_id: props.task.category_id,
        done: props.task.done
    });

    const props = defineProps({
        categories: {
            type: Array,
            required: true
        },
        task: {
            type: Object,
            required: true
        }
    });

    const updateTask = () => {
        form.put(route(`tasks.update`, props.task.id));
    }
</script>


<style>
</style>