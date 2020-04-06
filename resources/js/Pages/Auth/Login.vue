<template>
    <div>
        <div class="container">
            <div class="row py-5">
                <div class="col-md-10">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="$page.errors.email">
                        {{ $page.errors.email[0] }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="$page.errors.password">
                        {{ $page.errors.password[0] }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row justify-content-center my-5">
                        <div class="col-md-6 col-sm-10 col-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <form @submit.prevent="submit">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" v-model="form.email" id="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" v-model="form.password" id="password" class="form-control">
                                        </div>

                                        <button class="btn btn-primary" :disabled="sending">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data: () => ({
            sending: false,
            form: {
                email: '',
                password: '',
            }
        }),
        methods: {
            submit() {
                this.sending = true;
                this.$inertia.post('/login', {
                    email: this.form.email,
                    password: this.form.password
                }).then(() => this.sending = false);
            }
        }
    };
</script>

<style scoped>

</style>
