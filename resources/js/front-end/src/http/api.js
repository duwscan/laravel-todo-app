import axios from "axios";

const token = localStorage.getItem("token");
const backend_url = "http://laravel-api.test";
const api = axios.create({
    baseURL: backend_url + "/api/v1",
});
api.interceptors.request.use((config) => {
    const token = localStorage.getItem("token");
    config.headers.Authorization = `Bearer ${token}`
    return config;
});
export default api;
