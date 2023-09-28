export default {
    props: ['flight'],
    methods: {
        formatDate(dateString) {
            const date = new Date(dateString);
            const year = date.getFullYear().toString().substr(-2);
            const month = (date.getMonth() + 1).toString().padStart(2, "0");
            const day = date.getDate().toString().padStart(2, "0");
            const hours = date.getHours().toString().padStart(2, "0");
            const minutes = date.getMinutes().toString().padStart(2, "0");
            return `${hours}:${minutes} - ${month}/${day}/${year} `;
        }
    },
    computed: {
        flightData() {
            return JSON.stringify(this.flight);
        }
    },
    template:`
    <tr :id="'flight-' + flight.id" :data-flight="flightData">
        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0"> {{flight.id}} </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> {{flight.airline}} </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> {{flight.origin}} </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> {{flight.destination}} </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> {{formatDate(flight.departure_time)}} </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> {{formatDate(flight.arrival_time)}} </td>
        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
            <button type="button" :data-id="flight.id" class="edit text-indigo-600 hover:text-indigo-900">Edit</button>
        </td>
        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
            <button type="button" :data-id="flight.id" class="delete text-red-600 hover:text-red-800">Delete</button>
        </td>
    </tr>
    `
}
