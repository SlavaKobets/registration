<template>
        <v-app class="bg-gray-500">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-2">
                        <div class="card p-4">
                            <p>Full name</p>
                            <v-text-field
                                name="name"
                                required
                                background-color="white"
                                rounded
                                outlined
                                dense
                                :error-messages="errors.name ? errors.name[0] : ''"
                            ></v-text-field>
                            <p>Country</p>
                            <v-autocomplete
                                v-model="country"
                                required
                                background-color="white"
                                auto-select-first
                                :items="items"
                                item-text="country_name"
                                item-value="country_id"
                                rounded
                                outlined
                                dense
                                return-object
                                :error-messages="errors.country ? errors.country[0] : ''"
                            ></v-autocomplete>
                            <p>Phone number</p>
                            <v-text-field
                                :disabled="phoneField"
                                v-model="phonePart"
                                required
                                :prefix="prefix"
                                class="white"
                                rounded
                                outlined
                                v-mask="'## ###-##-##'"
                                dense
                                :error-messages="phoneError"
                            ></v-text-field>
                            <p>Email</p>
                            <v-text-field
                                name="email"
                                required
                                background-color="white"
                                rounded
                                outlined
                                dense
                                class="mb-4"
                                :error-messages="errors.email ? errors.email[0] : ''"
                            ></v-text-field>
                            <input type="hidden" name="phone" v-model="phone">
                            <input type="hidden" name="country" v-model="country_id">
                            <v-btn type="submit">register</v-btn>
                        </div>
                    </div>
                </div>
            </div>
        </v-app>
</template>

<script>
export default {
    props: [
        'countries',
        'errors'
    ],
    data() {
        return {
            field: 'test',
            items: [],
            country: {},
            country_id: '',
            phone: '',
            phonePart: '',
            prefix: '',
            phoneField: true,
            phoneError: ''
        }
    },
    mounted() {
        this.items = this.countries
        this.phoneError = this.errors.phone ? this.errors.phone[0] : (this.errors.phone_length ? this.errors.phone_length[0] : '')
    },
    watch: {
        country: function (val) {
            this.prefix = val.code
            this.country_id = val.country_id
            this.phoneField = false
            this.phoneError = ''
        },
        phonePart: function (val){
            this.phone = this.country.code+val
        }
    }
}
</script>
