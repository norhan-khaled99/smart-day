const BASE_URL = `notification-services`;
export default {
    delete(id) {
        return axios.delete(`${BASE_URL}/${id}`);
    },
    getItems(pageNo, pageSize, text, status) {
        return axios.get(`${BASE_URL}?page=${pageNo}&page_size=${pageSize}&text=${text}&status=${status !== null && status !== -1 ? status : ''}`);
    },
}