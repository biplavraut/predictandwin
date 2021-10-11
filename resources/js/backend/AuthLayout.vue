<template>
<div>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <vue-progress-bar></vue-progress-bar>
        <router-view></router-view>
    </div>
</div>    
</template>

<script>
export default {
    name: 'AuthLayout'
};
</script>