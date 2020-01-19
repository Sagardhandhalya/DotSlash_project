<template>
    <div>
        <div class="modal fade" id="mateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Message">
                    </div>
                    <div class="form-group">
                        <label for="file">Upload Material</label>
                      <input type="file" id="file" @change="setFile">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="addMaterial">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {cid: String},
    data() {
        return {
            mate: new Form({
                name: '',
                message: '',
                course_id: ''
            })
        }
    },
    methods: {
        addMaterial() {
            this.mate.course_id = this.cid
            this.mate.post('/api/uploadmaterial/'+this.cid)
            .then((data) => {

            })
        },
        setFile(e) {
            let file = e.target.files[0];
            this.mate.name = file
        }
    }
}
</script>