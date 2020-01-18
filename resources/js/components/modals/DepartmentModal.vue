<template>
    <div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form @submit.prevent="addDepartment">
                        <div class="form-group">
                            <label for="name">Department Name</label>
                            <input v-model="department.name" type="text" id="name" class="form-control" :class="{ 'is-invalid': department.errors.has('name') }" placeholder="Science, Commerce..">
                            <has-error class="font-weight-bold" :form="department" field="name"></has-error>
                        </div>
                        <button class="btn btn-sm btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            department: new Form({
                name: ''
            }),
        }
    },
    methods: {
        addDepartment() {
            this.department.post('api/adddepartment')
            .then((data) => {
                $('#departmentModal').modal('hide')
                this.department.reset()
                Fire.$emit('getData')
            })
        }
    },
}
</script>

<style>

</style>
