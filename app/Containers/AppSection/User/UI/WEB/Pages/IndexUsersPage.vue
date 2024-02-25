<template>
    <v-card flat>
        <v-card-title class="d-flex align-center pe-2">
            Users

            <v-spacer></v-spacer>

            <v-text-field v-model="search" clearable label="Search" prepend-inner-icon="mdi-magnify" single-line variant="solo-filled" hide-details :loading="loading"></v-text-field>
        </v-card-title>

        <v-divider />

        <v-data-table-server :disable-sort="loading" hide-default-footer :items="users" item-value="name" :headers="headers" :items-length="pagination.total" :loading="loading" @update:options="applyTableOptions">
            <template #item="{ item }">
                <tr>
                    <td v-for="field in headers" :key="field.key">
                        {{ item[field.key] }}
                    </td>
                </tr>
            </template>
            <!--                <template #bottom>-->
            <!--                    <div class="text-center pt-2">-->
            <!--                        <v-pagination v-model="page" :length="pageCount"></v-pagination>-->
            <!--                    </div>-->
            <!--                </template>-->
        </v-data-table-server>
    </v-card>
</template>

<script setup lang="ts">
import type { PaginatedResponse } from '@ship/Js/Types/response';
import type { UserContract } from '@containers/AppSection/User/UI/WEB/Contracts/user.ts';
import type { ApiatoQueryString } from '@ship/Js/Types/shared-props';

defineProps<PaginatedResponse<UserContract>>();
const page = usePage<PaginatedResponse<UserContract>>();
const users = computed(() => page.props.data);
const pagination = computed(() => page.props.meta.pagination);
// const currentQuery = toRef(page.props.shared.query);
const search = ref(page.props.shared.query.search ?? '');

const loading = ref(false);
// const headers = computed(() => Object.keys(page.props.data[0] ?? {}));
const headers = ref([
    { title: 'Type', key: 'object', align: 'start' },
    { title: 'Identification', key: 'id' },
    { title: 'Name', key: 'name' },
    { title: 'Email', key: 'email' },
]);

interface TableSortBy {
    key: 'id';
    order: 'asc' | 'desc';
}
interface TableOptions {
    groupBy: string[];
    itemsPerPage: number;
    page: number;
    sortBy: TableSortBy[];
    search: undefined; // We use server side search so this is always undefined
}
function applyQuery(query: ApiatoQueryString): void {
    console.log(query);
    router.get(route('users.index'), query, {
        onStart: () => {
            loading.value = true;
        },
        preserveState: true,
        replace: true,
        onFinish: () => {
            loading.value = false;
        },
    });
}

function emptySearch(value: string | undefined | null): boolean {
    return value === undefined || value === '' || value === null;
}
function applyTableOptions($event: TableOptions) {
    const newQuery = { ...page.props.shared.query };

    newQuery.page = $event.page ?? 1;
    newQuery.limit = $event.itemsPerPage ?? 10;
    if ($event.sortBy.length > 0 && $event.sortBy[0]) {
        newQuery.orderBy = $event.sortBy[0].key;
        newQuery.sortedBy = $event.sortBy[0].order;
    }

    if (!emptySearch(search.value)) {
        const newQueryWithSearch = { ...newQuery, search: search.value };
        applyQuery(newQueryWithSearch);
    } else {
        applyQuery(newQuery);
    }
}

watch(search, (newValue) => {
    if (emptySearch(newValue)) {
        const newQuery = { ...page.props.shared.query };

        if (newQuery.search) delete newQuery.search;

        applyQuery(newQuery);
    } else {
        const newQuery = { ...page.props.shared.query, search: newValue };
        applyQuery(newQuery);
    }
});

// interface PaginationParams {
//     page: number;
//     limit: number;
//     orderBy: string;
//     sortedBy: string;
//     search: string;
// }
// interface QueryParams {}
</script>

<style scoped lang="scss"></style>
