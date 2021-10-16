import axios from 'axios';
import authHeader from "@/service/auth-header";

const API_URL = 'http://localhost:8000/api/';

class AuthService {
    login(user) {
        return axios
            .post(API_URL + 'login_check', {
                username: user.username,
                password: user.password
            })
            .then(response => {
                if (response.data.token) {
                    localStorage.setItem('token', JSON.stringify(response.data));
                }

                return response.data;
            });
    }

    logout() {
        localStorage.removeItem('token');
    }

    register(user) {
        return axios.post(API_URL + 'register', {
            username: user.username,
            email: user.email,
            password: user.password
        });
    }

    getCurrentUser() {
        return axios.get(API_URL + 'current-user', {headers: authHeader()});
    }


}

export default new AuthService();