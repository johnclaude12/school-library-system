<template>
    <div class="container">
        <div class="row justify-content-center">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="#option" data-toggle="tab">Option</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                            <form class="form-horizontal">
                                <div class="row justify-content-center text-center mb-4">
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <img
                                            class="profile-user-img img-fluid img-circle"
                                            :src="currentUser.user_image ? currentUser.user_image : 'images/profile/user.png'"
                                            alt="User profile picture"
                                        >
                                        <input
                                            class="d-none"
                                            type="file"
                                            id="user_image"
                                            name="user_image"
                                            @change="imageOnchage"
                                        >
                                        <label for="user_image" class="form-control form-control-custom mt-2">
                                            <i class="fas fa-upload"></i> Upload Image
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <h5 class="font-weight-bold">Personal Info</h5>
                                        <div
                                            class="form-group"
                                            v-for="(item, $index) in items_col1"
                                            :key="$index"
                                        >
                                            <label :for="item.name">{{ item.label }}</label>

                                            <template v-if="item.name === 'gender'">
                                                <select
                                                    class="form-control form-control-custom"
                                                    :class="errors[item.name] ? 'is-invalid' : ''"
                                                    :name="item.name"
                                                    :id="item.name"
                                                    v-model="currentUser[item.name]"
                                                >
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>
                                            </template>
                                            <template v-else>
                                                <input
                                                    class="form-control form-control-custom"
                                                    :class="errors[item.name] ? 'is-invalid' : ''"
                                                    :type="item.type"
                                                    :id="item.name"
                                                    :name="item.name"
                                                    v-model="currentUser[item.name]"
                                                >
                                            </template>

                                            <span role="alert" :class="errors[item.name] ? 'invalid-feedback d-block' : ''">
                                                <strong v-if="errors[item.name]" >{{ errors[item.name][0] }}</strong>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <h5 class="font-weight-bold">Security Info</h5>
                                        <div
                                            class="form-group"
                                            v-for="(item, $index) in items_col2"
                                            :key="$index"
                                        >
                                            <label :for="item.name">{{ item.label }}</label>
                                            <template v-if="item.name === 'user_type_id'">
                                                <select
                                                    class="form-control form-control-custom"
                                                    :class="errors[item.name] ? 'is-invalid' : ''"
                                                    :name="item.name"
                                                    :id="item.name"
                                                    v-model="currentUser[item.name]"
                                                >
                                                    <option value="1">Admin</option>
                                                    <option value="2">Librarian</option>
                                                    <option value="3">Student Assistant</option>
                                                </select>
                                            </template>
                                            <template v-else-if="item.name === 'question_id'">
                                                <select
                                                    class="form-control form-control-custom"
                                                    :class="errors[item.name] ? 'is-invalid' : ''"
                                                    :name="item.name"
                                                    :id="item.name"
                                                    v-model="currentUser[item.name]"
                                                >
                                                    <option value="1">Who's your first pet?</option>
                                                    <option value="2">Where is your first school?</option>
                                                    <option value="3">What is your mother maiden name?</option>
                                                </select>
                                            </template>
                                            <template v-else>
                                                <input
                                                    class="form-control form-control-custom"
                                                    :class="errors[item.name] ? 'is-invalid' : ''"
                                                    :type="item.type"
                                                    :id="item.name"
                                                    :name="item.name"
                                                    v-model="currentUser[item.name]"
                                                >
                                            </template>

                                            <span role="alert" :class="errors[item.name] ? 'invalid-feedback d-block' : ''">
                                                <strong v-if="errors[item.name]" >{{ errors[item.name][0] }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col">
                                    <button @click="onUpdate" type="button" class="btn btn-success">
                                    <i class="fas fa-save" style="color: #fff; float: none"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="option">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "Settings",
        data() {
            return {
                currentUser: {},
                currentUserID: ''
            }
        },
        created() {
            this.currentUserID = localStorage.getItem('userId');
            this.getCurrentUser();
        },
        methods: {
            getCurrentUser() {
                axios.get('api/user/'+ this.currentUserID)
                    .then(({ data }) => this.currentUser = data)
                    .catch(({ error }) => console.log("Error :", error))
            },
            onUpdate() {
                this.$Progress.start()
                axios.put('api/user/'+ this.currentUser.id, this.currentUser)
                    .then(({ data }) => {
                        this.$Progress.finish()
                        Swal.fire({
                            icon: 'success',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 4000
                        })
                    })
                    .catch(({ error }) => this.$Progress.failed())
            },
            imageOnchage(el) {
                let file = el.target.files[0];
                let reader = new FileReader();

                if (file) {
                    if (file['size'] < 2111775) {
                        reader.onloadend = file => {
                            this.currentUser.user_image = reader.result;
                        }

                        return reader.readAsDataURL(file);
                    }

                    Swal.fire({
                        icon: 'error',
                        text: 'Please upload less than 2MB.',
                    });
                }

                $('input[name="user_image"]').val("");
                this.currentUser.user_image = '';
            }
        },
        data() {
            return {
                currentUser: {},
                errors: [],
                items_col1: [
                    // {
                    //     label: "",
                    //     name: "user_image",
                    //     required: "required",
                    //     type: "file"
                    // },
                    {
                        label: "Firstname *",
                        name: "firstname",
                        required: "required",
                        type: "text"
                    },
                    {
                        label: "Middlename *",
                        name: "middlename",
                        required: "required",
                        type: "text"
                    },
                    {
                        label: "Lastname *",
                        name: "lastname",
                        required: "required",
                        type: "text"
                    },
                    {
                        label: "Gender *",
                        name: "gender",
                        required: "required",
                        type: "dropdown"
                    },
                    {
                        label: "Date Of Birth *",
                        name: "birthday",
                        required: "required",
                        type: "date"
                    }
                ],
                items_col2: [
                    {
                        label: "User Type *",
                        name: "user_type_id",
                        required: "required",
                        type: "dropdown"
                    },
                    {
                        label: "Username *",
                        name: "username",
                        required: "required",
                        type: "text"
                    },
                    {
                        label: "Email Address *",
                        name: "email",
                        required: "required",
                        type: "email"
                    },
                    {
                        label: "Contact No. *",
                        name: "contact_no",
                        required: "required",
                        type: "number"
                    },
                    {
                        label: "Question *",
                        name: "question_id",
                        required: "required",
                        type: "dropdown"
                    },
                    {
                        label: "Answer *",
                        name: "security_answer",
                        required: "required",
                        type: "text"
                    }
                ]
            }
        }
    }
</script>
