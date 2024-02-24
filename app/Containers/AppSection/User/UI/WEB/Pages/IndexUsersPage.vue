<template>
    <v-card flat>
        <v-card-title class="d-flex align-center pe-2">
            Users

            <v-spacer></v-spacer>

            <v-text-field v-model="search" autofocus clearable label="Search" prepend-inner-icon="mdi-magnify" single-line variant="solo-filled" hide-details :loading="loading"></v-text-field>
        </v-card-title>

        <v-divider />

        <v-data-table-server :disable-sort="loading" hide-default-footer :items="users" item-value="name" :headers="headers" :items-length="pagination.total" :loading="loading" @update:options="options">
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

defineProps<PaginatedResponse<UserContract>>();
const page = usePage<PaginatedResponse<UserContract>>();
const users = computed(() => page.props.data);
const pagination = page.props.meta.pagination;

const loading = ref(false);
const search = ref(page.props.shared.query.search);
watch(search, (value) => {
    if (value === '') {
        const query = { ...page.props.shared.query };
        delete query.search;
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
    } else {
        router.get(route('users.index'), { search: value }, { preserveState: true, replace: true });
    }
});
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
    search: string;
    sortBy: TableSortBy[];
    // sortDesc: [false];
    // mustSort: true;
}

function options($event: TableOptions) {
    const query = { ...page.props.shared.query };
    query.page = $event.page ?? 1;
    query.limit = $event.itemsPerPage ?? 10;
    if ($event.sortBy.length > 0) {
        query.orderBy = $event.sortBy[0].key;
        query.sortedBy = $event.sortBy[0].order;
    }
    query.search = $event.search;
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

// const items: Data[] = ref([]);
// const currentPage = ref(1);
// const indexData = () =>
//     axios.get(route('index-users', {})).then((res: Response) => {
//         console.log(res);
//         items.value.values = res.items;
//         if (currentPage.value > res.meta.pagination.total_pages) {
//             currentPage.value = 1;
//         }
//     });

// const headers = computed(() => [
//     // use user field keys as headers
//     ...Object.keys(props.response.data[0]).map((key) => ({
//         text: key,
//         value: key,
//     })),
// ]);
</script>

<style scoped lang="scss"></style>
