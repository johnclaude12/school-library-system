<template>
    <div>
        <div class="modal fade" id="user_modal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">{{ this.editMode ? 'Edit User' : 'Register User' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div class="modal-body text-muted">
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
                                                :src="userData[item.name]"
                                                alt="User profile picture"
                                            >
                                            <input
                                                class="d-none"
                                                :type="item.type"
                                                :id="item.name"
                                                :name="item.name"
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
                                            v-model="userData[item.name]"
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
                                            v-model="userData[item.name]"
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
                                            v-model="userData[item.name]"
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
                                            v-model="userData[item.name]"
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
                                            v-model="userData[item.name]"
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
                        <button class="btn btn-secondary p-18" data-dismiss="modal">Cancel</button>
                        <template v-if="!editMode">
                            <button @click="this.onSubmit" type="button" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Save
                            </button>
                        </template>

                        <template v-else>
                            <button @click="this.onUpdate" type="button" class="btn btn-primary">
                                <i class="fas fa-edit mr-1"></i> Update
                            </button>
                        </template>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserModal",
        props: ['editMode', 'modalName', 'userData', 'onSubmit', 'onUpdate', 'imageOnchage', 'getUserImage', 'errors'],
        data() {
            return {
                items_col1: [
                    {
                        label: "",
                        name: "user_image",
                        required: "required",
                        type: "file"
                    },
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
                        label: "Password *",
                        name: "password",
                        required: "required",
                        type: "password"
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

<style scoped>

</style>
