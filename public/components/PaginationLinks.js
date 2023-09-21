export default {
    props: ["links"],
    methods: {
        changePage(event) {
            let page;
            if (event.target.href) {
                const url = new URL(event.target.href);
                page = url.searchParams.get("page");
            } else if (event.target.getAttribute("rel") === "prev") {
                page = this.sortParams.page - 1;
            } else if (event.target.getAttribute("rel") === "next") {
                page = this.sortParams.page + 1;
            }
            if (page) {
                this.$emit("page-changed", page);
            }
        },
    },
    template: `
        <div class="py-10" v-html="links" @click.prevent="changePage($event)"></div>
    `,
};