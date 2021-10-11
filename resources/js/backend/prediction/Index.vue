<template>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h4 class="card-title">Prediction List</h4>
                        <p class="card-description">
                            Total <code>{{ totalData }}</code>
                        </p>
                    </div>
                    <div class="col">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0">
                                <router-link
                                    :to="{ name: 'prediction.create' }"
                                    class="nav-link py-2 px-3"
                                >
                                    <span class="d-none d-md-block"
                                        ><i class="ti-plus"></i> Add New
                                        Prediction</span
                                    >
                                    <span class="d-md-none"
                                        ><i class="ti-plus"></i> Add</span
                                    >
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body" v-if="$gate.isAuthorized()">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Display - Featured</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in data.data" :key="row.id">
                                <td>{{ index+1 }}</td>
                                <td class="py-2">
                                    <img :src="row.image" alt="image" />
                                </td>
                                <td>{{ row.title }}</td>
                                <td>{{ row.slug }}</td>
                                <td>
                                    <span class="tag tag-success">{{
                                        row.display +' - '+ row.featured
                                    }}</span>
                                </td>
                                <td>{{ row.created_at | myDate }}</td>
                                <td>
                                    <router-link
                                        :to="{
                                            name: 'admin.edit',
                                            params: { id: row.id }
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
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <b-row>
                    <b-col>
                        <span>Showing Data of {{ this.totalData }}.</span>
                    </b-col>
                    <b-col class="justify-content-end">
                        <pagination
                            :data="data"
                            @pagination-change-page="getResults"
                        ></pagination>
                    </b-col>
                </b-row>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    /*Filling the data into form*/
    data() {
        return {
            totalData: 0,
            data: {},
            form: new Form({
                id: ""
            })
        };
    },
    methods: {
        /*===== Start of pagination function =====*/
        getResults(page = 1) {
            axios.get("/admin/category?page=" + page).then(response => {
                this.data = response.data;
            });
        },

        /*==== Call Delete Modal uith user id ====*/
        deleteData(id) {
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
                        .delete("/admin/category/" + id)
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
                    .get("/admin/category")
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
