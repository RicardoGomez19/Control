
import axios from 'axios'

const apiEmpleado = axios.create({
    baseURL:'http://127.0.0.1:8000/api/apiEmpleado'
})

export default apiEmpleado

