<template>
    <div class="col grid-margin stretch-card">
        <b-card
            :header="edit ? 'Edit: ' + form.title : 'Add New Data'"
            header-tag="header"
            :footer="edit ? 'Updating data' : 'Adding Data'"
            footer-tag="footer"
            >
            <b-card-body v-if="$gate.isAuthorized()">
                <b-form  class="forms-sample" @submit.prevent="edit ? updateData() : addData()">
                    <b-form-group label="Title" label-for="inputTitle">
                        <b-form-input 
                            id="inputTitle" 
                            placeholder="Title" 
                            v-model="form.title" 
                            :class="{ 'is-invalid': form.errors.has('title') }" 
                            trim></b-form-input>
                        <div v-if="form.errors.has('title')" v-html="form.errors.get('title')" />
                        <!-- <has-error :form="form" field="title"></has-error> -->
                    </b-form-group> 
                    <b-form-group label="Image" label-for="inputImage">
                    <b-form-file
                        id="inputImage"
                        @change="imageUpload"
                        :state="Boolean(form.image)"
                        placeholder="Choose an Image or drop it here..."
                        drop-placeholder="Drop Image here..."
                        ></b-form-file>
                        <!-- <b-img :src="form.image" fluid alt="Responsive image"></b-img> -->
                        <div v-if="form.errors.has('image')" v-html="form.errors.get('image')" />
                    </b-form-group>
                    <b-form-group label="Excerpt" label-for="inputExcerpt">                    
                        <b-form-textarea
                            id="textarea"
                            v-model="form.excerpt"
                            placeholder="Enter short descripton..."
                            rows="4"
                            ></b-form-textarea>
                    </b-form-group>
                    <b-form-group>
                        <b-form-checkbox
                            v-model="form.display"
                            :checked="form.display"
                            >
                            Display?
                        </b-form-checkbox>
                        <b-form-checkbox
                            v-model="form.featured"
                            :checked="form.featured"
                            >
                            Featured?
                        </b-form-checkbox>
                    </b-form-group>
                    <b-button type="submit" class="btn btn-primary mr-2" variant="primary">Submit</b-button>
                    <b-button type="reset" class="btn btn-light" variant="danger">Cancel</b-button>
                </b-form>
            </b-card-body>
        </b-card>
    </div>
</template>

<script>
export default {
    /*Filling the data into form*/
    data() {
        return {
            edit: false,
            totalData: 0,
            data: {},
            form: new Form({
                id: "",
                title: "",
                slug: "",
                display: false,
                featured: false,
                image: "",
                excerpt: ""
            })
        };
    },
    methods: {
        imageUpload(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            if (file["size"] < 2111775) {
                reader.onloadend = file => {
                    this.form.image = reader.result;
                };
                reader.readAsDataURL(file);
            } else {
                swal.fire(
                    "Opps..!",
                    "Image file exceeds 2MB size limit.",
                    "warning"
                );
            }
        },

        // Add New Data
        addData() {
            this.$Progress.start(); //start a progress bar
            this.form
                .post("/admin/category") // POST form data
                .then(({ data }) => {
                    this.serverResponse(data);
                })
                .catch(() => {
                    swal.fire("Error!", "Something Went Wrong.", "warning");
                    this.$Progress.fail(); //End the progress bar
                });
            
        },

        // Update Data
        updateData(){
            this.$Progress.start();
            this.form
                .put('/admin/category/'+this.form.id)
                .then(({ data }) =>{
                    this.serverResponse(data);
                }).catch(()=>{
                    this.$Progress.fail();
                });
        },

        /*==== Start of Show existing User function ====*/
        loadData() {
            this.$Progress.start(); //start a progress bar
            if (this.$gate.isDevOrAdmin()) {
                axios
                    .get("/admin/category/" + this.$route.params.id)
                    .then(
                        response => (
                            (this.data = response),
                            this.form.fill(response.data.data)
                        )
                    );
            }
            this.$Progress.finish(); //End the progress bar
        }
        /*==== End of existing User ====*/
    },
    mounted() {
        this.edit = this.$route.params.hasOwnProperty("id");
        if (this.edit) {
            this.loadData();
        }
    },
    created() {
        Fire.$on("AfterCreate",()=>{
            this.$router.push({ name:"category.index" });
        })
    }
};
</script>

<style>
.nav-pills {
    border-bottom: none;
    padding-bottom: none;
}
</style>
