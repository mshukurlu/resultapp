import Api from './Api';
const END_POINT = 'teams';
export  default {
    all()
    {
        return Api.get(END_POINT);
    }
}
