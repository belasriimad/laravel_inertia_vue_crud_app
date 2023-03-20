<template>
    <div class="container">
        <div class="row my-3">
            <div class="col-md-6 mx-auto">
                <div v-if="$page.props.flash.message" :class="$page.props.flash.class">
                    {{ $page.props.flash.message }}
                </div>
                <div class="alert alert-primary">
                    Please verify your email to proceed check your email box for verification link.
                </div>
                <Link :href="route('verification.send')" method="post" as="button" class="btn btn-danger">resend verification link</Link>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'; 
</script>

<style>
</style>