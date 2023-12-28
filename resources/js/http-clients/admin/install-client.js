const BASE_URL = `installs`;
export default {
    delete(id) {
        return axios.delete(`${BASE_URL}/${id}`);
    },
    sendEmail(input) {
        return axios.post(`${BASE_URL}/send-email`, input);
    },
    getItems(pageNo, pageSize, text, status) {
        return axios.get(`${BASE_URL}?page=${pageNo}&page_size=${pageSize}&text=${text}&status=${status !== null && status !== -1 ? status : ''}`);
    },

}
