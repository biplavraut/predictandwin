<template>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <router-link
                :to="navItem.url"
                custom v-slot="{ href, route, navigate, isExactActive  }"
                v-for="(navItem, key) in navItems"
                :key="key"
                >
                <li
                    :class="{
                        'nav-item': true,
                        active: isActive(navItem.url.name)
                    }"
                >
                    <a :href="href" class="nav-link" @click="navigate" :title="route.fullPath"><i :class="navItem.icon +' menu-icon'"></i>
                    <span class="menu-title">{{ navItem.title }}</span></a>
                </li>
            </router-link>
            <!-- <router-link
                :to="{name:'setting'}"
                v-slot="{ href, route, navigate, isActive }"
                custom
                >
                <li
                    :class="isActive ? 'nav-item active':'nav-item'"
                >
                    <a :href="href" class="nav-link" @click="navigate" :title="route.fullPath"><i class="ti-settings menu-icon"></i>
                    <span class="menu-title">Setting</span></a>
                </li>
            </router-link> -->
            
            <!-- <router-link
                :to="{name:'prediction.index'}"
                v-slot="{ href, route, navigate, isActive }"
                custom
                >
                <li
                    :class="isActive ? 'nav-item active':'nav-item'"
                >
                    <a :href="href" class="nav-link" @click="navigate" :title="route.fullPath"><i class="ti-thought menu-icon"></i>
                    <span class="menu-title">Prediction</span></a>
                </li>
            </router-link> -->
        </ul>
    </nav>
</template>
<script>
export default {
    data() {
        return {
            navItems: [
                {
                    title: "Dashboard",
                    icon: "ti-home",
                    url: { name: "dashboard" },
                    children: [],
                },
                {
                    title: "Admin User",
                    icon: "ti-user",
                    url: { name: "admin.index" },
                    children: [],
                },
                {
                    title: "Category",
                    icon: "ti-view-list",
                    url: { name: "category.index" },
                    children: [],
                },
                {
                    title: "Partner",
                    icon: "ti-crown",
                    url: { name: "partner.index" },
                    children: [],
                },
                {
                    title: "Predict and Win",
                    icon: "ti-pulse",
                    url: { name: "quiz.index" },
                    children: [],
                },
                {
                    title: "Custom Ads",
                    icon: "ti-announcement",
                    url: { name: "ads.index" },
                    children: [],
                },
            ],
        }        
    },
    methods: {
        isActive(url) {
            return this.$route.name.includes(url);
        // if (this.$route.name !== null) return this.$route.name.includes(url);
        //     return false;
        },
    },
}
</script>