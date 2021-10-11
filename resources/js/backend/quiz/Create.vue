<template>
<b-row>
    <b-col cols="8">
        <div class="col-lg-12 grid-margin stretch-card">
        <b-card
            :header="edit ? 'Edit: ' + form.title : 'Add New Data'"
            header-tag="header"
            :footer="edit ? 'Updating data' : 'Adding Data'"
            footer-tag="footer"
            >
            <b-card-body v-if="$gate.isAuthorized()">
                <b-form  class="forms-sample" @submit.prevent="edit ? updateData() : addData()">
                    <b-form-group label="Question" label-for="inputTitle">
                        <b-form-input 
                            id="inputTitle" 
                            placeholder="Question" 
                            v-model="form.title" 
                            :class="{ 'is-invalid': form.errors.has('title') }" 
                            trim></b-form-input>
                        <div v-if="form.errors.has('title')" v-html="form.errors.get('title')" />
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
                    <b-form-group label="Category" label-for="inputCategory">
                        <b-form-select 
                            v-model="form.category_id" 
                            :options="categories">
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="Partner" label-for="inputPartner">
                        <b-form-select 
                            v-model="form.partner_id" 
                            :options="partners">
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="Difficulty" label-for="inputDifficulty">
                        <b-form-select 
                            v-model="form.difficulty" 
                            :options="difficulty">
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="Point" label-for="inputPoint">
                        <b-form-input 
                            type="number"
                            id="inputPoint" 
                            placeholder="Point" 
                            v-model="form.point" 
                            :class="{ 'is-invalid': form.errors.has('point') }" 
                            ></b-form-input>
                        <div v-if="form.errors.has('point')" v-html="form.errors.get('point')" />
                    </b-form-group>
                    <b-form-group label="Premium Point" label-for="inputPremiumPoint">
                        <b-form-input 
                            type="number"
                            id="inputPremiumPoint" 
                            placeholder="Premium Point" 
                            v-model="form.premium_point" 
                            :class="{ 'is-invalid': form.errors.has('premium_point') }" 
                            ></b-form-input>
                        <div v-if="form.errors.has('premium_point')" v-html="form.errors.get('premium_point')" />
                    </b-form-group>
                    <b-form-group label="Start At" label-for="inputStartAt">
                        <b-form-datepicker v-model="form.start_at" locale="en"></b-form-datepicker>
                    </b-form-group>
                    <b-form-group label="End At" label-for="inputEndAt">
                        <b-form-datepicker v-model="form.end_at" locale="en"></b-form-datepicker>
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
                        <b-form-checkbox
                            v-model="form.daily"
                            :checked="form.daily"
                            >
                            Daily?
                        </b-form-checkbox>
                        <b-form-checkbox
                            v-model="form.take_a_quiz"
                            :checked="form.take_a_quiz"
                            >
                            Take a Quiz?
                        </b-form-checkbox>
                    </b-form-group>
                    <b-form-group label="Excerpt" label-for="inputExcerpt">                    
                        <b-form-textarea
                            id="textarea"
                            v-model="form.excerpt"
                            placeholder="Enter short descripton..."
                            rows="4"
                            ></b-form-textarea>
                    </b-form-group>
                    
                    <b-button type="submit" class="btn btn-primary mr-2" variant="primary">Submit</b-button>
                    <b-button type="reset" class="btn btn-light" variant="danger">Cancel</b-button>
                </b-form>
            </b-card-body>
        </b-card>
    </div>
    </b-col>
    <b-col>
        <b-card
            :header="edit ? 'Options: ' + form.title : 'Add New Options'"
            header-tag="header"
            :footer="edit ? 'Updating options' : 'Adding Options'"
            footer-tag="footer"
            >
            <b-card-body v-if="$gate.isAuthorized()">
                <b-form  class="forms-sample">
                    <b-form-group>
                        <b-form-input id="option-form-input" v-model="oForm.title" placeholder="Answer"></b-form-input>
                        <br>
                        <b-form-checkbox v-model="oForm.is_answer" class="mb-2 mr-sm-2 mb-sm-0">is Answer?</b-form-checkbox>
                        <b-button size="sm" @click="addOption()" variant="primary">Add</b-button>
                    </b-form-group>
                    <br>
                    <b-form-group label="Optons" v-slot="{ ariaDescribedby }">
                        <b-form-radio-group
                            v-model="form.answer"
                            :options="form.options"
                            :aria-describedby="ariaDescribedby"
                            name="radios-stacked"
                            stacked
                        ></b-form-radio-group>
                    </b-form-group>
                </b-form>
            </b-card-body>
        </b-card>
    </b-col>
</b-row>
    
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
                title:"",
                slug: "",
                image: "",
                category_id: "",
                partner_id: "",
                daily: true,
                take_a_quiz: true,
                difficulty: null,
                point: "",
                premium_point:"",
                display: true,
                featured: true,
                start_at:"",
                end_at:"",
                excerpt: "",
                answer: '',
                options: []
            }),
            difficulty: [
                { value: null, text: 'Please select an option', disabled: true  },
                { value: 'easy', text: 'Easy' },
                { value: 'moderate', text: 'Moderate' },
                { value: 'hard', text: 'Hard'}
            ],
            categories:[],
            partners:[],
            oForm: new Form({
                is_answer: false,
                title:'',
                quiz_id:'',
            }),
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
                .post("/admin/quiz") // POST form data
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
                .put('/admin/quiz/'+this.form.id)
                .then(({ data }) =>{
                    this.serverResponse(data);
                }).catch(()=>{
                    this.$Progress.fail();
                });
        },
        addOption(){
            const alphabet = "abcdefghijklmnopqrstuvwxyz"
            const value = alphabet[Math.floor(Math.random() * alphabet.length)]
            if(this.oForm.is_answer){
                this.form.answer = value;
            }
            this.form.options.push({text: this.oForm.title, value: value})
            this.oForm.reset();
        },

        /*==== Start of Show existing User function ====*/
        loadData() {
            this.$Progress.start(); //start a progress bar
            if (this.$gate.isDevOrAdmin()) {
                axios
                    .get("/admin/quiz/" + this.$route.params.id)
                    .then(
                        response => (
                            (this.data = response),
                            this.form.fill(response.data.data),
                            this.oForm.quiz_id = this.form.id
                        )
                    );
            }
            this.$Progress.finish(); //End the progress bar
        },
        /*==== End of existing User ====*/

        getCategory(){
            axios
                .get("/admin/select-category")
                .then(
                    response => (
                        (this.categories = response.data.data)
                    )
                );
        },
        getPartner(){
            axios
                .get("/admin/select-partner")
                .then(
                    response => (
                        (this.partners = response.data.data)
                    )
                );
        },
    },
    mounted() {
        this.edit = this.$route.params.hasOwnProperty("id");
        if (this.edit) {
            this.loadData();
        }
    },
    created() {
        Fire.$on("AfterCreate",()=>{
            this.$router.push({ name:"quiz.index" });
        })
        this.getCategory();
        this.getPartner();
    }
};
</script>

<style>
.nav-pills {
    border-bottom: none;
    padding-bottom: none;
}
</style>
