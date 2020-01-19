<template>
    <div>
        <div class="card">
            <div class="card-header">
                Change Password
            </div>
            <div class="card-body">
                <div class="form-group col-6">
                  <label for="pass">Current Password</label>
                  <input v-model="cred.password" type="password" id="pass" class="form-control" :class="{ 'is-invalid': cred.errors.has('password') }">
                    <has-error class="font-weight-bold" :form="cred" field="password"></has-error>
                </div>
                <div class="form-group col-6">
                  <label for="npass">New Password</label>
                  <input v-model="cred.newpassword" type="password" id="npass" class="form-control" :class="{ 'is-invalid': cred.errors.has('newpassword') }">
                    <has-error class="font-weight-bold" :form="cred" field="newpassword"></has-error>
                </div>
                <div class="form-group col-6">
                  <label for="cpass">Confirm New Password</label>
                  <input type="password" v-model="cred.confirmpassword" id="cpass" class="form-control" :class="{ 'is-invalid': cred.errors.has('confirmpassword') }">
                    <has-error class="font-weight-bold" :form="cred" field="confirmpass"></has-error>
                </div>
            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-sm btn-outline-primary font-weight-bold" @click="changePass">Save Password</button>
                <router-link to="/home" class="btn btn-sm btn-danger">Cancel And Go Back</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cred: new Form({
                password: '',
                newpassword: '',
                confirmpassword: ''
            })
        }
    },
    methods: {
        changePass() {
            this.cred.post('/api/changepassword')
            .then((data) => {
                Toast.fire({
                    icon: 'success',
                    title: 'Password Changed Successfully.'
                })
                this.reset()
            })
        },
        reset() {
            this.cred.password = '',
            this.cred.newpassword = '',
            this.cred.confirmpassword = ''
        }
    }
}
</script>