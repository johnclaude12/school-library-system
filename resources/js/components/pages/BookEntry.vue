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
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add_book" data-title="ADD">
                                Book Register <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Call No.</th>
                                    <th>ISBN</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Category</th>
                                    <th>Date Pub.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="book in books.data" :key="book.id">
                                    <td>{{ book.call_number }}</td>
                                    <td>{{ book.isbn }}</td>
                                    <td>{{ book.title }}</td>
                                    <td>{{ book.author }}</td>
                                    <td>{{ book.publisher }}</td>
                                    <td>{{ book.category_id }}</td>
                                    <td>{{ book.date_published }}</td>
                                    <td>
                                        <i class="fas fa-trash" @click="deleteBook(book.id)"></i>
                                        <i class="fas fa-edit" @click="editBook(book.id)"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            <pagination :data="books" show-disabled @pagination-change-page="loadBooks"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add_book" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">Register Book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div class="modal-body text-muted">
                        <div class="row">
                            <!-- first row -->
                            <div class="col-6">
                                <div
                                    v-for="(item, $index) in items_col1"
                                    :key="$index"
                                    class="form-group"
                                >
                                    <label :for="item.name">{{ item.label }}</label>
                                    <input
                                        :id="item.name"
                                        :name="item.name"
                                        :type="item.type"
                                        :required="item.required"
                                        v-model="bookData[item.name]"
                                        class="form-control form-control-custom"
                                    >
                                    <span role="alert" :class="errors[item.name] ? 'invalid-feedback d-block' : ''">
                                        <strong v-if="errors[item.name]" >{{ errors[item.name][0] }}</strong>
                                    </span>
                                </div>
                            </div>
                            <!-- second row -->
                            <div class="col-6">
                                <div
                                    v-for="(item, $index) in items_col2"
                                    :key="$index"
                                    class="form-group"
                                >
                                    <label :for="item.name">{{ item.label }}</label>
                                    <template v-if="item.name == 'category_id'">
                                        <select
                                            :name="item.name"
                                            :id="item.name"
                                            v-model="bookData[item.name]"
                                            class="form-control form-control-custom"
                                        >
                                            <option value="" disabled selected>Select Book Category</option>
                                            <option
                                                v-for="(item, $index) in book_categories"
                                                :key="$index"
                                                :value="item.id"
                                            >{{ item.category }}</option>
                                        </select>
                                    </template>
                                    <template v-else>
                                        <input
                                            :id="item.name"
                                            :name="item.name"
                                            :type="item.type"
                                            :required="item.required"
                                            v-model="bookData[item.name]"
                                            class="form-control form-control-custom"
                                        >
                                    </template>
                                    <span role="alert" :class="errors[item.name] ? 'invalid-feedback d-block' : ''">
                                        <strong v-if="errors[item.name]" >{{ errors[item.name][0] }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary p-18" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-new-position" @click="onSubmit"><i class="fas fa-save mr-1"></i>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BookEntry",
        data() {
            return {
                books: {},
                book_categories: [],
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
                errors: [],
                items_col1: [
                    {
                        label: "ISBN*",
                        name: "isbn",
                        required: "required",
                        type: "text"
                    },{
                        label: "Call Number*",
                        name: "call_number",
                        required: "required",
                        type: "number"
                    },{
                        label: "Title*",
                        name: "title",
                        required: "required",
                        type: "text"
                    },{
                        label: "Author*",
                        name: "author",
                        required: "required",
                        type: "text"
                    },{
                        label: "Publisher*",
                        name: "publisher",
                        required: "required",
                        type: "text"
                    }
                ],
                items_col2: [
                   {
                        label: "Description*",
                        name: "description",
                        required: "required",
                        type: "text"
                    },{
                        label: "Categories*",
                        name: "category_id",
                        required: "required",
                        type: "dropdown"
                    },{
                        label: "Date Published*",
                        name: "date_published",
                        required: "required",
                        type: "date"
                    },{
                        label: "Series*",
                        name: "series",
                        required: "required",
                        type: "text"
                    },{
                        label: "Copies*",
                        name: "total_copies",
                        required: "required",
                        type: "number"
                    },{
                        label: "Price*",
                        name: "price",
                        required: "required",
                        type: "number"
                    },
                ]
            }
        },
        created() {
            this.loadBooks();
        },
        methods: {
            async loadBooks(page = 1) {
                await axios.get('api/book?page='+ page)
                        .then(({ data }) => {
                            this.books = data.data.books;
                            this.book_categories = data.data.book_categories;
                        })
                        .catch(err => console.log("Error :", err))
            },
            async onSubmit() {
                this.$Progress.start();
                await axios.post('api/book', this.bookData)
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
            deleteBook(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    this.$Progress.start()
                    if (result.value) {
                        axios.delete('api/book/'+ id)
                            .then(({ data }) => {
                                // find id from param to books state and remove
                                this.books.data = this.books.data.filter(book => book.id !== id);
                                this.$Progress.finish()

                                Swal.fire(
                                    '',
                                    data.message,
                                    data.status
                                )
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
                console.log("ID :", id);
            }
        }
    }
</script>
