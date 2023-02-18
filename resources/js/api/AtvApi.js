
import axios from 'axios'

const pokemonApi = axios.create({
    baseURL:'http://project-atv.test.192.168.1.104.nip.io/api'
})

export default pokemonApi