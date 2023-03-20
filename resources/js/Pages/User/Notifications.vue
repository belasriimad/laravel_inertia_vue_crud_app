<template>
  <div class="container">
    <div class="row my-4">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <ul v-if="notifications.length" class="list-group">
                        <li v-for="notification in notifications" 
                            :key="notification.id"
                            class="list-group-item d-flex justify-content-between">
                            <span class="fw-bold">
                                Your task <u class="text-danger">{{ notification.data.title }}</u> has been removed by admin.
                            </span>
                            <Link :href="route('read.notification', notification.id)" v-if="!notification.read_at" class="btn btn-sm btn-danger">
                                Mark as read
                            </Link>
                        </li>
                    </ul>
                    <div v-else class="alert alert-info">
                        No notifications!
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script setup>
    import { Link } from "@inertiajs/vue3";

    const props = defineProps({
        notifications: {
            type: Array,
            required: true
        }
    });
</script>

<style>

</style>