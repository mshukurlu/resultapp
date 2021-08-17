import axios from "axios";
const Api = axios.create({
    baseURL:'/api/simulation'
});
export default Api;
