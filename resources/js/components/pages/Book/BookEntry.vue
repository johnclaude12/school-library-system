<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <div class="d-flex align-items-center pb-2">
                                <h3 class="card-title">Books</h3>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary show-book-modal" @click="openAddCategory" data-title="New Book Category">
                                    Book Category <i class="fas fa-plus"></i>
                                </button>
                                <button class="btn btn-sm btn-primary show-book-modal" @click="openAddBook" data-title="ADD">
                                    Book Register <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th>Call No.</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Category</th>
                                    <th>Date Pub.</th>
                                    <th>Avail/Total Copies</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="book in books.data" :key="book.id">
                                    <td>{{ book.call_number }}</td>
                                    <td>{{ book.title }}</td>
                                    <td>{{ book.author }}</td>
                                    <td>{{ book.publisher }}</td>
                                    <td>{{ book.category }}</td>
                                    <td>{{ book.date_published }}</td>
                                    <td>{{ book.avail_copies+"/"+ book.total_copies }}</td>
                                    <td>
                                        <i class="fas fa-trash" @click="onDelete(book.id)"></i>
                                        <i class="fas fa-edit" @click="editBook(book.id)"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            <pagination :data="books" show-disabled :limit="limit" @pagination-change-page="loadBooks"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ModalBook
            :bookData="bookData"
            :book_categories="book_categories"
            :errors="errors"
            :submitBook="submitBook"
            :editMode="editMode"
            :onUpdate="onUpdate"
        />

        <ModalCategory
            :categoryData="categoryData"
            :submitCategory="submitCategory"
        />
    </div>
</template>

<script>
    import ModalBook from './ModalBook'
    import ModalCategory from './ModalCategory'

    export default {
        name: "BookEntry",
        components: {
            ModalBook, ModalCategory
        },
        data() {
            return {
                bookData: {
                    isbn: '',
                    call_number: '',
                    title: '',
                    author: '',
                    publisher: '',
                    description: '',
                    category_id: '',
                    date_published: '',
                    series: '',
                    price: '',
                    total_copies: ''
                },
                categoryData: {
                    category: ""
                },
                books: {},
                errors: [],
                limit: 2,
                editMode: false
            }
        },
        created() {
            this.loadBooks();
        },
        computed: {
            book_categories() {
                return this.$store.state.book.book_categories;
            }
        },
        methods: {
            async loadBooks(page = 1) {
                await axios.get('api/books?page='+ page)
                        .then(({ data }) => {
                            this.books = data.data.books;
                        })
                        .catch(err => console.log("Error :", err))
            },
            async submitBook() {
                this.$Progress.start();
                await axios.post('api/books', this.bookData)
                    .then(({ data }) => {
                        this.$Progress.finish();
                        $('#add_book').modal('hide');
                        this.bookData = {};

                        Swal.fire({
                            icon: 'success',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 4000
                        })
                    })
                    .catch(error => {
                        this.$Progress.fail()
                        if (error.response.status !== 422) {
                            Swal.fire({
                                icon: 'error',
                                text: 'Something went wrong. Please, try again later.',
                                showConfirmButton: false,
                                timer: 4000
                            })
                        }

                        this.errors = error.response.data.errors;
                    })
            },
            async submitCategory() {
                this.$Progress.start();

                await axios.post('api/books/category', this.categoryData)
                        .then(({ data }) => {
                            this.$Progress.finish();

                            $('#modalCategory').modal('hide');
                            this.categoryData = {};
                            Swal.fire({
                                icon: 'success',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 4000
                            })
                        })
                        .catch(error => {
                            this.$Progress.fail();

                            if (error.response.status !== 422) {
                                Swal.fire({
                                    icon: 'error',
                                    text: 'Something went wrong. Please, try again later.',
                                    showConfirmButton: false,
                                    timer: 4000
                                })
                            }

                            this.errors = error.response.data.errors;
                        });
            },
            openAddBook() {
                this.$Progress.start()
                this.$store.dispatch('book/getCategories');
                this.editMode = false;
                this.bookData = {};

                setTimeout(() => {
                    $('#add_book').modal('show')
                    this.$Progress.finish()
                }, 500);
            },
            openAddCategory() {
                $('#modalCategory').modal('show');
            },
            onDelete(id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(async (result) => {
                        if (result.value) {
                            this.$Progress.start()
                            await axios.delete('api/books/'+ id)
                                    .then(({ data }) => {
                                        // find id from param to books state and remove
                                        this.books.data = this.books.data.filter(book => book.id !== id);
                                        this.$Progress.finish()

                                        Swal.fire('', data.message, data.status)
                                    })
                                    .catch(error => {
                                        this.$Progress.fail()
                                        Swal.fire(
                                            '',
                                            'Something went wrong. Please, try again later.',
                                            'error'
                                        )
                                    })
                        }
                    })
            },
            editBook(id) {
                this.$Progress.start()
                axios.get('api/books/'+id)
                    .then(({ data }) => {
                        this.editMode = true;
                        this.bookData = data.data;
                        $('#add_book').modal('show');
                        this.$Progress.finish()
                    })
                    .catch(error => {
                        this.$Progress.fail()
                    });
            },
            async onUpdate() {
                this.$Progress.start()
                await axios.put('api/books/'+ this.bookData.id, this.bookData)
                        .then(({ data }) => {
                            this.books.data = this.books.data.filter(book => book.id !== data.data.id); // remove update book
                            this.books.data = [data.data, ...this.books.data]; // inject new data
                            this.$Progress.finish()
                            $('#add_book').modal('hide');

                            Swal.fire({
                                icon: 'success',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 4000
                            })
                        })
                        .catch(error => {
                            if (error.response.status !== 422) {
                                Swal.fire({
                                    icon: 'error',
                                    text: 'Something went wrong. Please, try again later.',
                                    showConfirmButton: false,
                                    timer: 4000
                                })
                            }

                            this.$Progress.fail()
                            this.errors = error.response.data.errors;
                        })
            }
        }
    }
</script>
