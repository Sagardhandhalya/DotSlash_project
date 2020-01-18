<template>
<div class="d-inline">
    <button type="button" class="btn btn-sm btn-success text-capitalize col-5 ml-1 float-left" @click="createUser">
        <i v-if="userRole == 'teacher'" class="fas fa-chalkboard-teacher"></i>
        <i v-if="userRole == 'student'" class="fas fa-user-graduate"></i>
        Add {{userRole}}
    </button>
    <div class="modal fade" :id="userRole+'modal'" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-capitalize font-weight-bold">Register {{userRole}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addUser">
                        <div class="form-row">
                            <div class="col-6">
                                <label for="uname">Name</label>
                                <input type="text" class="form-control" v-model="user.name" :class="{ 'is-invalid': user.errors.has('name') }">
                                <has-error class="font-weight-bold" :form="user" field="name"></has-error>
                            </div>
                            <div class="col-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" v-model="user.email" :class="{ 'is-invalid': user.errors.has('email') }">
                                <has-error class="font-weight-bold" :form="user" field="email"></has-error>
                            </div>
                        </div>
                        <div class="form-row mt-2" v-if="userRole == 'student'">
                            <div class="col-6">
                                <label for="uname">Father Name</label>
                                <input type="text" class="form-control" v-model="user.father_name" :class="{ 'is-invalid': user.errors.has('father_name') }">
                                <has-error class="font-weight-bold" :form="user" field="father_name"></has-error>
                            </div>
                            <div class="col-6">
                                <label for="email">Address</label>
                                <input type="text" class="form-control" v-model="user.address" :class="{ 'is-invalid': user.errors.has('address') }">
                                <has-error class="font-weight-bold" :form="user" field="address"></has-error>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-6" v-if="userRole == 'teacher'">
                                <label for="department">Department</label>
                                <select class="custom-select" v-model="user.department_id" :class="{ 'is-invalid': user.errors.has('department_id') }">
                                    <option :value="''">Select Department</option>
                                    <option v-for="department in departments" :key="department.id" :value="department.id">{{department.name}}</option>
                                </select>
                                <has-error class="font-weight-bold" :form="user" field="department_id"></has-error>
                            </div>
                            <div class="col-6" v-if="userRole == 'student'">
                                <label for="">Birthday</label>
                                <input type="date" class="form-control" v-model="user.birthdate" :class="{ 'is-invalid': user.errors.has('birthdate') }">
                                <has-error class="font-weight-bold" :form="user" field="birthdate"></has-error>
                            </div>
                            <div class="col-6">
                                <label for="section">Class {{userRole == 'teacher' ? 'Teacher' : '& Section'}}</label>
                                <select class="custom-select" v-model="user.section_id" :class="{ 'is-invalid': user.errors.has('section_id') }">
                                    <option :value="''" disabled>{{userRole == 'teacher' ? 'Not Class Teacher' : 'Class And Section'}}</option>
                                    <option v-for="section in sections" :key="section.id" :value="section.id">Section: {{section.name}} Class: {{section.class_number}}</option>
                                </select>
                                <has-error class="font-weight-bold" :form="user" field="section_id"></has-error>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-6">
                                <label for="gender">Gender</label>
                                <select class="custom-select" v-model="user.gender" :class="{ 'is-invalid': user.errors.has('gender') }">
                                    <option :value="''">Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                                <has-error class="font-weight-bold" :form="user" field="gender"></has-error>
                            </div>
                            <div class="col-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" v-model="user.password" :class="{ 'is-invalid': user.errors.has('password') }">
                                <has-error class="font-weight-bold" :form="user" field="password"></has-error>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-6">
                                <button class="btn btn-success btn-block">Register</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-danger btn-block" data-dismiss="modal">Cancel</button>
                            </div>
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
    props: {userRole: String, departments: Array, sections: Array},
    data() {
        return {
            user: new Form({
                name: '',
                father_name: '',
                address: '',
                email: '',
                password: '',
                gender: '',
                birthdate: '',
                department_id: '',
                section_id: '',
                role: this.userRole
            }),
        }
    },
    methods: {
        createUser() {
            this.user.reset()
            $('#'+this.userRole+'modal').modal('show')
        },
        addUser() {
            this.user.post('api/user')
            .then((data) => {
                $('#'+this.userRole+'modal').modal('hide')
            })
        }
    }
}
</script>

<style>

</style>
