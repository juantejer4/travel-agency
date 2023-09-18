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
            sortType: ['ById','DescendingByDepartureTime', 'AscendingByDepartureTime'],
            svgs: {
                'ById': 'HorizontalLineIcon',
                'DescendingByDepartureTime': 'DownArrowIcon',
                'AscendingByDepartureTime': 'UpArrowIcon'
            }
        }
    },
    methods: {
        cycleState() {
            this.state = (this.state + 1) % this.sortType.length;
            this.$emit('sort-flights', this.sortType[this.state]);
        }
    },
    template: `
        <button class="align-middle pl-0.5" @click="cycleState">
            <component :is="svgs[sortType[state]]" />
        </button>
    `
}
