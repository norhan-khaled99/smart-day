const BASE_URL = `installs`;
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
    updateCityStatus(cityId, newStatus) {
        return axios.put(`${BASE_URL}/cities/${cityId}`, { status: newStatus });

    },
}
