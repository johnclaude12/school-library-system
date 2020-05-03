<template>
    <div>
        <div class="modal fade" :id="this.modalName" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">{{ this.modalTitle }}</h5>
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

                                    <template v-if="item.name === 'image_id'">
                                        <input
                                            class="form-control form-control-custom"
                                            :type="item.type"
                                            :id="item.name"
                                            :name="item.name"
                                            v-model="userData[item.name]"
                                        >
                                    </template>
                                    <template v-else-if="item.name === 'gender'">
                                        <select
                                            class="form-control form-control-custom"
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
                                            class="form-control form-control-custom "
                                            :type="item.type"
                                            :id="item.name"
                                            :name="item.name"
                                            v-model="userData[item.name]"
                                        >
                                    </template>

                                    <span role="alert" class="invalid-feedback">
                                        <strong :name="item.name"></strong>
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
                                    <template v-if="item.name === 'question_id'">
                                        <select
                                            class="form-control form-control-custom"
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
                                            :type="item.type"
                                            :id="item.name"
                                            :name="item.name"
                                            v-model="userData[item.name]"
                                        >
                                    </template>

                                    <span role="alert" class="invalid-feedback">
                                        <strong :name="item.name"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button class="btn btn-secondary p-18" data-dismiss="modal">Cancel</button>
                        <button @click="this.onSubmit" type="submit" class="btn btn-primary btn-new-position"><i class="fas fa-save mr-1"></i>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserModal",
        props: ['modalName', 'modalTitle'],
        data() {
            return {
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
                },
                items_col1: [
                    {
                        label: "Picture *",
                        name: "image_id",
                        required: "required",
                        type: "text"
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
        },
        methods: {
            onSubmit() {
                console.log("Data :", this.userData)
            }
        }
    }
</script>

<style scoped>

</style>
