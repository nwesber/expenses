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
        <button class="btn btn-primary" @click="create">Create Expense</button>
    </div>

    <table class="table table-hover my-2">
        <thead>
          <tr>
            <th scope="col">Category</th>
            <th scope="col">Amount</th>
            <th scope="col">Entry Date</th>
            <th scope="col">Created At</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="expense in expenses" v-bind:key="expense.id" style="margin-bottom: 5px;" @click="show(expense)">
            <td>{{ expense.category.name }}</td>
            <td>{{ expense.amount }}</td>
            <td>{{ expense.entry_date }}</td>
            <td>{{ expense.created_at }}</td>
          </tr>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">Category</th>
                <th scope="col">Amount</th>
                <th scope="col">Entry Date</th>
                <th scope="col">Created At</th>
            </tr>
        </tfoot>
    </table>


    <div id="updateModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Expense</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                        <select class="form-control" v-model="expense.expense_category_id">
                            <option v-for="category in categories" v-bind:key="category.id" v-bind:value="category.id">{{ category.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Amount</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" class="form-control" id="staticName" v-model="expense.amount" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Entry Date</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="staticEmail" v-model="expense.entry_date" required>
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
            <h5 class="modal-title">Create Expense</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                        <select class="form-control" v-model="expense.expense_category_id">
                            <option v-for="category in categories" v-bind:key="category.id" v-bind:value="category.id">{{ category.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Amount</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" class="form-control" id="staticName" v-model="expense.amount" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Entry Date</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="staticEmail" v-model="expense.entry_date" required>
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
        expenses: null,
        categories: null,
        expense:{
            expense_category_id: '',
            amount: '',
            entry_date: '',
        },
        errors: {}
      }
    },
    mounted() {
      this.getExpenses()
    },
    methods: {
      getExpenses() {
        this.$http({
          url: `expenses`,
          method: 'GET'
        })
          .then((res) => {
            this.expenses = res.data.expenses
          }, () => {

          })

        
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
        this.expense = {}
        $('#createModal').modal('toggle')
      },

      store(){
        this.$http({
          url: `expenses`,
          method: 'POST',
          data: this.expense
        })
          .then((res) => {
            $('#createModal').modal('toggle')
            this.getExpenses()
          }, (err) => {
            console.log(err)
          })
      },

      show(data){
        this.expense = data;
        $('#updateModal').modal('toggle')
      },

      update(){
        this.$http({
          url: `expenses`,
          method: 'PUT',
          data: this.expense
        })
          .then((res) => {
            $('#updateModal').modal('toggle')
            this.getExpenses()
          }, () => {
            console.log('errors')
          })
      },

      destroy(){
        this.$http({
          url: `expenses`,
          method: 'DELETE',
          data: this.expense
        })
          .then((res) => {
            $('#updateModal').modal('toggle')
            this.getExpenses()
          }, () => {
            console.log('errors')
          })
      }

      
    }
  }
</script>
