const BASE_URL = `questions`;
export default {
    store(formValue) {
        return axios.post(`${BASE_URL}/store`, formValue);
    },
    getAllQuestions() {
        return axios.get(`${BASE_URL}/`)
    },
    deleteQuestions(id) {
        return axios.delete(`${BASE_URL}/${id}`)
    }
}
