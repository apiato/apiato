<template>
    <OrganismDataTable title="Users" :headers="headers" :items="users" />
</template>

<script setup lang="ts">
import type { PaginatedResponse } from '@ship/Js/Types/response';
import type { UserContract } from '@containers/AppSection/User/UI/WEB/Contracts/user.ts';

// TODO: when coming to a page, it calls page twice
// TODO: debounce search

defineProps<PaginatedResponse<UserContract>>();
const page = usePage<PaginatedResponse<UserContract>>();
const users = computed(() => page.props.data);
// const headers = computed(() => Object.keys(page.props.data[0] ?? {}));
const headers = [
    { title: 'Type', key: 'object', align: 'start' },
    { title: 'Identification', key: 'id' },
    { title: 'Name', key: 'name' },
    { title: 'Email', key: 'email' },
];
</script>
