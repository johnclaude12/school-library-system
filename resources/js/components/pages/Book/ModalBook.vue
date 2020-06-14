<template>
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
                                    :class="errors[item.name] ? 'is-invalid' : ''"
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
                                        :class="errors[item.name] ? 'is-invalid' : ''"
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
                                        :class="errors[item.name] ? 'is-invalid' : ''"
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
                    <button
                        v-if="!editMode"
                        type="submit"
                        class="btn btn-primary btn-new-position"
                        @click="submitBook"
                    ><i class="fas fa-save mr-1"></i>Save</button>
                    <button
                        v-if="editMode"
                        type="submit"
                        class="btn btn-primary"
                        @click="onUpdate"
                    ><i class="fas fa-pen mr-1"></i>Update</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModalBook",
        props: ['bookData', 'book_categories', 'errors', 'submitBook', 'editMode', 'onUpdate'],
        data() {
            return {
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
                        label: "Total Copies*",
                        name: "total_copies",
                        required: "required",
                        type: "number"
                    },{
                        label: "Price*",
                        name: "price",
                        required: "required",
                        type: "number"
                    },
                ],
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
