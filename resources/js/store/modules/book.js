import axios from 'axios'

export const namespaced = true;

export const state = {
    total_books: 0,
}

export const actions = {
    async getTotalBooks({ commit }) {
        await axios.get('api/total/books')
                .then(({ data }) => commit('setTotalBooks', data.data))
                .catch(error => console.log("Error :", error));
    },
}

export const mutations = {
    setTotalBooks(state, data) {
        state.total_books = data
    },
}

export const getters = {
    total_books: state => state.total_books
}
