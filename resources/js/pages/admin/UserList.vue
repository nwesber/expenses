<template>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-baseline justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
            <p>User List</p>
        </div>

        <div class="card card-default mt-2">
            <div class="card-body">
                <userList></userList>
            </div>
        </div>
    </div>
</template>
<script>
  import userList from '../../components/user-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      userList
    }
  }
</script>