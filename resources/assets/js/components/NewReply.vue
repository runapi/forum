<template>
    <div>
        <div v-if="signedIn">
            <textarea name="body"
                      id="body"
                      class="form-control"
                      placeholder="Have something to say?"
                      rows="5"
                      required
                      v-model="body">
            </textarea>
            <button type="submit"
                    class="btn btn-default"
                    @click="addReply">Post
            </button>
        </div>


        <p class="text-center" v-else>Please
            <a href="/login">sign in</a> to participatein this discussion
        </p>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: ''
            }
        },
        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },
        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', {body: this.body})
                    .then(({data}) => {
                        this.body = '';

                        flash("Your reply has been posted.");

                        this.$emit('created', data);
                    });

            }
        }
    }
</script>