<template>
    <v-card>
        <v-card-title>
            <h3 class="text-h3">Users</h3>
        </v-card-title>
        <v-card-text>
            <v-data-table :items="users" item-value="name">
                <template #item="{ item }">
                    <tr>
                        <td v-for="field in userFields" :key="field">
                            {{ item[field] }}
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script setup lang="ts">
const props = defineProps({
    users: {
        type: Array,
        required: true,
    },
});

const headers = computed(() => [
    // use user field keys as headers
    ...Object.keys(props.users[0]).map((key) => ({
        text: key,
        value: key,
    })),
]);
const userFields = computed(() => Object.keys(props.users[0]));
</script>

<style lang="scss"></style>
