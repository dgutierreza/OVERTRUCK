import { store } from "vuex";

let getters = {
    users: state => {
        return state.users;
    },

    links: state => {
        return state.links;
    },

    meta: state => {
        return state.meta;
    }
}
export default getters;
