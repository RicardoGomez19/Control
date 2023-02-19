import { createRouter, createWebHistory } from 'vue-router'
import EmployeeLayout from './Layouts/EmployeeLayout.vue'
import { EmployeeLayoutChildrens } from './Layouts/EmployeeLayoutChildren'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: EmployeeLayout,
      children: EmployeeLayoutChildrens
    },
  ]
})

export default router
