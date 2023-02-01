<template>
    <v-app class="bg-gray-500">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3 pt-10">
                    <v-alert v-if="result" outlined type="success" text>
                        Congratulations, {{user}}! You are successfully registered!
                    </v-alert>
                    <v-alert v-else outlined type="error" text>
                        Failed to register!
                        {{ error }}
                    </v-alert>
                    <v-btn href="/register" width="100%">return to register</v-btn>
                </div>
            </div>
        </div>
    </v-app>
</template>

<script>
export default {
    props: [
        'result',
        'error',
        'user'
    ],
    name: "ResultComponent"
}
</script>

<style scoped>

</style>
