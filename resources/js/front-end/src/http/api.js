import axios from "axios";

const backend_url = "http://laravel-api.test";
const api = axios.create({
    baseURL: backend_url + "/api/v1",
    headers: {
        Authorization: `Bearer 5|WV71sZnAqdJk5R37tP2hDympf6PQbCRW9odS4H1r`
    }
});
api.interceptors.request.use((config) => {
    // Exclude login, logout, and signup URLs
    if (
        config.url.includes("/login") ||
        config.url.includes("/logout") ||
        config.url.includes("/signup")
    ) {
        // Remove the bearer token for excluded URLs
        delete api.defaults.headers.common["Authorization"];
    }
    return config;
});
export default api;
