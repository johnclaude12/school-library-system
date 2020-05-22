<template>
    <div class="container">
        <div class="row justify-content-center">
            <div v-for="(item, $index) in items" :key="$index" class="col-md-4 col-sm-6 my-3">
                <div class="card h-100">
                    <div class="card-body text-muted dashboard">
                        <i :class="'fa-5x mt-3 fas fa-' + item.icon"></i>
                        <h6 class="text-uppercase">{{ item.text }}</h6>
                        <h1 class="display-4 font-weight-bold">{{ total_books }}</h1>
                    </div>
                    <a href="#" class="small-box-footer">{{ item['footer-text'] }} <i :class="'fas fa-' + item['footer-icon']"></i></a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'

    export default {
        name: "Dashboard",
        data() {
            return {
                items: [
                    {
                        icon: 'swatchbook',
                        text: "Books",
                        description: "Total books registered",
                        total: 171,
                        "footer-text": "More info",
                        "footer-icon": 'arrow-circle-right'
                    },
                    {
                        icon: 'book',
                        text: "Books Lost",
                        description: "Total books lost recorded.",
                        total: 1,
                        "footer-text": "More info",
                        "footer-icon": 'arrow-circle-right'
                    },
                    {
                        icon: 'exclamation-triangle',
                        text: "Books Overdue",
                        description: "Total books overdue recorded.",
                        total: 4,
                        "footer-text": "More info",
                        "footer-icon": 'arrow-circle-right'
                    },
                    {
                        icon: 'book-reader',
                        text: "Borrowers",
                        description: "Total borrowers recorded.",
                        total: 56,
                        "footer-text": "More info",
                        "footer-icon": 'arrow-circle-right'
                    },
                    {
                        icon: 'users',
                        text: "Students",
                        description: "Total students registered",
                        total: 200,
                        "footer-text": "More info",
                        "footer-icon": 'arrow-circle-right'
                    },
                    {
                        icon: 'user-tie',
                        text: "Faculties",
                        description: "Total faculties today recorded.",
                        total: 10,
                        "footer-text": "More info",
                        "footer-icon": 'arrow-circle-right'
                    }
                ]
            }
        },
        computed: mapGetters('book', ['total_books']),
        created() {
            this.getTotalBooks();
        },
        methods: {
            ...mapActions('book', ['getTotalBooks']),
        }
    }
</script>
