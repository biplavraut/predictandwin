<template>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    {{ edit ? "Edit " + form.name : "Add New Data" }}
                </h4>
            </div>
            <div class="card-body" v-if="$gate.isAuthorized()">
                <form class="forms-sample" @submit.prevent="addData">
                    <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input
                            type="text"
                            class="form-control"
                            id="exampleInputTitle"
                            v-model="form.title"
                            placeholder="Title"
                        />
                    </div>
                    
                    <div class="form-check">
                        <label class="form-check-label">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                v-model="form.enabled"
                                :checked="form.enabled"
                            />
                            Display
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                v-model="form.enabled"
                                :checked="form.enabled"
                            />
                            Featured
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input
                            type="file"
                            class="file-upload-default"
                            @change="imageUpload"
                        />
                        <div class="input-group col-xs-12">
                            <input
                                type="text"
                                class="form-control file-upload-info"
                                disabled
                                placeholder="Upload Image"
                            />
                            <span class="input-group-append">
                                <button
                                    class="file-upload-browse btn btn-primary"
                                    type="button"
                                >
                                    Upload
                                </button>
                            </span>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="exampleTextarea1">Excerpt</label>
                        <textarea
                            class="form-control"
                            id="exampleTextarea1"
                            v-model="form.excerpt"
                            rows="4"
                        ></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">
                        Submit
                    </button>
                    <button class="btn btn-light">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
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
    created() {}
};
</script>

<style>
.nav-pills {
    border-bottom: none;
    padding-bottom: none;
}
</style>
