import { ref } from "vue"

export type CheckMode = "Entrada" | "Salida"
const mode = ref<CheckMode>("Entrada")

export function useEmployeeLayoutMode() {
    function changeMode() {
        mode.value = mode.value === "Entrada" ? "Salida" : "Entrada"
    }
    return {
        mode,
        changeMode
    }
}