<template>
    <div class="modal fade" id="modalCategory" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-muted">
                    <div class="form-group">
                        <label>Category</label>
                        <input
                            id="category"
                            name="category"
                            type="text"
                            required="required"
                            v-model="categoryData.category"
                            class="form-control form-control-custom"
                        >
                            <!-- :class="errors['category'] ? 'is-invalid' : ''"
                        <span role="alert" :class="errors['category'] ? 'invalid-feedback d-block' : ''">
                            <strong v-if="errors['category']" >{{ errors['category'][0] }}</strong>
                        </span> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-primary"
                        @click="submitCategory"
                    ><i class="fas fa-save mr-1"></i> Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BookCategory",
        props: ['categoryData', 'submitCategory', 'errors'],
    }
</script>

<style lang="scss" scoped>

</style>
