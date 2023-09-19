import DateRangePicker from "./DateRangePicker.js";
import FlightsTable from "./FlightsTable.js";
import TableHead from "./TableHead.js";
import TableBody from "./TableBody.js";
import TableRow from "./TableRow.js";
import PaginationLinks from "./PaginationLinks.js";

export default {
    components: {
        "date-picker": DateRangePicker,
        "table-head": TableHead,
        "flight-table": FlightsTable,
        "table-body": TableBody,
        "table-row": TableRow,
        "pagination-links": PaginationLinks,
    },
    data() {
        return {
            flights: [],
            links: [],
            startDate: null,
            endDate: null,
            sortParams: { sort: "id", sortOrder: "asc", page: 1 },
        };
    },
    watch: {
        startDate: function (newStartDate, oldStartDate) {
            this.fetchFlights();
        },
        endDate: function (newEndDate, oldEndDate) {
            this.fetchFlights();
        },
        sortParams: {
            handler: function (newSortParams, oldSortParams) {
                this.fetchFlights();
            },
            deep: true,
        },
    },
    created() {
        this.fetchFlights();
    },
    methods: {
        fetchFlights(page) {
            axios
                .get("/api/flights", {
                    params: {
                        ...this.sortParams,
                        start_date: this.startDate,
                        end_date: this.endDate,
                        page: page || this.sortParams.page,
                    },
                })
                .then((response) => {
                    this.links = response.data.links;
                    this.flights = response.data.data.data;
                    this.sortParams.page = response.data.data.current_page;
                })
                .catch((error) => console.error(error));
        },
        sortFlights({ type, order }) {
            this.sortParams = { sort: type, sortOrder: order };
        },

        updateDates(dates) {
            this.startDate = dates.startDate;
            this.endDate = dates.endDate;
        },
    },
    template: `
        <date-picker @date-changed="updateDates"/>
        <flight-table>
            <table-head @sort-flights="sortFlights" :columns="['Id', 'Airline', 'Origin', 'Destination', 'Departure', 'Arrival']"/>
            <table-body>
                <table-row v-for="flight in flights" :key="flight.id" :flight="flight"/>
            </table-body>
        </flight-table>
        <pagination-links :links="links" @page-changed="fetchFlights"/>
`,
};
