<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        I'm an Audit Log component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AuditLog",
        mounted() {
            console.log('Audit Log Component mounted.')
        }
    }
</script>
