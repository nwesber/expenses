<style scoped>
  tbody > tr:hover{
    background:#bfbfbf52;
    cursor: pointer;
  }
</style>

<template>
<div>
    <div class="alert alert-danger" v-if="has_error">
        <p>Error, unable to retrieve the category list.</p>
    </div>

    <div class="d-flex w-100 justify-content-end ">
        <button class="btn btn-primary" @click="create">Create Category</button>
    </div>

    <table class="table table-hover my-2">
        <thead>
          <tr>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            <th scope="col">Date Created</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" v-bind:key="category.id" style="margin-bottom: 5px;" @click="show(category)">
            <td>{{ category.name }}</td>
            <td>{{ category.description }}</td>
            <td>{{ category.created_at}}</td>
          </tr>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">Date Created</th>
            </tr>
        </tfoot>
    </table>


    <div id="updateModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticName" v-model="category.name" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticEmail" v-model="category.description" required>
                </div>
              </div>



            </form>
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-danger" @click="destroy">Delete</button>
            <div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="update">Update</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="createModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticName" v-model="category.name" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticEmail" v-model="category.description" required>
                </div>
              </div>



            </form>
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="store">Save</button>
          </div>
        </div>
      </div>
    </div>



</div>
</template>
<script>
  export default {
    data() {
      return {
        has_error: false,
        categories: null,
        category:{
            name: '',
            description: ''
        },
        errors: {}
      }
    },
    mounted() {
      this.getCategories()
    },
    methods: {
      getCategories() {
        this.$http({
          url: `categories`,
          method: 'GET'
        })
          .then((res) => {
            this.categories = res.data.categories
          }, () => {

          })
      },

      create(){
        this.category = {}
        $('#createModal').modal('toggle')
      },

      show(data){
        this.category = data;
        $('#updateModal').modal('toggle')
      },

      store(){
        this.$http({
          url: `categories`,
          method: 'POST',
          data: this.category
        })
          .then((res) => {
            $('#createModal').modal('toggle')
            this.getCategories()
          }, (err) => {
            console.log(err)
          })
      },

      update(){
        this.$http({
          url: `categories`,
          method: 'PUT',
          data: this.category
        })
          .then((res) => {
            $('#updateModal').modal('toggle')
            this.getCategories()
          }, () => {
            console.log('errors')
          })
      },

      destroy(){
        this.$http({
          url: `categories`,
          method: 'DELETE',
          data: this.category
        })
          .then((res) => {
            $('#updateModal').modal('toggle')
            this.getCategories()
          }, () => {
            console.log('errors')
          })
      }
    }
  }
</script>
