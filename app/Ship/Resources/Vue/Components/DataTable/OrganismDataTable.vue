<template>
    <v-card>
        <MoleculeDataTableToolbar v-model:search="search" :title="title" :loading="loading" />
        <v-divider />
        <v-data-table-server :disable-sort="loading" hide-default-footer :items="items" item-value="name" :headers="headers" :items-length="pagination.total" :loading="loading" @update:options="applyTableOptions">
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

<script setup lang="ts" generic="T extends object">
// https://vuejs.org/api/sfc-script-setup.html#generics
// https://stackoverflow.com/questions/70542599/how-to-type-a-generic-component-in-vue-3s-script-setup
import type { ApiatoQueryString } from '@ship/Js/Types/shared-props';
import type { PaginatedResponse } from '@ship/Js/Types/response';
import type { VDataTable } from 'vuetify/components';

// https://stackoverflow.com/a/75993081 <- This is the best way to type the headers
// https://stackoverflow.com/a/77876055
// https://github.com/vuetifyjs/vuetify/issues/16897
type ReadonlyHeaders = VDataTable['$props']['headers'];
type UnwrapReadonlyArray<A> = A extends Readonly<(infer I)[]> ? I : never;
type ReadonlyDataTableHeader = UnwrapReadonlyArray<ReadonlyHeaders>;

// https://stackoverflow.com/questions/68602712/extracting-the-prop-types-of-a-component-in-vue-3-typescript-to-use-them-somew
// type ExtractSetupProps<T> = T extends { setup?(props: infer P, ...rest: any[]): any } ? (P extends any ? P : never) : never;
// type ExtractConstructedProps<T> = T extends { new (...args: any[]): { $props: infer X } } ? (X extends Record<string, any> ? X : never) : never;
// export type PublicPropsOf<T> = Pick<ExtractConstructedProps<T>, keyof ExtractSetupProps<T>>;

const page = usePage<PaginatedResponse<T>>();
const pagination = computed(() => page.props.meta.pagination);
// const currentQuery = toRef(page.props.shared.query);
const search = ref(page.props.shared.query.search ?? '');
const loading = ref(false);

interface HeaderKey {
    key: keyof T;
}

defineProps({
    title: {
        type: String,
        default: '',
    },
    items: {
        type: Array as PropType<T[]>,
        default: () => [],
    },
    headers: {
        type: Array as PropType<ReadonlyDataTableHeader[] & HeaderKey[]>,
        required: true,
    },
});

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
    const currentQuery = page.props.shared.query;
    const newQuery = { ...page.props.shared.query };

    if (currentQuery.page !== $event.page) {
        newQuery.page = $event.page ?? 1;
    }

    if (currentQuery.limit !== $event.itemsPerPage) {
        newQuery.limit = $event.itemsPerPage ?? 10;
    }

    if ($event.sortBy.length > 0 && $event.sortBy[0]) {
        if ($event.sortBy[0].key !== currentQuery.orderBy) {
            newQuery.orderBy = $event.sortBy[0].key;
        }
        if ($event.sortBy[0].order !== currentQuery.sortedBy) {
            newQuery.sortedBy = $event.sortBy[0].order;
        }
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
        // Resets current pagination options
        // const newQuery = {};
        // applyQuery(newQuery);
        // Keeps current pagination options
        const newQuery = { ...page.props.shared.query };
        if (newQuery.page) delete newQuery.page;
        if (newQuery.search) delete newQuery.search;
        applyQuery(newQuery);
    } else {
        // Resets current pagination options
        // const newQuery = { search: newValue };
        // Keeps current pagination options
        const newQuery = { ...page.props.shared.query, search: newValue };
        if (newQuery.page) delete newQuery.page;
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
