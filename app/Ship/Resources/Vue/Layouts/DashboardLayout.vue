<template>
    <v-app id="the-app">
        <v-layout class="rounded rounded-md">
            <v-app-bar title="GESG Carbon Registry" />
            <TheNavigationDrawer />
            <v-main class="d-flex align-center justify-center" style="min-height: 300px">
                <slot />
                Main Content
            </v-main>
        </v-layout>
    </v-app>
</template>
<script lang="ts" setup></script>

<style lang="scss"></style>
