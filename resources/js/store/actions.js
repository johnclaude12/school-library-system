import axios from 'axios'
import Swal from 'sweetalert2'

let actions = {
    GET_AUTH({ commit }, payload) {

    },
    async GET_USERS({ commit }, payload) {
        await axios.get('api/user?page='+ payload.page)
                .then(({ data }) => commit('SET_USERS', data))
                .catch(error => console.log("Error :", error));
    },
    async DELETE_USER({ commit }, payload) {
        await axios.delete('api/user/'+ payload)
                .then(({ data }) => {
                    commit('DELETE_USER', payload)
                    Swal.fire('', data.message, data.status)
                })
                .catch(error => {
                    Swal.fire('', 'Oops! User failed to delete.', 'error')
                })
    }
};

export default actions;
