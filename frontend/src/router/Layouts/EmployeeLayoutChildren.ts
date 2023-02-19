import HomeViewVue from "@/views/HomeView.vue";
import type { RouteRecordRaw } from "vue-router";

export const EmployeeLayoutChildrens: RouteRecordRaw[] = [
    {
        path: '',
        name: "Home",
        component: HomeViewVue
    }
]