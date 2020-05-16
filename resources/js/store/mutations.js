let mutations = {
    SET_AUTH(state, auth) {

    },
    SET_USERS(state, data) {
        state.users = data
    },
    DELETE_USER(state, userId) {
        state.users.data = state.users.data.filter(user => user.id !== userId)
    }
};

export default mutations;
