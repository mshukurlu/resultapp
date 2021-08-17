import Api from "./Api";
const END_POINT = 'weekly-match';
export default {
    getWeeksMatch(week)
    {
        return Api.get(END_POINT+'/'+week);
    }
}
