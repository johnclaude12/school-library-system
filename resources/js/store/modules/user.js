import axios from 'axios'

export const namespaced = true;

export const state = {
    users: {},
}

export const actions = {
    async getUsersPaginated({ commit }, page) {
        await axios.get('api/user?page='+ page)
                .then(({ data }) => commit('setUsers', data))
                .catch(error => console.log("Error :", error));
    },
    async deleteUser({ commit }, id) {
        await axios.delete('api/user/'+ id)
                .then(() => commit('deleteUser', id))
                .catch(error => console.log('Error :', error));
    }
}

export const mutations = {
    setUsers(state, users) {
        state.users = users
    },
    deleteUser(state, id) {
        state.users.data = state.users.data.filter(user => user.id !== id)
    }
}

export const getters = {
    getUsers: state => state.users
}
