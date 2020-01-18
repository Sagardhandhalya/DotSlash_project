<template>
    <div>
        <div class="modal fade" id="schoolmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{editMode ? 'Updating' : 'Adding'}} School</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="editMode ? updateSchool : addSchool">
                        <div class="form-group">
                            <label for="sname"><b>Name</b></label>
                            <input type="text" id="sname" class="form-control" placeholder="eg. St. Xavier's School" v-model="school.name" :class="{ 'is-invalid': school.errors.has('name') }">
                            <has-error class="font-weight-bold" :form="school" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="medium"><b>Medium</b></label>
                            <select class="custom-select" id="medium" v-model="school.medium" :class="{ 'is-invalid': school.errors.has('medium') }">
                                <option>English</option>
                                <option>Gujarati</option>
                                <option>Hindi</option>
                            </select>
                            <has-error :form="school" field="medium"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="year"><b>Year</b></label>
                            <input type="text" id="year" class="form-control" placeholder="eg. 2000, 2001, .." v-model="school.year" :class="{ 'is-invalid': school.errors.has('year') }">
                            <has-error class="font-weight-bold" :form="school" field="year"></has-error>
                        </div>
                        <div class="form-group">
                            <button v-if="!editMode" @click="addSchool" class="btn btn-dark btn-block">Save</button>
                            <button v-if="editMode" @click="updateSchool" class="btn btn-dark btn-block">Update</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {editMode: Boolean,school: Object},
    data() {
        return {
            
        }
    },
    methods: {
        addSchool() {
            this.school.post('/api/school')
            .then((data) => {
                Fire.$emit('getSchools')
                $('#schoolmodal').modal('hide')
            })
        },
        updateSchool() {
            this.school.put('/api/school/'+this.school.id)
            .then((data) => {
                Fire.$emit('getSchools')
                $('#schoolmodal').modal('hide')
            })
        }
    }
}
</script>
