<template>
    <v-card>
        <v-card-title>
            <h3 class="text-h3">Users</h3>
        </v-card-title>
        <v-card-text>
            <v-data-table v-model:sort-by="sortBy" :on-update:options="options" :items="props.data" item-value="id">
                <!--                <DataTableToolbar :title="dataTableTitle">-->
                <!--                    <template #search>-->
                <!--                        <DataTableSearchBox v-model:search-query="searchQuery" :loading="isSearching" />-->
                <!--                    </template>-->
                <!--                </DataTableToolbar>-->
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
import type { PaginatedResponse } from '@/types/response';

const props = defineProps<PaginatedResponse>();
const userFields = computed(() => Object.keys(props.data[0]));

const options = reactive({
    sortBy: [],
    sortDesc: [false],
    mustSort: true,
    page: 1,
    itemsPerPage: 10,
});
const sortBy = ref([{ key: 'id', order: 'asc' }]);
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

// onMounted(indexData);

// const prepareGetAllURL = (payload: object, defaultUrl: string, includes: string | string[]) => {
//     const params = new URLSearchParams();
//
//     if (payload.searchQuery) params.set('search', payload.searchQuery);
//     if (payload.orderBy) params.set('orderBy', payload.orderBy);
//     if (payload.sortedBy) params.set('sortedBy', payload.sortedBy);
//     params.set('page', payload.currentPage ?? 1);
//     params.set('limit', payload.perPage ?? 2000);
//     if (payload.withIncludes && !!includes) {
//         if (Array.isArray(includes)) {
//             params.set('include', includes.join(','));
//         } else {
//             params.set('include', includes);
//         }
//     }
//
//     let url = `/${defaultUrl}?${params.toString()}`;
//
//     if (payload.additionalParams?.length) {
//         payload.additionalParams.forEach((param) => {
//             url += `&${param}`;
//         });
//     }
//
//     return url;
// };

// const FakeAPI = {
//     async fetch({ page, itemsPerPage, sortBy }) {
//         return new Promise((resolve) => {
//             setTimeout(() => {
//                 const start = (page - 1) * itemsPerPage;
//                 const end = start + itemsPerPage;
//                 const items = desserts.slice();
//                 if (sortBy.length) {
//                     const sortKey = sortBy[0].key;
//                     const sortOrder = sortBy[0].order;
//                     items.sort((a, b) => {
//                         const aValue = a[sortKey];
//                         const bValue = b[sortKey];
//                         return sortOrder === 'desc' ? bValue - aValue : aValue - bValue;
//                     });
//                 }
//                 const paginated = items.slice(start, end);
//                 resolve({ items: paginated, total: items.length });
//             }, 500);
//         });
//     },
// };
// const itemsPerPage = ref(5);
// const search = ref('');
// const serverItems = ref([]);
// const loading = ref(true);
// const totalItems = ref(0);
// function loadItems({ page, itemsPerPage, sortBy }) {
//     loading.value = true;
//     FakeAPI.fetch({ page, itemsPerPage, sortBy }).then(({ items, total }) => {
//         serverItems.value = items;
//         totalItems.value = total;
//         loading.value = false;
//     });
// }

// const headers = computed(() => [
//     // use user field keys as headers
//     ...Object.keys(props.response.data[0]).map((key) => ({
//         text: key,
//         value: key,
//     })),
// ]);
</script>

<style scoped lang="scss"></style>
