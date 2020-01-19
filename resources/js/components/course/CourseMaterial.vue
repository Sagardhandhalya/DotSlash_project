<template>
    <div>
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>
                <div class="card-tools">
                  <button class="btn btn-sm btn-dark" @click="createMaterial">Upload Material</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Message</th>
                      <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(x, index) in material" :key="index">
                      <td>{{x.id}}</td>
                      <td>{{x.message}}</td>
                      <td>{{x.created_at}}</td>
                      <td>
                          <a :href="course.name" download class="btn btn-sm btn-outline-primary">Download</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <MaterialModal :cid="id" />
    </div>
</template>

<script>
import MaterialModal from '../modals/Material'
export default {
    components: {MaterialModal},
    data() {
        return {
            id: this.$route.params.id,
            material: [],
            course: {}
        }
    },
    methods: {
        loadMaterial() {
            axios.get('/api/course/'+this.id)
            .then((data) => {
                console.log(data);
                
            })
        },
        createMaterial() {
            $('#mateModal').modal('show')
        }
    },
    mounted() {
        this.loadMaterial()
    }
}
</script>