const BASE_URL = `notification-services`;
export default {
    store(formValue) {
        return axios.post(`${BASE_URL}`, formValue);
    },
    getAreas() {
        return axios.get(`${BASE_URL}/areas`);
    },
    getCities() {
        return axios.get(`${BASE_URL}/cities`);
    },
}