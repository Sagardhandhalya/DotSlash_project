<template>
    <div>
        <div v-if="$gate.isMaster()">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <div class="card">
                        <div class="card-header">Manage School-List</div>
                        <div class="card-body">
                            <router-link to="/create-school" class="btn btn-danger btn-block btn-lg">Manage Schools</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="!$gate.isMaster()">
            <div class="card">
                <div class="card-body">
                    <h3>Welcome to {{school.name}}</h3>
                    Your presence and cooperation will help us to improve the education system of our
                    organization.
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
    data() {
        return {
            school_id: window.user.school_id,
            school: {}
        }
    },
    methods: {
        getSchool() {
            if(this.school_id > 0) {
                axios.get('api/school/'+this.school_id)
                .then((data) => {
                    this.school = data.data.school
                })
            }
        }
    },
    created() {
        this.getSchool()
    }
}
</script>
