// src/axios.js
import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8000' // Без /api
axios.defaults.headers.common['Accept'] = 'application/json'
axios.defaults.headers.common['Content-Type'] = 'application/json'
axios.defaults.withCredentials = true

// Автоматически подставляем токен из localStorage
axios.interceptors.request.use(config => {
    const token = localStorage.getItem('token')
    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }
    return config
})

export default axios
