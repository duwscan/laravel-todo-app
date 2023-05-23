import api from "./api";

const resource = "/auth";

export const login = (payload) => api.post(resource + "/login", payload);
export const signup = (payload) => api.post(resource + "/signup", payload);
export const logout = () => api.post(resource + "/logout");

export const me = () => api.get("/user")
