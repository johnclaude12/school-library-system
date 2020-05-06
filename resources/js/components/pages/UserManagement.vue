<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Table</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <button @click="OpenAddModal" class="btn btn-sm btn-primary">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users.data" :key="user.id">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.user_type }}</td>
                                    <td>{{ user.firstname }}</td>
                                    <td>{{ user.gender }}</td>
                                    <td>{{ user.birthday }}</td>
                                    <td>
                                        <i class="fas fa-trash" @click="onDelete(user.id)"></i>
                                        <i class="fas fa-edit" @click="editUser(user.id)"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            <pagination :data="users" show-disabled @pagination-change-page="loadUsers"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <UserModal
            :editMode="editMode"
            :userData="userData"
            :onSubmit="onSubmit"
            :onUpdate="onUpdate"
            :imageOnchage="imageOnchage"
            :errors="errors"
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
                editMode: false,
                users: {},
                userData: {
                    user_image: '',
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
                errors: []
            }
        },
        created() {
            this.loadUsers();
        },
        methods: {
            loadUsers(page = 1) {
                axios.get('api/user?page='+ page)
                    .then(({ data })=> this.users = data)
                    .catch(err => console.log("Error :", err))
            },
            OpenAddModal() {
                this.editMode = false;
                this.userData = {};
                this.userData.user_image = 'images/profile/user.png'; // set default value of element file
                $('#user_modal').modal('show')
                                .find("input,textarea,select").val('').end()
                                .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
            },
            onSubmit() {
                this.$Progress.start();
                axios.post('api/user', this.userData)
                    .then(({ data }) => {
                        this.users.data = [data.data, ...this.users.data]; // inject new data in this.users.data
                        this.userData = {}; // to clear all fields in modal
                        $('#user_modal').modal('hide'); // close modal
                        this.$Progress.finish()

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
                                text: 'Oops! Something went wrong.',
                                showConfirmButton: false,
                                timer: 4000
                            })
                        }

                        this.errors = error.response.data.errors;
                    })
            },
            onUpdate() {
                axios.put('api/user/' + this.userData.id, this.userData)
                    .then(({ data }) => {
                        this.userData = {}; // to clear all fields in modal
                        $('#user_modal').modal('hide'); // close modal
                        this.setProfilePic(data)
                        this.$Progress.finish()

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
                                text: 'Oops! Something went wrong.',
                                showConfirmButton: false,
                                timer: 4000
                            })
                        }

                        this.errors = error.response.data.errors;
                    })
            },
            imageOnchage(el) {
                let file = el.target.files[0];
                let reader = new FileReader();

                if (file) {
                    if (file['size'] < 2111775) {
                        reader.onloadend = file => {
                            this.userData.user_image = reader.result;
                        }

                        return reader.readAsDataURL(file);
                    }

                    Swal.fire({
                        icon: 'error',
                        text: 'Please upload less than 2MB.',
                    });
                }

                $('input[name="user_image"]').val("");
                this.userData.user_image = '';
            },
            editUser(id) {
                this.$Progress.start();
                axios.get('api/user/'+ id)
                    .then(({ data }) => {
                        this.userData = data;
                        $('#user_modal').modal('show');
                        this.editMode = true;
                        this.$Progress.finish();
                    })
                    .catch(err => {
                        this.$Progress.failed();
                        console.log("Error :", err)
                    })
            },
            onDelete(id) {
                console.log("ID :", id)
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/user/'+ id)
                            .then(({ data }) => {
                                // find id from param to users state and remove
                                this.users.data = this.users.data.filter(user => user.id !== id);

                                Swal.fire(
                                    '',
                                    data.message,
                                    data.status
                                )
                            })
                            .catch(error => {
                                Swal.fire(
                                    '',
                                    'Oops! User failed to delete.',
                                    'error'
                                )
                            })
                    }
                })
            },
            setProfilePic({ data: { id, user_image } }) {
                if (id == localStorage.getItem('userId')) {
                    $('img#user_profile_picture').attr('src', user_image);
                }
            }
        }
    }
</script>
