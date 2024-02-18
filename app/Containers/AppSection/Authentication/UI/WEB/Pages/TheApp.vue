<template>
  <v-app id="app">
    <!--        <ApiatoNavigationDrawer v-if="showNavDrawer" />-->
    <ApiatoNavigationDrawer />
    <v-main>
      <v-container class="fill-height align-start" fluid>
        <!--                <router-view />-->
        sag
      </v-container>
    </v-main>
    <!--        <kurcc-snackbar />-->
  </v-app>
</template>

<script setup lang="ts">
// const isLoginPage = computed(() => this.$route.name === 'login');
// const is404Page = computed(() => this.$route.name === 'not-found');
// const is403Page = computed(() => this.$route.name === 'forbidden');
// const showNavDrawer = computed(() => !isLoginPage && !is403Page && !is404Page);
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}

.w-100 {
  width: 100% !important;
}

.center-center {
  position: fixed !important;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
