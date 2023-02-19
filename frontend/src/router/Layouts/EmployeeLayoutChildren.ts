import CheckView from "@/views/CheckView.vue";
import type { RouteRecordRaw } from "vue-router";

export const EmployeeLayoutChildrens: RouteRecordRaw[] = [
    {
        path: '',
        name: "Check",
        component: CheckView,
    },
]