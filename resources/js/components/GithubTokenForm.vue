<template>
    <div class="pt-4">
        <form action="#" method="post" v-on:submit.prevent="onSubmit">
            <fieldset :disabled="form.busy">
                <b-card>
                    <template v-if="form.successful">
                        <b-alert class="mb-0" variant="success" show>GitHub personal access token stored successfully.</b-alert>
                    </template>
                    <template v-else>
                        <label for="github_token">GitHub personal access token</label>
                        <b-media :right-align="true">
                            <input
                                autocapitalize="off"
                                autocomplete="none"
                                class="form-control"
                                id="github_token"
                                name="github_token"
                                required
                                spellcheck="off"
                                type="text"
                                v-bind:class="{ 'is-invalid': form.errors.has('github_token') }"
                                v-model.trim="form.data.github_token"
                            >
                            <b-form-invalid-feedback v-for="error in form.errors.get('github_token')" :key="error" v-text="error" />
                            <template slot="aside">
                                <b-button variant="primary" type="submit">
                                    <template v-if="form.busy">
                                        <b-spinner small></b-spinner>
                                        <span>Submitting&hellip;</span>
                                    </template>
                                    <template v-else>
                                        <span>Submit</span>
                                    </template>
                                </b-button>
                            </template>
                        </b-media>
                    </template>
                </b-card>
            </fieldset>
        </form>
    </div>
</template>

<script>
import axios from '../plugins/axios';
import Form from '../src/form';

export default {
    data() {
        return {
            form: new Form({
                github_token: ''
            })
        };
    },
    methods: {
        onSubmit() {
            this.form.startProcessing();

            axios
                .put('/github-token', this.form.data)
                .then((response) => {
                    this.form.finishProcessing();

                    this.$emit('token-updated', this.form.data.github_token);
                })
                .catch((error) => {
                    if (error.response.data.errors) {
                        this.form.setErrors(error.response.data.errors);
                    } else {
                        this.form.setErrors({
                            'form': [
                                'An error occurred. Please try again later.'
                            ]
                        });
                    }
                });
        }
    }
}
</script>
