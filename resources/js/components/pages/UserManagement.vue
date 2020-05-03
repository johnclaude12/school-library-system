<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Table</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <button data-toggle="modal" data-target="#add_user_modal" data-title="Add User" class="btn btn-sm btn-primary">
                                    Add User <i class="fas fa-user-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>User Type</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Birthday</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.user_type }}</td>
                                    <td>{{ user.firstname }}</td>
                                    <td>{{ user.gender }}</td>
                                    <td>{{ user.birthday }}</td>
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

        <UserModal
            :modalName="'add_user_modal'"
            :modalTitle="'Register User'"
            :userData="userData"
            :onSubmit="onSubmit"
        />
    </div>
</template>

<script>
    import UserModal from '../common/UserModal.vue'

    export default {
        name: "UserManagement",
        components: {
            UserModal
        },
        data() {
            return {
                users: [],
                userData: {
                    image_id: '',
                    firstname: '',
                    middlename: '',
                    lastname: '',
                    gender: '',
                    birthday: '',
                    username: '',
                    password: '',
                    question_id: '',
                    security_answer: '',
                    user_type_id: ''
                },
            }
        },
        created() {
            axios.get('api/user')
                .then(({ data })=> this.users = data.data)
                .catch(err => console.log("Error :", err))
        },
        methods: {
            onSubmit() {
                axios.post('api/user', this.userData)
                    .then(({ data }) => {
                        this.users = [data.data, ...this.users]; // inject new data in this.users
                        this.userData = {}; // to clear all fields in modal
                        $('#add_user_modal').modal('hide'); // close modal
                    })
                    .catch(err => console.log("Error :", err))
            }
        }
    }
</script>
