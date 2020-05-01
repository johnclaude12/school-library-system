<template>
    <div class="container">
        <div class="row justify-content-center">
            <div v-for="(item, $index) in items" :key="$index" class="col-md-4 col-sm-6 my-3">
                <div class="card h-100">
                    <div class="card-body text-muted">
                        <i :class="'fa-5x mt-3 fas ' + item.icon"></i>
                        <h6 class="text-uppercase">{{ item.text }}</h6>
                        <h1 class="display-4 font-weight-bold">{{ item.total }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                items: [
                    {
                        icon: 'fa-swatchbook',
                        text: "Total Books",
                        description: "Total books registered",
                        total: 171,
                        "footer-text": "More info",
                        "footer-icon": '<i class="fas fa-arrow-right"></i>'
                    },
                    {
                        icon: 'fa-book',
                        text: "Total Books Lost",
                        description: "Total books lost recorded.",
                        total: 1,
                        "footer-text": "More info",
                        "footer-icon": '<i class="fas fa-arrow-right"></i>'
                    },
                    {
                        icon: 'fa-exclamation-triangle',
                        text: "Books Overdue",
                        description: "Total books overdue recorded.",
                        total: 4,
                        "footer-text": "More info",
                        "footer-icon": '<i class="fas fa-arrow-right"></i>'
                    },
                    {
                        icon: 'fa-book-reader',
                        text: "Total Borrowers",
                        description: "Total borrowers recorded.",
                        total: 56,
                        "footer-text": "More info",
                        "footer-icon": '<i class="fas fa-arrow-right"></i>'
                    },
                    {
                        icon: 'fa-users',
                        text: "Total Students",
                        description: "Total students registered",
                        total: 200,
                        "footer-text": "More info",
                        "footer-icon": '<i class="fas fa-arrow-right"></i>'
                    },
                    {
                        icon: 'fa-user-tie',
                        text: "Total Faculties",
                        description: "Total faculties today recorded.",
                        total: 10,
                        "footer-text": "More info",
                        "footer-icon": '<i class="fas fa-arrow-right"></i>'
                    }
                ]
            }
        }
    }
</script>
