<template>
    <div class="container">
      <div className='row my-5'>
        <Search />
        <div className="col-md-9">
          <div v-if="$page.props.flash.message" :class="$page.props.flash.class">
            {{ $page.props.flash.message }}
          </div>
          <div className="card">
            <div class="my-2 p-3" v-if="category">
              <h3>Results for category: {{ category.name }}</h3>
              <hr>
            </div>
            <div className="card-body">
              <table className="table">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Body</th>
                          <th>Done</th>
                          <th>By</th>
                          <th>Category</th>
                          <th>Created</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                <tbody>
                  <tr v-for="task in tasks.data" :key="task.id">
                    <td>{{ task.id }}</td>
                    <td>{{ task.title }}</td>
                    <td>{{ task.body }}</td>
                    <td v-if="task.done">
                      <span class="badge bg-success">
                        Done
                      </span>
                    </td>
                    <td v-else>
                      <span class="badge bg-danger">
                        Processing...
                      </span>
                    </td>
                    <td>{{ task.user.name }}</td>
                    <td>{{ task.category.name }}</td>
                    <td>{{ task.created_at }}</td>
                    <td class="d-flex justify-content-between align-items-center">
                      <Link class="btn btn-sm btn-warning"
                          :href="route('tasks.edit', task)" method="get">
                          <i class="fas fa-edit"></i>
                      </Link>
                      <Link class="btn btn-sm btn-danger mx-2"
                          as="button"
                          :href="route('tasks.destroy', task)" method="delete">
                          <i class="fas fa-trash"></i>
                      </Link>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div className="my-4 d-flex justify-content-center">
                  <ul className="pagination">
                      <li v-for="(link, index) in tasks.links" :key="index" 
                          :class="`page-item ${link.active ? 'active' : ''}`">
                          <Link
                              v-if="link.url !== null"
                              :href="link.url"
                              className="page-link"
                              v-dompurify-html="link.label">
                          </Link>
                          <div
                              v-else
                              className="page-link"
                              v-dompurify-html="link.label">
                          </div>
                      </li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
        <div className="col-md-3">
          <Category :categories="categories" />
          <Order />
        </div>
      </div>
    </div>
</template>

<script setup>
  import { Link } from '@inertiajs/vue3'; 
  import Category from '@/Components/Category.vue';
  import Order from '@/Components/Order.vue';
  import Search from '@/Components/Search.vue';

  const props = defineProps({
    tasks: {
      type: Object,
      required: true
    },
    categories: {
      type: Array,
      required: true
    },
    category: {
      type: Object,
      required: false
    }
  });
</script>

<style scoped>
  select.filter__by__select {
    font-family: 'FontAwesome', 'sans-serif';
    font-size: 12px;
  }
</style>