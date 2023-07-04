import axios from "axios";

const http = axios.create({
    headers: {
        Accept: "application/json",
        ["X-QUEEN-TECH-AUTHORIZATION"]: window.apiKey,
    },
});

http.interceptors.request.use((config) => {
    return config;
});

http.interceptors.response.use(
    (res) => {
        return Promise.resolve(res.data);
    },
    (err) => {
        return Promise.reject(err);
    }
);

export default http;