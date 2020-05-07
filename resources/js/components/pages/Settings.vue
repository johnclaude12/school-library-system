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
                <div class="card-body text-muted">
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <h5 class="font-weight-bold">Personal Info</h5>
                                        <div
                                            class="form-group"
                                            v-for="(item, $index) in items_col1"
                                            :key="$index"
                                        >
                                            <label :for="item.name">{{ item.label }}</label>
                                            <template v-if="item.name === 'user_image'">
                                                <div class="text-center">
                                                    <img
                                                        class="profile-user-img img-fluid img-circle"
                                                        :src="currentUser[item.name]"
                                                        alt="User profile picture"
                                                    >
                                                    <input
                                                        class="d-none"
                                                        :type="item.type"
                                                        :id="item.name"
                                                        :name="item.name"
                                                        :disabled="item.disabled"
                                                        @change="imageOnchage"
                                                    >
                                                    <label :for="item.name" class="form-control form-control-custom mt-2">
                                                        <i class="fas fa-upload"></i> Upload Image
                                                    </label>
                                                </div>
                                            </template>
                                            <template v-else-if="item.name === 'gender'">
                                                <select
                                                    class="form-control form-control-custom"
                                                    :class="errors[item.name] ? 'is-invalid' : ''"
                                                    :name="item.name"
                                                    :id="item.name"
                                                    :disabled="item.disabled"
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
                                                    :disabled="item.disabled"
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
                                                    :disabled="item.disabled"
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
                                                    :disabled="item.disabled"
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
                                                    :disabled="item.disabled"
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
                                    <button @click="onUpdate" type="button" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="option">
                            <form class="form-horizontal">
                                <div
                                    v-for="(item, $index) in options_items"
                                    :key="$index"
                                    class="form-group row"
                                >
                                    <label for="no_of_boook" class="col-sm-5 col-form-label">{{ item.label }}</label>
                                    <div class="col-sm-7">
                                        <input :type="item.type" class="form-control" :id="item.name" :name="item.name">
                                    </div>
                                </div>
                                <div class="form-group row col">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Save
                                    </button>
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
                currentUserID: '',
                errors: [],
                items_col1: [
                    {
                        label: "User Picture",
                        name: "user_image",
                        required: "required",
                        type: "file"
                    },
                    {
                        label: "Firstname *",
                        name: "firstname",
                        required: "required",
                        disabled: "disabled",
                        type: "text"
                    },
                    {
                        label: "Middlename *",
                        name: "middlename",
                        required: "required",
                        disabled: "disabled",
                        type: "text"
                    },
                    {
                        label: "Lastname *",
                        name: "lastname",
                        required: "required",
                        disabled: "disabled",
                        type: "text"
                    },
                    {
                        label: "Gender *",
                        name: "gender",
                        required: "required",
                        disabled: "disabled",
                        type: "dropdown"
                    },
                    {
                        label: "Date Of Birth *",
                        name: "birthday",
                        required: "required",
                        disabled: "disabled",
                        type: "date"
                    }
                ],
                items_col2: [
                    {
                        label: "User Type *",
                        name: "user_type_id",
                        required: "required",
                        disabled: "disabled",
                        type: "dropdown"
                    },
                    {
                        label: "Username *",
                        name: "username",
                        required: "required",
                        disabled: "disabled",
                        type: "text"
                    },
                    {
                        label: "Email Address *",
                        name: "email",
                        required: "required",
                        type: "email"
                    },
                    {
                        label: "Current Password *",
                        name: "current_password",
                        required: "required",
                        type: "password"
                    },
                    {
                        label: "New Password *",
                        name: "password",
                        required: "required",
                        type: "password"
                    },
                    {
                        label: "Confirm Password *",
                        name: "confirm_password",
                        required: "required",
                        type: "password"
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
                ],
                options_items: []
            }
        },
        created() {
            this.currentUserID = localStorage.getItem('userId');
            this.getCurrentUser();
            this.getAdminSettings();
        },
        methods: {
            getCurrentUser() {
                axios.get('api/user/'+ this.currentUserID)
                    .then(({ data }) => this.currentUser = data)
                    .catch(({ error }) => console.log("Error :", error))
            },
            getAdminSettings() {
                axios.get('api/admin_settings')
                    .then(({ data }) => this.options_items = data.data)
                    .catch(error => console.log("Error :", error))
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
                        this.errors = ""
                    })
                    .catch(error => {
                        this.$Progress.fail();
                        this.errors = error.response.data.errors;
                    })
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
    }
</script>
