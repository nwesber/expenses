<style scoped>
  tbody > tr:hover{
    background:#bfbfbf52;
    cursor: pointer;
  }
</style>

<template>
<div>
    <div class="alert alert-danger" v-if="has_error">
        <p>Error, unable to retrieve the user list.</p>
    </div>

    <div class="d-flex w-100 justify-content-end ">
        <button class="btn btn-primary" @click="create">Create User</button>
    </div>

    <table class="table table-hover my-2">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Created At</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" v-bind:key="user.id" style="margin-bottom: 5px;" @click="show(user)">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.role.name }}</td>
            <td>{{ user.created_at}}</td>
          </tr>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Created At</th>
            </tr>
        </tfoot>
    </table>


    <div id="updateModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticName" v-model="user.name" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Email Address</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticEmail" v-model="user.email" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Role</label>
                <div class="col-sm-9">
                    <select class="form-control" v-model="user.role_id">
                      <option v-for="role in roles" v-bind:value="role.id">{{ role.name }}</option>

                    </select>
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
            <h5 class="modal-title">Create User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticName" v-model="user.name" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Email Address</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="staticEmail" v-model="user.email" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Role</label>
                <div class="col-sm-9">
                    <select class="form-control" v-model="user.role_id">
                      <option v-for="role in roles" v-bind:value="role.id">{{ role.name }}</option>

                    </select>
                </div>
              </div>

            </form>
          </div>
          <div class="modal-footer">
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
        users: null,
        user: {
            email: '',
            name: '',
            role_id: 1,
        },
        roles: null
      }
    },
    mounted() {
      this.getUsers()
    },
    methods: {
      getUsers() {
        this.$http({
          url: `users`,
          method: 'GET'
        })
            .then((res) => {
              this.users = res.data.users
            }, () => {
              this.has_error = true
            })

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
        this.user = {}
        $('#createModal').modal('toggle')
      },

      store(){
         this.$http({
            url: `users`,
            method: 'POST',
            data: this.user
        })
         .then((resp) => {
            $('#createModal').modal('toggle')
            this.getUsers()
         }, () => {
            console.log('error')
         })
      },

      update(){
        this.$http({
            url: `users`,
            method: 'PUT',
            data: this.user
        })
         .then((resp) => {
            $('#updateModal').modal('toggle')
            this.getUsers()
         }, () => {
            console.log('error')
         })

      },

      destroy(){
        this.$http({
            url: `users`,
            method: 'DELETE',
            data: this.user
        })
         .then((resp) => {
            $('#updateModal').modal('toggle')
            this.getUsers()
         }, () => {
            console.log('error')
         })
      },

      show(data){
        this.user = data;
        $('#updateModal').modal('toggle')
      }
    }
  }
</script>
