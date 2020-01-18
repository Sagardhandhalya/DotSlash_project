<template>
<div>
    <router-link to="/classes" class="btn btn-outline-success mb-3"><i class="fas fa-chevron-circle-left"></i> Back To Class And Section</router-link>
    <div class="card">
        <div class="card-header">
            <h5>Section Students</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Grades</th>
                </tr>
                <tr v-for="(student, index) in students" :key="index">
                    <td>{{student.id}}</td>
                    <td>{{student.name}}</td>
                    <td>{{student.email}}</td>
                    <td>{{student.gender}}</td>
                    <td>
                        <router-link to="#" class="btn btn-sm btn-block btn-success">Grade History</router-link>
                    </td>
                </tr>
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
            section_id: this.$route.params.id,
            students: []
        }
    },
    methods: {
        loadStudents() {
            axios.get('/api/getstudents/'+this.section_id)
            .then((data) => {
                this.students = data.data.students
            })
        }
    },
    created() {
        this.loadStudents()
    }
}
</script>

