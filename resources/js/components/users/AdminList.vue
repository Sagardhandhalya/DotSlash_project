<template>
<div class="px-2">
    <div v-if="$gate.isMaster()">
        <router-link to="/create-school" class="btn btn-outline-success mb-3"><i class="fas fa-chevron-circle-left"></i> Back To Create-School</router-link>
        <div class="card">
            <div class="card-header">
                {{school.name}} <strong>Admins</strong>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Edit</th>
                        <th>Remove</th>
                    </tr>
                    <tr v-for="admin in admins" :key="admin.id">
                        <td>{{admin.id}}</td>
                        <td>{{admin.name}}</td>
                        <td>{{admin.email}}</td>
                        <td>{{admin.gender}}</td>
                        <td><button class="btn btn-sm btn-primary" @click="editUser(admin)">Edit Admin</button></td>
                        <td><button class="btn btn-sm btn-danger">Delete Admin</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <UserModal :user="user" :eMode="true" />
</div>
</template>

<script>
import UserModal from '../modals/UserModal'
export default {
    components: {
        UserModal
    },
    data() {
        return {
            id: this.$route.params.id,
            school: {},
            admins: [],
            user: new Form({
                id: '',
                name: '',
                email: '',
                gender: '',
                role: 'admin',
                school_id: ''
            })
        }
    },
    methods: {
        loadAdmins() {
            if(this.$gate.isMaster()) {
                axios.get('/api/school/'+this.id)
                .then((data) => {
                    this.admins = data.data.admins,
                    this.school = data.data.school
                })
            }
        },
        editUser(user) {
            this.user.fill(user)
            $('#userModal').modal('show')
        }
    },
    created() {
        this.loadAdmins()
        Fire.$on('updateAdmin', () => {this.loadAdmins()})
    }
}
</script>

<style>

</style>
