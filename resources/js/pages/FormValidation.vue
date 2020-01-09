<template>
<div class="content-wrapper">
    <section class="content">
        test 123
        <button class="btn btn-primary" @click="addToPages">
            Add To Pages
        </button>
    </section>
</div>
</template>
<script>
export default {
    mounted()
    {
        console.log(this.$store.state.pages);
    },
    methods:
    {
        addToPages()
        {
            this.$store.commit('addToPages',{
                name:'formvalidation'
            });
        }
    }
}
</script>