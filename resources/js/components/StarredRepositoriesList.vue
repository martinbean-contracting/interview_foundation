<template>
    <div>
        <div class="mb-3">
            <b-button type="button" variant="primary" :disabled="!githubToken || busy" @click="fetchResults">
                <template v-if="busy">
                    <b-spinner small></b-spinner>
                    <span>Fetching&hellip;</span>
                </template>
                <template v-else>
                    <b-icon-star-fill></b-icon-star-fill>
                    <span class="ml-1">Get starred repos</span>
                </template>
            </b-button>
        </div>
        <b-alert show variant="danger" v-if="error">{{ error }}</b-alert>
        <template v-if="results.length > 0">
            <ul>
                <li v-for="(result, index) in results" :key="index">
                    <span>{{ result.name }}</span>
                </li>
            </ul>
        </template>
    </div>
</template>

<script>
export default {
    data() {
        return {
            busy: false,
            error: null,
            results: []
        };
    },
    methods: {
        fetchResults() {
            this.busy = true;
            this.error = null;

            // TODO: Actually fetch starred repositories
        }
    },
    props: {
        githubToken: {
            default: null,
            required: false,
            type: String
        }
    }
}
</script>
