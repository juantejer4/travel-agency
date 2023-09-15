import DownArrowIcon from './DownSvg.js';
import UpArrowIcon from './UpSvg.js';
import HorizontalLineIcon from './HorizontalSvg.js';

export default {
    components: {
        DownArrowIcon,
        UpArrowIcon,
        HorizontalLineIcon
    },
    data() {
        return {
            state: 0,
            svgs: ['HorizontalLineIcon', 'DownArrowIcon', 'UpArrowIcon']
        }
    },
    methods: {
        cycleState() {
            this.state = (this.state + 1) % this.svgs.length;
        }
    },
    template: `
        <button class="align-middle pl-0.5" @click="cycleState">
            <component :is="svgs[state]" />
        </button>
    `
}
