<!--<template>-->
<!--    <v-navigation-drawer permanent>-->
<!--        <v-list density="compact" nav>-->
<!--            <v-list-item prepend-icon="mdi-view-dashboard" title="Home" value="home"></v-list-item>-->
<!--            <v-list-item prepend-icon="mdi-forum" title="About" value="about"></v-list-item>-->
<!--        </v-list>-->
<!--    </v-navigation-drawer>-->
<!--</template>-->
<template>
    <v-navigation-drawer permanent style="z-index: 2; height: 100%">
        <v-list nav>
            <v-list-item v-for="item in items" :key="item.title" :prepend-icon="item.icon" nav class="text-start" :title="item.title" link :to="item.to"> </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup lang="ts">
import route from 'ziggy-js';

interface NavItem {
    title: string;
    icon: string;
    to: string;
    children: this[];
}

const Dashboard: NavItem = {
    title: 'Dashboard',
    icon: 'mdi-view-dashboard',
    to: route('login'),
    children: [],
};

const Staff: NavItem = {
    title: 'Staff',
    icon: 'mdi-account-search',
    to: route('home-page'),
    children: [],
};

const items = [Dashboard, Staff];
</script>

<style scoped>
/* Style of example of submenu implementation
.ml-sub-drawer {
    margin-left: 256px;
}
*/
</style>
