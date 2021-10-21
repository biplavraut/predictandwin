<template>
    <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left p-5">
                    <div class="brand-logo">
                        <!-- <img src="{{ url('assets/images/logo.svg') }}"> -->
                    </div>
                    <h4>Hello! let's get started</h4>
                    <h6 class="font-weight-light">Sign in to continue.</h6>
                    <form class="pt-3">
                        <div class="form-group">
                            <input
                                type="email"
                                class="form-control form-control-lg"
                                id="exampleInputEmail1"
                                placeholder="Email"
                                v-model="form.email"
                            />
                            <div class="text-danger" v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
                        </div>
                        <div class="form-group">
                            <input
                                type="password"
                                class="form-control form-control-lg"
                                id="exampleInputPassword1"
                                placeholder="Password"
                                v-model="form.password"
                            />
                            <div class="text-danger" v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
                        </div>
                        <div class="mt-3">
                            <a
                                href="#"
                                @click="submitLogin"
                                class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                >SIGN IN</a
                            >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Login",
    data() {
        return {
            form: new Form({
                email: "",
                password: "",
                device_name: window.navigator.userAgent
            }),
            errors: {}
        };
    },
    methods: {
        submitLogin() {
            this.$Progress.start(); //start a progress bar
            axios.get("/sanctum/csrf-cookie").then(response => {
                this.form
                    .post("/admin/login")
                    .then(response => {
                        if (response.data.token) {
                            axios.get('/admin/user').then((response) => {
                                window.user = response.data
                                localStorage.setItem("token", response.data.token);
                                location.href = "/backend"
                                // this.$router.push("dashboard");
                                // console.log(window.user);
                            }).catch(errors => {
                                localStorage.removeItem("token")
                                router.push('login')
                            })

                        } else {
                            alert('Invalid Login');
                            localStorage.setItem("token", false);
                        }
                    })
                    .catch(errors => {
                        this.errors = errors.response.data.errors;
                    });
            });

            this.$Progress.finish();
        }
    }
};
</script>

<style></style>
