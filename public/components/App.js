import DateRangePicker from "./DateRangePicker.js";
import FlightsTable from "./FlightsTable.js";
import TableHead from "./TableHead.js";
import TableBody from "./TableBody.js";
import TableRow from "./TableRow.js";
import PaginationLinks from "./PaginationLinks.js";

export default {
    components: {
        'date-picker': DateRangePicker,
        'table-head': TableHead,
        'flight-table': FlightsTable,
        'table-body': TableBody,
        'table-row': TableRow,
        'pagination-links': PaginationLinks
    },
    data() {
        return {
            flights: [],
            links: [],
            sortAscending: true
        }
    },
    created() {
        this.fetchFlights('/api/flights');
    },
    methods: {
        fetchFlights(url) {
            axios.get(url)
                .then(response => {
                    console.log(response.data);
                    this.links = response.data.links;
                    this.flights = response.data.data.data;
                })
                .catch(error => console.error(error));
        },
        sortFlights() {
            this.flights.sort((a, b) => {
                if (this.sortAscending) {
                    return new Date(a.departure_time) - new Date(b.departure_time);
                } else {
                    return new Date(b.departure_time) - new Date(a.departure_time);
                }
            });
            this.sortAscending = !this.sortAscending;
        }
    },
    template: `
        <date-picker/>
        <flight-table>
            <table-head :columns="['Id', 'Airline', 'Origin', 'Destination', 'Departure', 'Arrival']" @sort-flights="sortFlights"/>
            <table-body>
            <template v-for="flight in flights" :key="flight.id">
                <table-row :flight="flight"/>
            </template>
            </table-body>
        </flight-table>
        <pagination-links :links="links" @page-changed="fetchFlights"/>
    `
};
