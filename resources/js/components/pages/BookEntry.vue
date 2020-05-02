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
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add_book" data-title="ADD">Book Register</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Call No.</th>
                                    <th>ISBN</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Category</th>
                                    <th>Date Pub.</th>
                                    <th>Copies</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="book in books" :key="book.id">
                                    <td>{{ book.id }}</td>
                                    <td>{{ book.call_number }}</td>
                                    <td>{{ book.isbn }}</td>
                                    <td>{{ book.title }}</td>
                                    <td>{{ book.author }}</td>
                                    <td>{{ book.publisher }}</td>
                                    <td>{{ book.category_id }}</td>
                                    <td>{{ book.date_published }}</td>
                                    <td>{{ book.copies }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
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
                    <div class="modal-body">
                        <div class="row">
                            <!-- first row -->
                            <div class="col-6">
                                <div class="form-group">
                                    <div style="font-size: 15px;">
                                        <span>ISBN*</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-background" maxlength="30">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="font-size: 15px;">
                                        <span>Call Number*</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-background" maxlength="30">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="font-size: 15px;">
                                        <span>Title*</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-background" maxlength="30">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="font-size: 15px;">
                                        <span>Author*</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-background" maxlength="30">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="font-size: 15px;">
                                        <span>Publisher*</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-background" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <!-- second row -->
                            <div class="col-6">
                                <div class="form-group">
                                    <div style="font-size: 15px;">
                                        <span>Description*</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-background" maxlength="30" v-model="data.description">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="font-size: 15px;">
                                        <span>Categories*</span>
                                    </div>
                                    <div class="form-group">
                                        <select class="custom-select" v-model="data.category">
                                            <option v-for="cat in categories" :value="cat.id" :key="cat.id">
                                                {{ cat.category }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="font-size: 15px;">
                                        <span>Date Published*</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-background" maxlength="30">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="font-size: 15px;">
                                        <span>Series*</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-background" maxlength="30">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="font-size: 15px;">
                                        <span>Price*</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-background" maxlength="30">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary p-18" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-new-position"><i class="fas fa-save mr-1"></i>Save</button>
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
                books: [],
                categories: [],
                data: {
                    title: '',
                    isbn: '',
                    category: '',
                    description: ''
                }
            }
        },
        mounted() {
            console.log('Book Entry Component mounted.')
        },
        created() {
            axios.get('api/book')
                .then(({ data: { data: { book_categories, books } } }) => {
                    this.categories = book_categories;
                    this.books = books.data;
                })
                .catch(err => console.log("Error :", err))
        }
    }
</script>
