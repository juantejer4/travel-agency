import DownArrowIcon from "./DownSvg.js";
import UpArrowIcon from "./UpSvg.js";
import HorizontalLineIcon from "./HorizontalSvg.js";

export default {
    components: {
        DownArrowIcon,
        UpArrowIcon,
        HorizontalLineIcon,
    },
    data() {
        return {
            state: 0,
            sortOptions: [
                { type: "id", order: "asc", svg: "HorizontalLineIcon" },
                { type: "departure_time", order: "desc", svg: "DownArrowIcon" },
                { type: "departure_time", order: "asc", svg: "UpArrowIcon" },
            ],
        };
    },
    methods: {
        cycleState() {
            this.state = (this.state + 1) % this.sortOptions.length;
            this.$emit("sort-flights", this.sortOptions[this.state]);
        },
    },
    template: `
        <button class="align-middle pl-0.5" @click="cycleState">
            <component :is="sortOptions[state].svg" />
        </button>
    `,
};
