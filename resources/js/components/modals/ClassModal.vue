<template>
<div class="d-inline">
    <button @click="createClass" class="btn btn-sm btn-danger">&plus; Add Class</button>
    <div class="modal fade" id="classModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form @submit.prevent="addClass">
                        <div class="form-group">
                            <label for="number">Class Number</label>
                            <input v-model="myclass.number" type="text" id="number" class="form-control" :class="{ 'is-invalid': myclass.errors.has('number') }">
                            <has-error class="font-weight-bold" :form="myclass" field="number"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="group">Class Group</label>
                            <input v-model="myclass.group" type="text" id="group" class="form-control" :class="{ 'is-invalid': myclass.errors.has('group') }">
                            <has-error class="font-weight-bold" :form="myclass" field="group"></has-error>
                        </div>
                        <button class="btn btn-sm btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            myclass: new Form({
                number: '',
                group: ''
            })
        }
    },
    methods: {
        createClass() {
            this.myclass.reset()
            this.myclass.errors.errors = ''
            $('#classModal').modal('show')
        },
        addClass() {
            this.myclass.post('api/myclass')
            .then((data) => {
                Fire.$emit('addClass')
                Fire.$emit('getData')
                $('#classModal').modal('hide')
            })
        }
    }
}
</script>

<style>

</style>
