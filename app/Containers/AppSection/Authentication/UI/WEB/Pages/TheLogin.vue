<template>
  <v-layout>
    <v-row align-content="center" dense justify="center">
      <v-col class="col-auto">
        <form @submit.prevent="form.post('/login')">
          <h1 class="text-h5 mb-5 mx-auto light-green--text">
            GESG Carbon Registry
          </h1>
          <v-card class="px-10 py-5 ma-auto" min-width="400">
            <v-text-field
              :error-messages="errors"
              label="Email"
              id="email"
              v-model="form.email"
            />
            <div v-if="errors.email">{{ errors.email }}</div>
            <v-text-field
              v-model="form.password"
              :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
              :error-messages="errors"
              :type="showPassword ? 'text' : 'password'"
              label="Password"
              @click:append="showPassword = !showPassword"
            />
            <div v-if="errors.password">{{ errors.password }}</div>
            <v-btn :loading="form.processing" type="submit">Submit</v-btn>
            <v-checkbox v-model="staySignedIn">
              <template v-slot:label>
                <div>Stay signed in</div>
              </template>
            </v-checkbox>
            <v-btn
              :disabled="invalid"
              :loading="loggingIn"
              class="mt-5"
              color="primary"
              tile
              to="/dashboard"
              type="submit"
              width="100%"
              @click="login"
            >
              Login
            </v-btn>
          </v-card>
        </form>
      </v-col>
    </v-row>
  </v-layout>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
defineProps({
  errors: {
    type: {
      email: String,
      password: String,
    },
  },
});

const form = useForm({
  email: null,
  password: null,
  remember: false,
});
const showPassword: boolean = ref(false);
const username: string = ref(null);
const password: string = ref(null);
const staySignedIn: boolean = ref(false);

function login() {
  this.$store.dispatch('login', {
    email: username,
    password: password,
    staySignedIn: staySignedIn,
  });
}
// function forgotPassword() {
//   this.$store.dispatch('forgotPassword', { email: this.username });
// }
// function submit() {
//   this.$refs.observer.validate();
// }
</script>
