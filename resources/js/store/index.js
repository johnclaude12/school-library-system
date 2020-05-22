import Vue from 'vue'
import Vuex from 'vuex'

import * as book from './modules/book.js'
import * as user from './modules/user.js'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        book,
        user
    }
});
