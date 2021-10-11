<template>
    <div class="col-lg-12 grid-margin stretch-card">
        <b-card
            :header="edit ? 'Edit: ' + form.name : 'Add New Data'"
            header-tag="header"
            :footer="edit ? 'Updating data' : 'Adding Data'"
            footer-tag="footer"
            >
            <b-card-body v-if="$gate.isAuthorized()">
                <b-form  class="forms-sample" @submit.prevent="edit ? updateData() : addData()">
                    <b-form-group label="Name" label-for="inputName">
                        <b-form-input 
                            id="inputName" 
                            placeholder="Full Name" 
                            v-model="form.name" 
                            :class="{ 'is-invalid': form.errors.has('name') }" 
                            trim></b-form-input>
                        <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                    </b-form-group>
                    <b-form-group label="Phone" label-for="inputPhone">
                        <b-form-input 
                            id="inputPhone" 
                            placeholder="Phone" 
                            v-model="form.phone" 
                            :class="{ 'is-invalid': form.errors.has('phone') }" 
                            trim></b-form-input>
                        <div v-if="form.errors.has('phone')" v-html="form.errors.get('phone')" />
                    </b-form-group>
                    <b-form-group label="Email" label-for="inputEmail">
                        <b-form-input 
                            id="inputEmail" 
                            placeholder="Email" 
                            v-model="form.email" 
                            :class="{ 'is-invalid': form.errors.has('email') }" 
                            trim></b-form-input>
                        <div v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
                    </b-form-group>
                    <b-form-group label="Password" label-for="inputPassword">
                        <b-form-input 
                            type="password"
                            id="inputPassword" 
                            placeholder="Password" 
                            v-model="form.password" 
                            :class="{ 'is-invalid': form.errors.has('password') }" 
                            trim></b-form-input>
                        <div v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
                    </b-form-group>
                    <b-form-group label="Confirm Password" label-for="inputConfirmPassword">
                        <b-form-input 
                            type="password"
                            id="inputConfirmPassword" 
                            placeholder="Confirm Password" 
                            v-model="form.confirmPassword" 
                            :class="{ 'is-invalid': form.errors.has('password') }" 
                            trim></b-form-input>
                        <div v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
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
                    <b-form-group label="GitHub" label-for="inputGithub">
                        <b-form-input 
                            id="inputGithub" 
                            placeholder="Github" 
                            v-model="form.github" 
                            :class="{ 'is-invalid': form.errors.has('github') }" 
                            trim></b-form-input>
                        <div v-if="form.errors.has('github')" v-html="form.errors.get('github')" />
                    </b-form-group>
                    <b-form-group label="Linkedin" label-for="inputLinkedin">
                        <b-form-input 
                            id="inputLinkedin" 
                            placeholder="Linkedin" 
                            v-model="form.linkedin" 
                            :class="{ 'is-invalid': form.errors.has('linkedin') }" 
                            trim></b-form-input>
                        <div v-if="form.errors.has('linkedin')" v-html="form.errors.get('linkedin')" />
                    </b-form-group>
                    <b-form-group label="Address" label-for="inputAddress">
                        <b-form-input 
                            id="inputAddress" 
                            placeholder="Address" 
                            v-model="form.address" 
                            :class="{ 'is-invalid': form.errors.has('address') }" 
                            trim></b-form-input>
                        <div v-if="form.errors.has('address')" v-html="form.errors.get('address')" />
                    </b-form-group>
                    <b-form-group label="Bio" label-for="inputBio">                    
                        <b-form-textarea
                            id="textarea"
                            v-model="form.bio"
                            placeholder="Enter short descripton..."
                            rows="4"
                            ></b-form-textarea>
                    </b-form-group>
                    <b-form-group>
                        <b-form-checkbox
                            v-model="form.display"
                            :checked="form.display"
                            >
                            Enabled?
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
                business_name:"",
                name: "",
                email: "",
                phone: "",
                image: "",
                enabled: false,
                type: "promoter",
                address: "",
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
            if (this.form.password == this.form.confirmPassword) {
                this.form
                    .post("/admin/admin") // POST form data
                    .then(({ data }) => {
                        this.serverResponse(data);
                    })
                    .catch(() => {
                        swal.fire("Error!", "Something Went Wrong.", "warning");
                        this.$Progress.fail(); //End the progress bar
                    });
            } else {
                swal.fire("Opps..!", "Passwords does not match", "warning");
                this.$Progress.fail();
            }
        },

        // Update Data
        updateData(){
            this.$Progress.start();
            this.form
                .put('/admin/admin/'+this.form.id)
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
                    .get("/admin/admin/" + this.$route.params.id)
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
