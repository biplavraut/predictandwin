<template>
<div>
    <Header></Header>
    <div class="container-fluid page-body-wrapper">
        <Sidebar></Sidebar>
        <div class="main-panel">
            <div class="content-wrapper">
                <vue-progress-bar></vue-progress-bar>
                <router-view :key="$route.fullPath"></router-view>
            </div>
            <Footer></Footer>
        </div>
    </div>
</div>
    
</template>

<script>
import Sidebar from './Layouts/Sidebar.vue';
import Header from './Layouts/Header.vue';
import Footer from './Layouts/Footer.vue';

export default {
    name: 'BackendLayout',
	components: {
      Sidebar,
      Header,
      Footer
    },
    date() {
        return {
            userData:{}
        }
    },
    methods: {
        
    },
    mounted() {
        // this.$Progress.start();
        // axios.get("/admin/user")
        //     .then(response => {
        //       this.userData = response.data;
        //     })
        //     .catch(errors => {
        //         localStorage.removeItem("token")
        //         this.$router.push('login')
        //     });

        // this.$Progress.finish();
    }
};
</script>