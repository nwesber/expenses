<template>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-baseline justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Roles</h1>
            <p>Role List</p>
        </div>

        <div class="card card-default mt-2">
            <div class="card-body">
                <roleList></roleList>
            </div>
        </div>
    </div>
</template>
<script>
  import roleList from '../../components/role-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      roleList
    }
  }
</script>
