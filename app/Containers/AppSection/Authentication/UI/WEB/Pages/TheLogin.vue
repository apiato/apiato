<template>
    <v-layout>
        <v-row align-content="center" dense justify="center">
            <v-col class="col-auto">
                <form @submit.prevent="submit">
                    <h1 class="text-h5 mb-5 mx-auto light-green--text">GESG Carbon Registry</h1>
                    <v-card class="px-10 py-5 ma-auto" min-width="400">
                        <v-text-field id="email" v-model="form.email" label="Email" />
                        <InputError :message="form.errors.email" class="mt-2" />
                        <v-text-field v-model="form.password" :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'" :type="showPassword ? 'text' : 'password'" label="Password" @click:append="showPassword = !showPassword" />
                        <InputError :message="form.errors.password" class="mt-2" />
                        <v-checkbox v-model="form.remember">
                            <template #label>
                                <div>Stay signed in</div>
                            </template>
                        </v-checkbox>
                        <v-btn :disabled="form.processing" :loading="form.processing" class="mt-5" color="primary" tile type="submit" width="100%"> Login </v-btn>
                    </v-card>
                </form>
            </v-col>
        </v-row>
    </v-layout>
</template>

<script lang="ts" setup>
// import { router, useForm, usePage } from '@inertiajs/vue3';
// const page = usePage();

const showPassword = ref(false);

const form = useForm({
    email: null,
    password: null,
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>
