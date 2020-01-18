<template>
    <div>
        <h4>All Classes And Sections</h4>
        <div class="card" v-for="cl in classes" :key="cl.id">
            <div class="card-body py-2">
                <p class="d-inline">Class {{cl.number}} {{cl.group}}
                    <button class="btn btn-sm btn-primary float-right" data-toggle="collapse" :data-target="'#section'+cl.id"><i class="fas fa-arrow-circle-down"></i> Click To View All Sections Under This Class</button>
                </p>
                <div class="collapse mt-2" :id="'section'+cl.id">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Section Name</th>
                                <th>View Courses</th>
                                <th>View Students</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="section in cl.sections" :key="section.id">
                                <td>{{section.name}}</td>
                                <td>
                                    <router-link :to="'/courses/'+section.id" class="btn btn-sm btn-secondary"><i class="far fa-eye"></i> View Courses Under Section</router-link>
                                </td>
                                <td>
                                    <router-link :to="'/students/'+section.id" class="btn btn-sm btn-success"><i class="fas fa-user-graduate"></i> View Students Under This Section</router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            classes: []
        }
    },
    methods: {
        loadClass() {
            axios.get('admin-data')
            .then((data) => {
                this.classes = data.data.classes
            })
        },
    },
    created() {
        this.loadClass()
    }
}
</script>

<style>

</style>
