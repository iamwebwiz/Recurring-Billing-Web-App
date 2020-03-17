<template>
    <div>
        <div class="container">
            <div class="row py-5">
                <div class="col-md-10 col-10">
                    <h1>Dashboard</h1>

                    <div class="alert alert-info">
                        Subscribe to our Home Tutoring plan today. We will charge you automatically after the
                        first payment till you decide to opt out.
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h3>Home Tutoring</h3>
                                    <h4 class="amount">&#8358;500</h4>
                                    <button class="btn btn-lg btn-block btn-primary" @click="subscribeToPlan" :disabled="processing" v-if="!authUser.subscription">Subscribe</button>
                                    <div class="alert alert-dark" v-if="authUser.subscription">Subscribed</div>
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
        name: "Dashboard",
        props: ['authUser', 'publicKey', 'planId'],
        data: () => ({
            amount: 500,
            processing: false
        }),
        methods: {
            subscribeToPlan() {
                this.processing = true;
                let self = this;

                let config = {
                    key: self.publicKey,
                    email: self.authUser.email,
                    amount: self.amount * 100,
                    currency: "NGN",
                    plan: self.planId,
                    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                    callback: function(response) {
                        axios.post('/api/subscriptions/store', {
                            planId: self.planId,
                            reference: response.reference,
                            userId: self.authUser.id
                        }).then(res => {
                            const {data} = res;

                            if (data.status === 'error') {
                                console.log('Shit happens.');
                            } else {
                                alert(data.message);
                                location.reload();
                            }
                        }).catch(err => console.log(err.response));

                        self.processing = false;
                    },
                    onClose: function() {
                        alert('window closed');
                        self.processing = false;
                    }
                };
                let handler = PaystackPop.setup(config);
                handler.openIframe();
            }
        }
    };
</script>

<style scoped>
    .amount {
        font-size: 2.2rem;
        color: #1d643b;
        font-weight: 700;
    }
</style>
