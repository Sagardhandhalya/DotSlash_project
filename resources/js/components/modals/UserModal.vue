<template>
    <div>
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Create Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addUser">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="uname"><b>Name</b></label>
                                    <input type="text" id="uname" class="form-control" v-model="user.name" :class="{ 'is-invalid': user.errors.has('name') }">
                                    <has-error class="font-weight-bold" :form="user" field="name"></has-error>
                                </div>
                                <div class="form-group col-6">
                                    <label for="email"><b>Email</b></label>
                                    <input type="text" id="email" class="form-control" v-model="user.email" :class="{ 'is-invalid': user.errors.has('email') }">
                                    <has-error class="font-weight-bold" :form="user" field="email"></has-error>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="gender"><b>Gender</b></label>
                                    <select class="custom-select" id="gender" v-model="user.gender" :class="{ 'is-invalid': user.errors.has('gender') }">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                    <has-error class="font-weight-bold" :form="user" field="gender"></has-error>
                                </div>
                                <div class="form-group col-6" v-if="!eMode">
                                    <label for="password"><b>Password</b></label>
                                    <input type="password" id="password" class="form-control" v-model="user.password" :class="{ 'is-invalid': user.errors.has('password') }">
                                    <has-error class="font-weight-bold" :form="user" field="password"></has-error>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button v-if="!eMode" type="button" class="btn btn-dark btn-block" @click="addUser">Submit</button>
                        <button v-if="eMode" type="button" class="btn btn-dark btn-block" @click="updateUser">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {user: Object, eMode: Boolean},
    methods: {
        addUser() {
            this.user.post('/api/user')
            .then((data) => {
                $('#userModal').modal('hide')
                Toast.fire({
                    icon: 'success',
                    title: 'User Created Successfully.'
                })
            })
        },
        updateUser() {
            this.user.put('/api/user/'+this.user.id)
            .then((data) => {
                $('#userModal').modal('hide')
                Toast.fire({
                    icon: 'success',
                    title: 'User Updated Successfully.'
                })
            })
        }
    },
    
}
</script>