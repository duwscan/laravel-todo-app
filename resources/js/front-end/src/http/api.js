import axios from 'axios';

const backend_url = "http://laravel-api.test";
const api = axios.create({
    baseURL: backend_url + "/api/v1",
    headers: {
        'Authorization': `Bearer 5|WV71sZnAqdJk5R37tP2hDympf6PQbCRW9odS4H1r`
    }
})
export default api;
