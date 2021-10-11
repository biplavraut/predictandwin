<template>
    <div class="col grid-margin stretch-card d-none d-md-flex">
        <b-card :header="'Hello,'+ form.name"
                header-tag="header" 
                :footer="'Profile'"
                footer-tag="footer">
                <b-row>
                    <b-col cols="9">
                        <div class="tab-content tab-content-vertical">
                            <div
                                class="tab-pane fade show active"
                                id="user-info-detail"
                                role="tabpanel"
                                aria-labelledby="user-info"
                            >
                                <h4>Contact</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>
                                            <a :href="'tel:' + form.phone"></a
                                            ><i class="ti-mobile text-info"></i>
                                            &nbsp;{{ form.phone }}
                                        </p>
                                        <p>
                                            <a :href="'mailto:' + form.email"
                                                ><i
                                                    class="ti-email text-success"
                                                ></i></a
                                            >&nbsp;{{ form.email }}
                                        </p>
                                        <p>
                                            <b>Social:</b>
                                            <br />
                                            <a
                                                :href="form.github"
                                                target="_blank"
                                                title="GitHub"
                                                ><i
                                                    class="ti-github text-dark"
                                                ></i
                                            ></a>
                                            &nbsp; &nbsp;
                                            <a
                                                :href="form.linkedin"
                                                target="_blank"
                                                title="LinkedIn"
                                                ><i
                                                    class="ti-linkedin text-primary"
                                                ></i
                                            ></a>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            {{ form.bio }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <img
                                                class="mr-3 w-25 mb-4"
                                                :src="form.image"
                                                alt="sample image"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="edit-profile"
                                role="tabpanel"
                                aria-labelledby="edit-profile"
                            >
                                <h4>Edit Your Profile</h4>
                                <b-row>
                                    <b-col cols="8">
                                        <p class="card-description">
                                            ({{ form.email }}) Email update
                                            restricted*
                                        </p>
                                    </b-col>
                                    <b-col cols="4">
                                        <div class="text-center">
                                            <img
                                                class="mr-3 w-25 mb-4"
                                                :src="form.image"
                                                alt="Profile Image"
                                            />
                                        </div>
                                    </b-col>
                                </b-row>
                                <b-form  class="forms-sample" @submit.prevent="submitProfile">
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
                                    <b-button type="submit" class="btn btn-primary mr-2" variant="primary">Submit</b-button>
                                    <b-button type="reset" class="btn btn-light" variant="danger">Cancel</b-button>
                                </b-form>
                                    
                            </div>
                            <div
                                class="tab-pane fade"
                                id="change-password"
                                role="tabpanel"
                                aria-labelledby="password-tab-vertical"
                            >
                                <h4>Update Password</h4>
                                <p class="card-description">
                                    At least 8 characters*
                                </p>
                                <form
                                    class="forms-sample"
                                    @submit.prevent="updatePassword"
                                >
                                    <div class="form-group">
                                        <label for="exampleInputOldPassword1"
                                            >Old Password</label
                                        >
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="exampleInputOldPassword1"
                                            v-model="cpForm.old_password"
                                            placeholder="Old Password"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1"
                                            >Password</label
                                        >
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="exampleInputPassword1"
                                            v-model="cpForm.password"
                                            placeholder="Password"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="exampleInputConfirmPassword1"
                                            >Confirm Password</label
                                        >
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="exampleInputConfirmPassword1"
                                            v-model="cpForm.confirm_password"
                                            placeholder="Confirm Password"
                                        />
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn btn-primary mr-2"
                                    >
                                        Submit
                                    </button>
                                    <button class="btn btn-light">
                                        Cancel
                                    </button>
                                </form>
                            </div>
                        </div>
                    </b-col>
                    <b-col cols="3">
                        <ul
                            class="nav nav-tabs nav-tabs-vertical"
                            role="tablist"
                        >
                            <li class="nav-item">
                                <a
                                    class="nav-link active"
                                    id="user-info"
                                    data-toggle="tab"
                                    href="#user-info-detail"
                                    role="tab"
                                    aria-controls="user-info-detail"
                                    aria-selected="false"
                                >
                                    Info
                                    <i class="ti-user text-success ml-2"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    id="edit-profile"
                                    data-toggle="tab"
                                    href="#edit-profile"
                                    role="tab"
                                    aria-controls="edit-profile"
                                    aria-selected="true"
                                >
                                    Edit Profile
                                    <i class="ti-pencil text-info ml-2"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    id="password-tab-vertical"
                                    data-toggle="tab"
                                    href="#change-password"
                                    role="tab"
                                    aria-controls="change-password"
                                    aria-selected="false"
                                >
                                    Change Password
                                    <i class="ti-key text-danger ml-2"></i>
                                </a>
                            </li>
                        </ul>
                    </b-col>
                </b-row>
        </b-card>
    </div>
</template>
<script>
export default {
    data() {
        return {
            welcome: "Welcome to Dashboard",
            form: new Form({
                id: "",
                name: "",
                email: "",
                email_verified_at: "",
                phone: "",
                image: "https://via.placeholder.com/300x300",
                enabled: "",
                type: "",
                github: "",
                linkedin: "",
                address: "",
                bio: "",
                created_by: "",
                created_at: "",
                updated_at: "",
                updated_by: ""
            }),
            cpForm: new Form({
                old_password: "",
                password: "",
                confirm_password: ""
            })
        };
    },
    methods: {
        getProfile() {
            this.$Progress.start(); //start a progress bar
            axios
                .get("/admin/user")
                .then(response => {
                    this.userData = response.data;
                    this.form.fill(response.data.data);
                })
                .catch(errors => {
                    localStorage.removeItem("token");
                    this.$router.push("login");
                });

            this.$Progress.finish();
        },
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
        submitProfile() {
            this.$Progress.start();
            this.form
                .put("/admin/profile")
                .then(({ data }) => {
                    this.serverResponse(data);
                })
                .catch(() => {
                    this.Progress.fail();
                });
            this.$Progress.finish();
        },
        updatePassword() {
            this.$Progress.start();
            if (this.cpForm.password == this.cpForm.confirm_password) {
                //Start Condition to check form is validate
                this.cpForm
                    .post("/admin/updatePassword")
                    .then(({ data }) => {
                        this.serverResponse(data);
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail(); //End the progress bar
                    });
            } else {
                swal.fire("Opps..!", "Passwords does not match", "warning");
                this.$Progress.fail();
            }
        }
    },
    mounted() {},
    created() {
        this.getProfile();
    }
};
</script>
<style>
.el-table .cell {
    padding-left: 0px;
    padding-right: 0px;
}
</style>
