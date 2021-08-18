import Api from "./Api";
const END_POINT = 'table';
export default {
    getTable()
    {
        return Api.get(END_POINT);
    }
}
