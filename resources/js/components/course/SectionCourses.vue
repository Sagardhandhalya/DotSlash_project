<template>
<div>
    <div class="card">
        <div class="card-header font-weight-bold">
            Courses Related Section

        </div>
        <div class="card-body table-responsive">
            <h4 class="card-title" v-if="$gate.isAdmin()">Section {{section.name}} Class {{myclass.number}}</h4>
            <h4 class="card-title" v-if="$gate.isTeacher()">Courses Taken by Teacher</h4>
            <h6 class="card-title" v-if="$gate.isTeacher()"><small><strong>Name</strong> - {{teacher.name}}</small></h6>
            <h6 v-if="$gate.isStudent()"><strong>Class / Section</strong> - {{myclass.number+' / '+section.name}}</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Time</th>
                        <th v-if="$gate.isTeacher()">Section</th>
                        <th>Room</th>
                        <th v-if="$gate.isStudent()">Course Instructor</th>
                        <th v-if="$gate.isAdminOrTeacher()">Action</th>
                        <th v-if="$gate.isAdminOrTeacher()">All Students</th>
                        <th v-if="$gate.isTeacher()">Give Marks</th>
                        <th v-if="$gate.isTeacher()">View Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="course in courses" :key="course.id">
                        <td>{{course.id}}</td>
                        <td>{{course.name}}</td>
                        <td>{{course.time}}</td>
                        <td v-if="$gate.isTeacher()">{{course.class}} - {{course.section.name}}</td>
                        <td>{{$gate.isTeacher() ? course.section.room : section.room}}</td>
                        <td v-if="$gate.isStudent()">{{course.teacher.name}}</td>
                        <td v-if="$gate.isAdminOrTeacher()">
                            <router-link :to="'/attendance/'+course.section_id" class="btn btn-sm btn-dark"><i class="fas fa-pencil-alt"></i> Take Attendance</router-link>
                        </td>
                        <td v-if="$gate.isAdminOrTeacher()">
                            <router-link :to="'/course/'+course.id" class="btn btn-sm btn-outline-primary font-weight-bold"><i class="fas fa-envelope-open-text"></i> Course Material</router-link>
                        </td>
                        <td v-if="$gate.isTeacher()">
                            <router-link to="#" class="btn btn-sm btn-block btn-success"><i class="fas fa-chart-bar"></i> Submit Grade</router-link>
                        </td>
                        <td v-if="$gate.isTeacher()">
                            <router-link to="#" class="btn btn-sm btn-block btn-outline-danger font-weight-bold"><i class="fas fa-signal"></i> View Grades</router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">

        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            section_id : this.$route.params.id,
            teacher : window.user,
            courses: [],
            section: {},
            myclass: {}
        }
    },
    methods: {
        loadCourses() {
            if(this.$gate.isAdmin()) {
                axios.get('/api/getcourses/'+this.section_id)
                .then((data) => {
                    this.courses = data.data.courses
                    this.section = data.data.section
                    this.myclass = data.data.class
                })
            }
            if(this.$gate.isTeacher()) {
                axios.get('/api/teacher-courses/'+this.teacher.id)
                .then((data) => {
                    this.courses = data.data.courses
                })
            }
            if(this.$gate.isStudent()) {
                axios.get('/api/student-courses')
                .then((data) => {
                    this.courses = data.data.courses
                    this.section = data.data.section
                    this.myclass = data.data.class
                })
            }
        }
    },
    created() {
        this.loadCourses()
    }
}
</script>

<style>

</style>
