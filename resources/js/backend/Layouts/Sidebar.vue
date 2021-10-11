<template>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <router-link
                :to="{name:'dashboard'}"
                v-slot="{ href, route, navigate, isActive }"
                custom
                >
                <li
                    :class="isActive ? 'nav-item active':'nav-item'"
                >
                    <a :href="href" class="nav-link" @click="navigate" :title="route.fullPath"><i class="ti-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span></a>
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
            <router-link
                :to="{name:'admin.index'}"
                v-slot="{ href, route, navigate, isActive }"
                custom
                >
                <li
                    :class="isActive ? 'nav-item active':'nav-item'"
                >
                    <a :href="href" class="nav-link" @click="navigate" :title="route.fullPath"><i class="ti-user menu-icon"></i>
                    <span class="menu-title">Admin</span></a>
                </li>
            </router-link>
            <router-link
                :to="{name:'category.index'}"
                v-slot="{ href, route, navigate, isActive }"
                custom
                >
                <li
                    :class="isActive ? 'nav-item active':'nav-item'"
                >
                    <a :href="href" class="nav-link" @click="navigate" :title="route.fullPath"><i class="ti-view-list menu-icon"></i>
                    <span class="menu-title">Category</span></a>
                </li>
            </router-link>
            <router-link
                :to="{name:'partner.index'}"
                v-slot="{ href, route, navigate, isActive }"
                custom
                >
                <li
                    :class="isActive ? 'nav-item active':'nav-item'"
                >
                    <a :href="href" class="nav-link" @click="navigate" :title="route.fullPath"><i class="ti-crown menu-icon"></i>
                    <span class="menu-title">Partner</span></a>
                </li>
            </router-link>
            <router-link
                :to="{name:'quiz.index'}"
                v-slot="{ href, route, navigate, isActive }"
                custom
                >
                <li
                    :class="isActive ? 'nav-item active':'nav-item'"
                >
                    <a :href="href" class="nav-link" @click="navigate" :title="route.fullPath"><i class="ti-pulse menu-icon"></i>
                    <span class="menu-title">Quiz</span></a>
                </li>
            </router-link>
            <router-link
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
            </router-link>
        </ul>
    </nav>
</template>
<script>
export default {
    
}
</script>