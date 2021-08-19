import Api from "./Api";
const END_POINT = 'predection';
export default {
    getPrediction()
    {
        return Api.get(END_POINT);
    }
}
