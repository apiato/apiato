<template>
    <!--        :right="$vuetify.rtl"-->
    <v-navigation-drawer
        app
        dark
        permanent
        stateless
        style="z-index: 2; height: 100%"
    >
        <v-list nav>
            <v-list-item
                v-for="item in items"
                :key="item.title"
                link
                :to="item.to"
            >
                <v-list-item-icon>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-item-icon>
                <v-list-item-content class="text-start">
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>

    <!-- Example of submenu implementation -->

    <!--        <v-navigation-drawer v-if="currentlySelectedMenuItem && currentlySelectedMenuItem.items?.length" id="nav2"-->
    <!--                             v-model="rightMenu" absolute class="ml-sub-drawer" dark style="z-index:1" temporary>-->
    <!--            <v-list nav>-->
    <!--                <v-list-item>-->
    <!--                    <v-list-item-content>-->
    <!--                        <v-list-item-title class="title text-start">-->
    <!--                            {{ currentlySelectedMenuItem.title }}-->
    <!--                        </v-list-item-title>-->
    <!--                    </v-list-item-content>-->
    <!--                    <v-btn icon @click="closeSubMenu">-->
    <!--                        <v-icon>{{ 'mdi-close' }}</v-icon>-->
    <!--                    </v-btn>-->
    <!--                </v-list-item>-->
    <!--            </v-list>-->

    <!--            <v-divider></v-divider>-->

    <!--            <v-list>-->
    <!--                <v-list-item v-for="item in currentlySelectedMenuItem.items" :key="item.title" :to="item.to">-->
    <!--                    <v-list-item-content class="text-start">-->
    <!--                        <v-list-item-title>{{ item.title }}</v-list-item-title>-->
    <!--                    </v-list-item-content>-->
    <!--                </v-list-item>-->
    <!--            </v-list>-->
    <!--        </v-navigation-drawer>-->
</template>

<script setup lang="ts">
class NavItem {
    constructor(
        public title: string,
        public icon: string,
        public to: { name: string },
        public children: NavItem[] = [],
    ) {}
}

const items = ref([
    new NavItem('Dashboard', 'mdi-view-dashboard', { name: 'dashboard' }, []),
    new NavItem('Staff', 'mdi-account-search', { name: 'staff' }, []),
]);
</script>

<style scoped>
/* Style of example of submenu implementation
.ml-sub-drawer {
    margin-left: 256px;
}
*/
</style>
