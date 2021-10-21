<template>
    <div class="col-lg-12 grid-margin stretch-card">
        <b-card :footer="'Showing '+ data.data.length + ' data of '+ totalData"
                footer-tag="footer" no-body>
            <b-card-header>
                <b-row>
                    <b-col>
                    <h4 class="card-title">Partner List</h4>
                    <p class="card-description">
                        Total partners <code>{{ totalData }}</code>
                    </p>
                    </b-col>
                    <b-col>
                    <b-nav class="nav-pills justify-content-end">
                    <b-nav-item
                        :to="{ name: 'partner.create' }"
                        class="mr-2 mr-md-0"
                        link-classes="py-2 px-3">
                        <span class="d-none d-md-block"><i class="ti-plus"></i> Add New Partner</span>
                        <span class="d-md-none"><i class="ti-plus"></i> Add</span>
                        </b-nav-item>
                    </b-nav>
                    </b-col>
                </b-row>
            </b-card-header>
            
            <b-table :items="data.data" :fields="fields" sticky-header="500px" head-variant="dark" outlined striped responsive="sm" v-if="$gate.isAuthorized()">
                <template #cell(images)="row">
                        <b-img :src="row.item.image" fluid alt="Responsive image"></b-img>
                </template>
                <template #cell(created_at)="row">
                    <i>{{ row.item.created_at | myDate }}</i>
                </template>
                <template #cell(actions)="row">
                    <router-link
                        :to="{
                            name: 'partner.edit',
                            params: { id: row.item.id }
                        }"
                        class="btn btn-sm btn-success"
                        ><span class="d-none d-md-block"
                            ><i class="ti-pencil"></i>
                            Edit</span
                        >
                        <span class="d-md-none"
                            ><i class="ti-pencil"></i></span
                    ></router-link>
                    <a href="#" class="btn btn-sm btn-danger">
                        <span class="d-none d-md-block"
                            ><i class="ti-trash"></i>
                            Delete</span
                        >
                        <span class="d-md-none"
                            ><i class="ti-trash"></i
                        ></span>
                    </a>
                </template>
            </b-table>
            <pagination
                class="justify-content-center"
                :data="data"
                @pagination-change-page="getResults"
            ></pagination>
        </b-card>
    </div>
</template>

<script>
export default {
    /*Filling the data into form*/
    data() {
        return {
            totalData: 0,
            fields: ['images','business_name','name','email','phone','type','enabled','created_at','actions'],
            data: { data: []},
            form: new Form({
                id: ""
            })
        };
    },
    methods: {
        /*===== Start of pagination function =====*/
        getResults(page = 1) {
            axios.get("/admin/partner?page=" + page).then(response => {
                this.data = response.data;
            });
        },

        /*==== Call Delete Modal uith user id ====*/
        deleteAdmin(id) {
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                //send an ajax request to the server
                if (result.value) {
                    this.form
                        .delete("/admin/partner/" + id)
                        .then(({ data }) => {
                            this.serverResponse(data);
                        })
                        .catch(() => {
                            swal.fire(
                                "Error!",
                                "Something Went wrong!",
                                "error"
                            );
                        });
                }
            });
        },
        /*==== End of Delete Modal ====*/

        /*==== Start of Show existing User function ====*/
        loadData() {
            if (this.$gate.isDevOrAdmin()) {
                axios
                    .get("/admin/partner")
                    .then(
                        ({ data }) => (
                            (this.data = data),
                            (this.totalData = data.meta.total)
                        )
                    );
            }
        }
        /*==== End of existing User ====*/
    },
    created() {
        // Fire.$on("searching", () => {
        //     let query = this.$parent.search; //take information from root
        //     axios
        //         .get("/admin/findAdmin?q=" + query)
        //         .then(data => {
        //             this.admins = data.data;
        //         })
        //         .catch(() => {});
        // });
        this.loadData(); //load the user in the table
        //Load the data if add or created a new user
        Fire.$on("AfterCreate", () => {
            this.loadData();
        });
    }
};
</script>

<style>
.nav-pills {
    border-bottom: none;
    padding-bottom: none;
}
</style>
