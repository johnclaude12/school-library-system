import axios from 'axios'

export const namespaced = true;

export const state = {
    total_books: 0,
    book_categories: []
}

export const actions = {
    async getTotalBooks({ commit }) {
        await axios.get('api/total/books')
                .then(({ data }) => commit('SET_TOTAL_BOOKS', data.data))
                .catch(error => console.log("Error :", error));
    },
    async getCategories({ commit }) {
        await axios.get('api/books/category/all')
                .then(({ data }) => commit('SET_CATEGORIES', data.data))
                .catch(error => console.log("Error :", error));
    }
}

export const mutations = {
    SET_TOTAL_BOOKS(state, data) {
        state.total_books = data
    },
    SET_CATEGORIES(state, book_categories) {
        state.book_categories = book_categories;
    }
}

export const getters = {
    total_books: state => state.total_books
}
