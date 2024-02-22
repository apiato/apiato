<template>
    <v-app id="the-app">
        <v-app-bar title="GESG Carbon Registry" />
        <TheNavigationDrawer />
        <v-main class="d-flex align-center justify-center" style="min-height: 300px">
            <v-container fluid>
                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>
<script lang="ts" setup></script>

<style lang="scss"></style>
