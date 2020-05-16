import axios from 'axios'
import Swal from 'sweetalert2'

let actions = {
    GET_AUTH({ commit }, payload) {

    },
    async GET_USERS({ commit }, payload) {
        await axios.get('api/user?page='+ payload.page)
                .then(({ data }) => commit('SET_USERS', data))
                .catch(error => console.log("Error :", error));
    }
};

export default actions;
