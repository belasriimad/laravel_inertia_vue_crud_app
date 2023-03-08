<template>
  <div class="container">
    <div v-if="$page.props.flash.message" :class="`my-3 ${$page.props.flash.class}`">
      {{ $page.props.flash.message }}
    </div>
    <div v-if="form.errors.photo_url" class="text-white bg-danger p-2 rounded my-2">{{ form.errors.photo_url }}</div>
    <div class="row d-flex justify-content-center my-5">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body d-flex flex-column align-items-center">
            <img :src="user.image" alt="Profile Image" class="img-fluid rounded">
            <form @submit.prevent="uploadFile">
              <div class="mt-3">
                <label for="formFile" class="form-label">Change profile image</label>
                <input class="form-control" @input="setPhotoUrl" type="file" id="formFile">
              </div>
              <div class="mt-3">
                <button type="submit" class="btn btn-sm btn-primary" :disabled="!form.photo_url">
                  Submit
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item">
                <span class="fw-bold">Username:</span> {{ user.name }}
              </li>
              <li class="list-group-item">
                <span class="fw-bold">Email:</span> {{ user.email }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
    import { useForm, usePage } from '@inertiajs/vue3';
    import { computed, reactive } from 'vue';

    const user = computed(() => usePage().props.auth.user);

    const form = useForm({
      photo_url: ''
    });

    const setPhotoUrl = (e) => {
      form.photo_url = e.target.files[0];
    }

    const uploadFile = () => {
      form.post(route('profile'), {
        onSuccess : () => form.reset('photo_url')
      });
    }
</script>

<style>

</style>