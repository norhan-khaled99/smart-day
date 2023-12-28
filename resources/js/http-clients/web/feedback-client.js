import axios from "axios";

const BASE_URL = `feedback`;
export default {
    store(formValue) {
        return axios.post(`${BASE_URL}/store`, formValue);
    },
    getfeedbacks(){
        return axios.get(`${BASE_URL}/`)
    }
}
