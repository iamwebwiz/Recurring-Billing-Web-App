<template>
    <div>
        <div class="container">
            <div class="row justify-content-center my-5">
                <div class="col-md-6 col-sm-10 col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form @submit.prevent="submit">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" v-model="form.email" autofocus id="email" class="form-control">
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
</template>

<script>
    export default {
        name: "Index",
        data: () => ({
            sending: false,
            form: {
                email: 'test@gmail.com',
                password: 'password',
            }
        }),
        methods: {
            submit() {
                this.sending = true;
                this.$inertia.post(this.route('login.attempt'), {
                    email: this.form.email,
                    password: this.form.password
                }).then(() => this.sending = false);
            }
        }
    };
</script>

<style scoped>

</style>
