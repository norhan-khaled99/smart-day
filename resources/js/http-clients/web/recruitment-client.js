const BASE_URL = `recruitments`;
export default {
    store(formValue) {
        return axios.post(`${BASE_URL}`, formValue);
    },
}