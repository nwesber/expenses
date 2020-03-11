<template>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-baseline justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Expenses</h1>
            <p>Expenses List</p>
        </div>

        <div class="card card-default mt-2">
            <div class="card-body">
                <categoriesList></categoriesList>
            </div>
        </div>
    </div>
</template>
<script>
  import categoriesList from '../../components/categories-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      categoriesList
    }
  }
</script>
