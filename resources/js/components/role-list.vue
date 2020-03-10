<style scoped>
  tbody > tr:hover{
    background:#bfbfbf52;
    cursor: pointer;
  }
</style>

<template>
<div>
    <div class="alert alert-danger" v-if="has_error">
        <p>Error, unable to retrieve the role list.</p>
    </div>

    <div class="d-flex w-100 justify-content-end ">
        <button class="btn btn-primary" @click="create">Create Role</button>
    </div>

    <table class="table table-hover my-2">
        <thead>
          <tr>
            <th scope="col">Role</th>
            <th scope="col">Description</th>
            <th scope="col">Date Created</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="role in roles" v-bind:key="role.id" style="margin-bottom: 5px;" @click="show(role)">
            <td>{{ role.name }}</td>
            <td>{{ role.description }}</td>
            <td>{{ role.created_at}}</td>
          </tr>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">Role</th>
                <th scope="col">Description</th>
                <th scope="col">Date Created</th>
            </tr>
        </tfoot>
    </table>


    <div id="updateModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticName" v-model="role.name" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticEmail" v-model="role.description" required>
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
            <h5 class="modal-title">Create Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticName" v-model="role.name" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticEmail" v-model="role.description" required>
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
        roles: null,
        role:{
            name: '',
            description: ''
        },
        errors: {}
      }
    },
    mounted() {
      this.getRoles()
    },
    methods: {
      getRoles() {
        this.$http({
          url: `roles`,
          method: 'GET'
        })
          .then((res) => {
            this.roles = res.data.roles
          }, () => {

          })
      },

      create(){
        this.role = {}
        $('#createModal').modal('toggle')
      },

      show(data){
        this.role = data;
        $('#updateModal').modal('toggle')
      },

      store(){
        this.$http({
          url: `roles`,
          method: 'POST',
          data: this.role
        })
          .then((res) => {
            $('#createModal').modal('toggle')
            this.getRoles()
          }, (err) => {
            console.log(err)
          })
      },

      update(){
        this.$http({
          url: `roles`,
          method: 'PUT',
          data: this.role
        })
          .then((res) => {
            $('#updateModal').modal('toggle')
            this.getRoles()
          }, () => {
            console.log('errors')
          })
      },

      destroy(){
        this.$http({
          url: `roles`,
          method: 'DELETE',
          data: this.role
        })
          .then((res) => {
            $('#updateModal').modal('toggle')
            this.getRoles()
          }, () => {
            console.log('errors')
          })
      }
    }
  }
</script>
