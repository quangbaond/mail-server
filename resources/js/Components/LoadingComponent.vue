
<template>
    <div class="vld-parent">
        <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
    </div>
</template>

<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/css/index.css';

    export default {
        data() {
            return {
                fullPage: true
            }
        },
        props: {
            isLoading: {
                type: Boolean,
                default: false
            }
        },
        components: {
            Loading
        },
    }
</script>