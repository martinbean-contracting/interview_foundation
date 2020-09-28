<template>
    <div class="pt-4">
        <template v-if="githubToken">
            <p>Your Github personal access token is: <span class="text-monospace">{{ githubToken }}</span></p>
        </template>
        <template v-else>
            <github-token-form></github-token-form>
        </template>
    </div>
</template>

<script>
import GithubTokenForm from './GithubTokenForm.vue';

export default {
    components: {
        GithubTokenForm
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
