<template>
<div>
    <h4>List Of All Teachers / Students</h4>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#teachers">Teachers</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#students">Students</a></li>
            </ul>
            <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane container active" id="teachers">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Department</th>
                                <th>Courses</th>
                                <th v-if="$gate.isAdmin()">Action</th>
                            </tr>
                            <tr v-for="(teacher, index) in teachers" :key="index">
                                <td>{{teacher.id}}</td>
                                <td>{{teacher.name}}</td>
                                <td>{{teacher.email}}</td>
                                <td>{{teacher.gender}}</td>
                                <td>{{teacher.department.name}}</td>
                                <td>
                                    <router-link to="#" class="btn btn-sm btn-outline-success font-weight-bold btn-block">Courses</router-link>
                                </td>
                                <td v-if="$gate.isAdmin()">
                                    <button @click="editTeacher(teacher)" class="btn btn-sm btn-block btn-outline-primary font-weight-bold">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane container" id="students">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Father</th>
                                <th>Gender</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Attendance</th>
                                <th v-if="$gate.isAdmin()">Action</th>
                            </tr>
                            <tr v-for="(student, index) in students" :key="index">
                                <td>{{student.id}}</td>
                                <td>{{student.name}}</td>
                                <td>{{student.email}}</td>
                                <td>{{student.father_name}}</td>
                                <td>{{student.gender}}</td>
                                <td>{{student.section.class.number}}</td>
                                <td>{{student.section.name}}</td>
                                <td>
                                    <router-link to="#" class="btn btn-sm btn-outline-dark btn-block font-weight-bold">View Attendance</router-link>
                                </td>
                                <td v-if="$gate.isAdmin()">
                                    <button @click="editTeacher(student)" class="btn btn-sm btn-block btn-outline-success font-weight-bold">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form @submit.prevent="updateUser">
                        <div class="form-row">
                            <div class="col-3">
                                <label for="uname">Name</label>
                                <input id="uname" type="text" class="form-control" v-model="user.name" :class="{ 'is-invalid': user.errors.has('name') }">
                                <has-error class="font-weight-bold" :form="user" field="name"></has-error>
                            </div>
                            <div class="col-3">
                                <label for="email">Email</label>
                                <input id="email" type="text" class="form-control" v-model="user.email" :class="{ 'is-invalid': user.errors.has('email') }">
                                <has-error class="font-weight-bold" :form="user" field="email"></has-error>
                            </div>
                            <div class="col-3" v-if="userRole == 'teacher'">
                                <label for="depart">Department</label>
                                <select id="depart" class="custom-select" :class="{ 'is-invalid': user.errors.has('department_id') }">
                                    <option>{{user.department.name}}</option>
                                </select>
                                <has-error class="font-weight-bold" :form="user" field="department_id"></has-error>
                            </div>
                            <div class="col-3" v-if="userRole == 'student'">
                                <label for="fname">Father</label>
                                <input id="fname" type="text" class="form-control" v-model="user.father_name" :class="{ 'is-invalid': user.errors.has('father_name') }">
                                <has-error class="font-weight-bold" :form="user" field="father_name"></has-error>
                            </div>
                            <div class="col-3">
                                <label for="">Save / Update</label>
                                <button class="btn btn-block btn-dark">Update</button>
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
    data() {
        return {
            teachers: [],
            students: [],
            userRole: '',
            user: new Form({
                id: '',
                role: this.userRole,
                name: '',
                father_name: '',
                school_id: '',
                gender: '',
                email: '',
                department: {}
            })
        }
    },
    methods: {
        loadUsers() {
            axios.get('/api/getusers')
            .then((data) => {
                this.teachers = data.data.teachers
                this.students = data.data.students
            })
        },
        editTeacher(user) {
            this.user.errors.errors = ''
            this.userRole = user.role
            this.user.fill(user)
            $('#editUser').modal('show')
        },
        updateUser() {
            this.$Progress.start()
            this.user.put('/api/user/'+this.user.id)
            .then((data) => {
                this.loadUsers()
                $('#editUser').modal('hide')
                this.$Progress.finish()
            })
        }
    },
    created() {
        this.loadUsers()
    },
}
</script>

<style>

</style>
