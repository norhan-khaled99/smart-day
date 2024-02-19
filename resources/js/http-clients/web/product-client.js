const BASE_URL = `web-products`;
export default {
    getCategories(id) {
        return axios.get(`${BASE_URL}/categories?id=${id ?? ''}`);
    },
    getBaseCategories(id) {
        return axios.get(`${BASE_URL}/base-categories`);
    },
    getProducts(pageNo, pageSize, category_id) {
        return axios.get(`${BASE_URL}?page=${pageNo}&page_size=${pageSize}
        &category_id=${category_id !== null && category_id !== -1 ? category_id : ''}`);
    },
    getHubs() {
        return axios.get(`${BASE_URL}/hubs`);
    },
    getAllProducts() {
        return axios.get(`${BASE_URL}`);
    },
    getProductDetails(productId){
        return axios.get(`${BASE_URL}/${productId}`);
    }

}
