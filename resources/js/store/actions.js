let actions = {
    getAllUsers ( {commit} ) {
        axios.get(`/users`)
            .then( response => {
                commit('SET_USERS', response.data.data);
                commit('SET_LINKS', response.data.links);
                commit('SET_META', response.data.meta);
                commit('ADD_PAGES_INTO_META', response.data.meta.last_page);
            });
    }
}

export default actions;
