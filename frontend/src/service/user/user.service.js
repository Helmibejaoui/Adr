import axios from 'axios';
import authHeader from '../auth/auth-header';

const API_URL = 'http://localhost:8000/api/user/';

class UserService {
    getUser(id) {
        return axios.get(API_URL + id, {headers: authHeader()});
    }

}

export default new UserService();