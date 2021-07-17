import axios from "axios";
import store from "@/admin/store";

export const authClient = axios.create({
  baseURL: process.env.VUE_APP_API_URL,
  withCredentials: true, // required to handle the CSRF token
});

/*
 * Add a response interceptor
 */
authClient.interceptors.response.use(
  (response) => {
    return response;
  },
  function(error) {
    if (
      error.response && [401, 419].includes(error.response.status) &&
      store.getters["auth/authUser"] &&
      !store.getters["auth/guest"]
    ) {
      store.dispatch("auth/logout");
    }
    return Promise.reject(error);
  }
);

export default {
  async login(payload) {
    await authClient.get("/sanctum/csrf-cookie");
    return authClient.post("/admin/login", payload);
  },
  logout() {
    return authClient.post("/admin/logout");
  },
  async forgotPassword(payload) {
    await authClient.get("/sanctum/csrf-cookie");
    return authClient.post("/admin/forgot-password", payload);
  },
  getAuthUser() {
    return authClient.get("/api/admin/users/auth");
  },
  async resetPassword(payload) {
    await authClient.get("/sanctum/csrf-cookie");
    return authClient.post("/admin/reset-password", payload);
  },
  updatePassword(payload) {
    return authClient.put("/api/admin/user/update-password", payload);
  },
  async registerUser(payload) {
    await authClient.get("/sanctum/csrf-cookie");
    return authClient.post("/api/admin/user/register", payload);
  },
  async deleteUser(payload) {
    await authClient.get("/sanctum/csrf-cookie");
    return authClient.delete(`/api/admin/user/${payload}`);
  },
  sendVerification(payload) {
    return authClient.post("/admin/email/verification-notification", payload);
  },
  updateUser(payload) {
    return authClient.put("/api/admin/user/update-profile", payload);
  },
};
