import VueRouter from 'vue-router'
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import Dashboard from './pages/user/Dashboard'
import UserList from './pages/admin/UserList'
import RoleList from './pages/admin/RoleList'
import CategoriesList from './pages/admin/CategoriesList'
import ExpenseList from './pages/admin/ExpenseList'

// Routes
const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: undefined
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    // USER ROUTES
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    },
    // ADMIN ROUTES
    {
        path: '/users',
        name: 'admin.users',
        component: UserList,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/403' }
        }
    },
    {
        path: '/roles',
        name: 'admin.roles',
        component: RoleList,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/403' }
        }
    },
    {
        path: '/expense-categories',
        name: 'admin.expense.categories',
        component: CategoriesList,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/403' }
        }
    },

    // global routes
    {
        path: '/expenses',
        name: 'expense.index',
        component: ExpenseList,
        meta: {
            auth: true
        }
    },
]
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})
export default router
