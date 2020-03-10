<template>
    <div id="wrapper">


        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

          <router-link :to="{name: 'home'}" class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-text mx-1">Expense Tracker</div>
          </router-link>


          <hr class="sidebar-divider my-0">


          <li class="nav-item active">
              <router-link  :to="{ name : 'home' }" class="nav-link">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span>
              </router-link>
          </li>


          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            Users
          </div>
          <li class="nav-item" v-if="$auth.check(2)">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-users"></i>
              <span>User Management</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <router-link  :to="{ name : route.path }" :key="key" class="collapse-item" v-for="(route, key) in routes.admin" v-bind:key="route.path">
                    {{route.name}}
                </router-link>
              </div>
            </div>
          </li>

          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            Expenses
          </div>
          <li class="nav-item" v-if="$auth.check()">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-coins"></i>
              <span>Expense Management</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded" v-for="(route, key) in routes.admin" v-bind:key="route.path">
                <router-link  :to="{ name : route.path }" :key="key" class="collapse-item">
                    Expense Categories
                </router-link>
              </div>
            </div>
          </li>

        </ul>


        <div id="content-wrapper" class="d-flex flex-column">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
              <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
              </button>

              <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown no-arrow" v-if="$auth.check()">
                  <a href="#" @click.prevent="$auth.logout()">Logout</a>
                </li>

                <li class="nav-item dropdown no-arrow mr-3" v-if="!$auth.check()">
                    <router-link  :to="{ name : 'login' }">
                        Login
                    </router-link>
                </li>

                <li class="nav-item dropdown no-arrow" v-if="!$auth.check()">
                    <router-link  :to="{ name : 'register' }">
                        Register
                    </router-link>
                </li>


              </ul>
            </nav>


            <router-view></router-view>
        </div>
    </div>
</template>
<script>

  export default {
    data() {
      return {
        routes: {
          // UNLOGGED
          unlogged: [
            {
              name: 'Register',
              path: 'register'
            },
            {
              name: 'Login',
              path: 'login'
            }
          ],
          // LOGGED USER
          user: [
            {
              name: 'Dashboard',
              path: 'dashboard'
            }
          ],
          // LOGGED ADMIN
          admin: [
            {
              name: 'Users',
              path: 'admin.users'
            },
            {
                name: 'Roles',
                path: 'admin.roles'
            }
          ]
        }
      }
    },
    components: {

    }
  }
</script>
