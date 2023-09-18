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
            startDate: null,
            endDate: null
        }
    },
    created() {
        this.fetchFlights('/api/flights', 'id');
    },
    methods: {
        fetchFlights(url, sort) {
            axios.get(url, { params: { sort, start_date: this.startDate, end_date: this.endDate } })
                .then(response => {
                    this.links = response.data.links;
                    this.flights = response.data.data.data;
                })
                .catch(error => console.error(error));
        },
        sortFlights(sortType) {
            let sort;
            if (sortType === 'ById') { 
                sort = 'id';
            } else if (sortType === 'DescendingByDepartureTime') { 
                sort = 'departure_time_desc';
            } else { 
                sort = 'departure_time_asc';
            }
            this.fetchFlights('/api/flights', sort);
        },
        updateDates(dates) {
            this.startDate = dates.startDate;
            this.endDate = dates.endDate;
            this.fetchFlights('/api/flights', 'id');
        }
    },
    template: `
        <date-picker @date-changed="updateDates"/>
        <flight-table>
            <table-head @sort-flights="sortFlights" :columns="['Id', 'Airline', 'Origin', 'Destination', 'Departure', 'Arrival']"/>
            <table-body>
            <template v-for="flight in flights" :key="flight.id">
                <table-row :flight="flight"/>
            </template>
            </table-body>
        </flight-table>
        <pagination-links :links="links" @page-changed="fetchFlights"/>
    `
};
