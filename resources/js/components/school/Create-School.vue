<template>
    <div class="px-2">
        <div v-if="$gate.isMaster()">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block btn-dark btn-lg" @click="createSchool">&plus; Create School</button>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">
                    School List
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Medium</th>
                            <th>Established Year</th>
                            <th>Actions</th>
                        </tr>
                        <tr v-for="(school, index) in schools" :key="index">
                            <td>{{school.id}}</td>
                            <td>{{school.name}}</td>
                            <td>{{school.medium}}</td>
                            <td>{{school.year}}</td>
                            <td>
                                <button class="btn btn-sm btn-dark" @click="editSchool(school)"><i class="far fa-edit" aria-hidden="true"></i> Edit School</button>
                                <button class="btn btn-sm btn-primary" @click="createUser(school.id)"><span class="badge badge-light"><i class="fa fa-user-plus" aria-hidden="true"></i></span> Create Admin</button>
                                <router-link :to="'admins/'+school.id" class="btn btn-sm btn-success"><i class="fas fa-users-cog"></i> View Admins</router-link>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer text-muted"></div>
            </div>
        </div>
        <div v-if="$gate.isAdmin()">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Manage Departments, Classs, Sections, Student Promotion, Course
                </div>
                <div class="card-body">
                    <p class="font-weight-bold">Manage Classes</p>
                    <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#departmentModal"><i class="fab fa-codepen"></i> Create Departments</button>
                    <DepartmentModal />
                    <button class="btn btn-sm btn-secondary" data-toggle="collapse" data-target="#classes"><i class="fas fa-tasks"></i> Manage Class, Sections</button>
                    <div id="classes" class="collapse mt-3">
                        <p class="font-weight-bold mb-1 d-inline-block">Add New Class</p>
                        <ClassModal class="ml-1" />
                        <br>
                        <p class="font-weight-bold mb-1 d-inline-block">Click Class to View All Sections</p>
                        <ClassList :departments="departments" />
                    </div>
                    <p class="font-weight-bold mt-3">Add Users</p>
                    <UserModal userRole="student" :sections="sections" />
                    <UserModal :departments="departments" :sections="sections" userRole="teacher" />
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
        <schoolmodal :editMode="editMode" :school="school" />
        <UserModal :user="user" :eMode="false" />
    </div>
</template>
<script>
import schoolmodal from '../modals/SchoolModal'
import UserModal from '../modals/UserModal'
import ClassModal from '../modals/ClassModal'
import DepartmentModal from '../modals/DepartmentModal'
import ClassList from './ClassList'

export default {
    components: { schoolmodal, UserModal, ClassModal, DepartmentModal, ClassList },
    data() {
        return {
            schools: [],
            editMode: false,
            school: new Form({
                id: '',
                name: '',
                medium: 'English',
                year: ''
            }),
            user: new Form({
                id: '',
                name: '',
                email: '',
                role: 'admin',
                gender: 'Male',
                school_id: '',
                password: ''
            }),
            departments: [],
            schools: [],
            sections: []
        }
    },
    methods: {
        getSchools() {
            axios.get('/api/school')
            .then((data) => {
                this.schools = data.data.schools
            })
        },
        resetSchool() {
            this.school.name = ''
            this.school.medium = "English",
            this.school.year = ''
        },
        resetUser() {
            this.user.name = '',
            this.user.email = '',
            this.user.password = ''
        },
        createUser(school_id) {
            this.resetUser()
            $('#userModal').modal('show')
            this.user.school_id = school_id

        },
        createSchool () {
            this.resetSchool()
            this.editMode = false
            $('#schoolmodal').modal('show')
        },
        editSchool(school) {
            this.editMode = true
            this.school.fill(school)
            $('#schoolmodal').modal('show')
        }
    },
    created() {
        Fire.$on('getSchools', () => {
            this.getSchools()
        })
        this.getSchools()
    }
}
</script>
