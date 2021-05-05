let mutations = {
    SET_USERS (state, recordsUsers) {
        state.users = recordsUsers;
    },

    SET_LINKS (state, links) {
        state.links = links;
    },

    SET_META (state, meta) {
        state.meta = meta;
    },

    ADD_PAGES_INTO_META (state, lastPage) {
        let pages = [];

        for (let i = 1; i <= lastPage; i++) {
            pages[i] = i;
        }

        state.meta['pages'] = pages;
    }
}

export default mutations;
