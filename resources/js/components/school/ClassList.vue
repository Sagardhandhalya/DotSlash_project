<template>
<div class="d-inline ml-1">
    <div class="d-inline" v-for="myclass in classes" :key="myclass.id">
        <button type="button" class="btn btn-sm btn-danger" @click="manageClass(myclass.id)">
            Manage {{myclass.number+' '+myclass.group}}
        </button>
        <div class="modal fade" :id="'classModal'+myclass.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sections Of Class {{myclass.number}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group mb-2">
                            <li class="list-group-item" v-for="(section, index) in myclass.sections" :key="index">
                                <strong>Section {{section.name}}</strong>
                                <router-link :to="'courses/'+section.id" data-dismiss="modal" class="btn btn-sm btn-outline-primary font-weight-bold ml-2"><i class="fas fa-project-diagram"></i> View All Assigned Courses</router-link>
                                <button class="btn btn-sm btn-success float-right" data-toggle="collapse" :data-target="'#courseform'+section.id"><i class="fas fa-location-arrow"></i> Add New Courses</button>
                                <div :id="'courseform'+section.id" class="collapse mt-3">
                                    <form @submit.prevent="addCourse(section.id, myclass.id)">
                                        <div class="form-row">
                                            <div class="col-12">
                                                <label for="course-name">Course Name</label>
                                                <input class="form-control" type="text" id="course-name" v-model="course.name" :class="{ 'is-invalid': course.errors.has('name') }">
                                                <has-error class="font-weight-bold" :form="course" field="name"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-row mt-2">
                                            <div class="col-6">
                                                <label for="tdepart">Teacher Department</label>
                                                <select id="tdepart" class="custom-select" v-model="course.department_id" @change="getTeachers()" :class="{ 'is-invalid': course.errors.has('teacher_department') }">
                                                    <option :value="''" disabled>Select Teacher Department</option>
                                                    <option v-for="department in departments" :key="department.id" :value="department.id">{{department.name}}</option>
                                                </select>
                                                <has-error class="font-weight-bold" :form="course" field="department_id"></has-error>
                                            </div>
                                            <div class="col-6">
                                                <label for="teacher">Teacher</label>
                                                <select id="teacher" class="custom-select" v-model="course.teacher_id" :class="{ 'is-invalid': course.errors.has('teacher_id') }">
                                                    <option :value="''" disabled>Select Department First</option>
                                                    <option v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">{{teacher.name}}</option>
                                                </select>
                                                <has-error class="font-weight-bold" :form="course" field="teacher_id"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-row mt-2">
                                            <div class="col-12">
                                                <label for="time">Time</label>
                                                <input type="text" id="time" class="form-control" v-model="course.time" :class="{ 'is-invalid': course.errors.has('time') }">
                                                <small id="helpId" class="text-muted">Example: 12:50PM-01:40PM Sunday</small>
                                                <has-error class="font-weight-bold" :form="course" field="time"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col-12">
                                                <button class="btn btn-success btn-block">Add Course</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                        <button class="btn btn-dark col-12" data-toggle="collapse" :data-target="'#sectionform'+myclass.id">Create New Section</button>
                        <div class="card collapse mt-2" :id="'sectionform'+myclass.id">
                            <div class="card-body">
                                <form @submit.prevent="addSection">
                                    <div class="form-row">
                                        <div class="col-5">
                                            <label for="name">Section Name</label>
                                            <input type="text" :id="myclass.id+'name'" class="form-control" :class="{ 'is-invalid': section.errors.has('name') }" v-model="section.name">
                                            <has-error class="font-weight-bold" :form="section" field="name"></has-error>
                                        </div>
                                        <div class="col-5">
                                            <label for="room">Room Number</label>
                                            <input type="text" :id="myclass.id+'room'" class="form-control" :class="{ 'is-invalid': section.errors.has('room') }" v-model="section.room">
                                            <has-error class="font-weight-bold" :form="section" field="room"></has-error>
                                        </div>
                                        <div class="col-2">
                                            <label for="">Add Section</label>
                                            <button class="btn btn-danger btn-block">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {departments: Array},
    data() {
        return {
            classes: [],
            section: new Form({
                name: '',
                room: '',
                class_id: '',
            }),
            course: new Form({
                name: '',
                department_id: '',
                teacher_id: '',
                section_id: '',
                time: ''
            }),
            teachers: []
        }
    },
    methods: {
        loadClass() {
            axios.get('/admin-data')
            .then((data) => {
                this.classes = data.data.classes
            })
        },
        manageClass(id) {
            this.section.reset()
            this.section.class_id = id
            this.section.errors.errors = ''
            $('#classModal'+id).modal('show')
        },
        addSection() {
            this.section.post('api/section')
            .then((data) => {
                $('#classModal'+this.section.class_id).modal('hide')
                this.loadClass()
                $('#sectionform'+data.data.id).collapse('hide')
                Fire.$emit('getData')
            })
        },
        getTeachers() {
            axios.get('api/department-teacher/'+this.course.department_id)
            .then((data) => {
                this.teachers = data.data.teachers
            })
        },
        addCourse(sid, cid) {
            this.course.section_id = sid
            this.course.post('api/course')
            .then((data) => {
                $('#courseform'+sid).collapse('hide')
                $('#classModal'+cid).modal('hide')
                this.course.reset()
            })
        }
    },
    created() {
        this.loadClass()
        Fire.$on('addClass', () => {
            this.loadClass()
        })
    }
}
</script>

<style>

</style>
