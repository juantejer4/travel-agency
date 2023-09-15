export default {
    props: ['links'],
    methods: {
        changePage(url) {
            this.$emit('page-changed', url);
        }
    },
    template: `
        <div class="py-10" v-html="links" @click.prevent="changePage($event.target.href)"></div>
    `
};
