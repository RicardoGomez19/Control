import { computed, onMounted, onUnmounted, reactive, ref } from "vue"

type IsNumberKey = { [x: number]: string }
export const enum AMPM {
    AM = "AM",
    PM = "PM"
}
export const enum DaysWeek {
    SUNDAY,
    MONDAY,
    TUESDAY,
    WEDNESDAY,
    THURSDAY,
    FRIDAY,
    SATURDAY,
}
export const enum Months {
    JANUARY,
    FEBRUARY,
    MARCH,
    APRIL,
    MAY,
    JUN,
    JULY,
    AUGUST,
    SEPTEMBER,
    OCTOBER,
    NOVEMBER,
    DECEMBER,
}
export const dayOfWeek: IsNumberKey = {
    [DaysWeek.SUNDAY]: "Domingo",
    [DaysWeek.MONDAY]: "Lunes",
    [DaysWeek.TUESDAY]: "Martes",
    [DaysWeek.WEDNESDAY]: "Miércoles",
    [DaysWeek.THURSDAY]: "Jueves",
    [DaysWeek.FRIDAY]: "Viernes",
    [DaysWeek.SATURDAY]: "Sábado",
}
export const monthsOfYear: IsNumberKey = {
    [Months.JANUARY]: "Enero",
    [Months.FEBRUARY]: "Febrero",
    [Months.MARCH]: "Marzo",
    [Months.APRIL]: "Abril",
    [Months.MAY]: "Mayo",
    [Months.JUN]: "Junio",
    [Months.JULY]: "Julio",
    [Months.AUGUST]: "Agosto",
    [Months.SEPTEMBER]: "Septiembre",
    [Months.OCTOBER]: "Octubre",
    [Months.NOVEMBER]: "Noviembre",
    [Months.DECEMBER]: "Diciembre",
}
export function useDate() {
    let timer = 0
    const date = reactive({
        now: 0,
        day: 0,
        dayofMonth: 0,
        month: 0,
        year: 0
    })
    function setDate() {
        date.now = Date.now()
        date.day = new Date(date.now).getDay()
        date.dayofMonth = new Date(date.now).getDate()
        date.month = new Date(date.now).getMonth()
        date.year = new Date(date.now).getFullYear()
    }
    const dateFormatted = computed(() => `${dayOfWeek[date.day]} ${date.dayofMonth} de ${monthsOfYear[date.month]} ${date.year}`)
    onMounted(() => {
        timer = setInterval(() => setDate(), 1000 * 60 * 60 * 6)
    })
    onMounted(() => setDate())
    onUnmounted(() => clearInterval(timer))

    return {
        now: dateFormatted
    }
}
export function useClock() {
    let timer = 0
    const clock = reactive({
        now: 0,
        hours: 0,
        minutes: 0,
    })
    const isAmOrPm = computed(() => clock.hours < 12 ? AMPM.AM : AMPM.PM)
    const hoursFormatted = computed(() => clock.hours < 10 ? `0${clock.hours}` : `${clock.hours}`)
    const minutesFormatted = computed(() => clock.minutes < 10 ? `0${clock.minutes}` : `${clock.minutes}`)
    const clockFormatted = computed(() => `${hoursFormatted.value}:${minutesFormatted.value} ${isAmOrPm.value}`)
    function setClock() {
        clock.now = Date.now()
        clock.hours = new Date(clock.now).getHours()
        clock.minutes = new Date(clock.now).getMinutes()
        // seconds.value = new Date(now.value).getSeconds()
    }
    onMounted(() => {
        timer = setInterval(() => setClock(), 1000)
    })
    onMounted(() => setClock())
    onUnmounted(() => clearInterval(timer))

    return {
        hour: clockFormatted
    }
}