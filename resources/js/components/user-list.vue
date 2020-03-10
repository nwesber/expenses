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
    <table class="table table-hover my-2">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Date Created</th>
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
    </table>


    <div id="myModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
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
                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="staticName" v-model="user.name">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="staticEmail" v-model="user.email">
                </div>
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="staticEmail" v-model="user.role">
                </div>
              </div>
 
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        user: {},
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
      show(data){
        this.user = data;
        $('#myModal').modal('toggle')
      }
    }
  }
</script>