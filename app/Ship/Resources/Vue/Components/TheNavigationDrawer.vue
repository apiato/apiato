<template>
    <v-navigation-drawer permanent style="z-index: 2; height: 100%">
        <v-list nav>
            <v-list-item v-for="item in items" :key="item.title" :to="item.to" :prepend-icon="item.icon" nav class="text-start" :title="item.title" />
        </v-list>
    </v-navigation-drawer>
</template>

<script setup lang="ts">
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

const User: NavItem = {
    title: 'Users',
    icon: 'mdi-account-search',
    to: route('index-users'),
    children: [],
};

const items = [Dashboard, User];
</script>
