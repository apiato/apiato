<template>
    <v-card-title class="d-flex align-center pe-2">
        {{ title }}
        <v-spacer></v-spacer>
        <v-text-field v-model="search" :disabled="loading" clearable label="Search" prepend-inner-icon="mdi-magnify" single-line variant="solo-filled" hide-details :loading="loading" />
    </v-card-title>
</template>

<script setup lang="ts">
defineProps({
    title: {
        type: String,
        default: '',
    },
    loading: {
        type: Boolean,
        default: false,
    },
});
const search = defineModel('search', {
    type: String,
    required: true,
});
</script>
