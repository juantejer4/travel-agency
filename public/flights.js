document.addEventListener("DOMContentLoaded", function () {
    getFlights();
});

function generateFlightsTableRows(response) {
    let flights = response.data;
    return flights.map(generateFlightRow).join('');;
}
function generateFlightRow(flight) {
    console.log(flight);
    return `
            <tr id="flight-${flight.id}" data-flight='${JSON.stringify(flight)}'>

                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">${
                    flight.id
                }</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${
                    flight.airline_id
                }</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${
                    flight.origin_city_id
                }</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${
                    flight.destination_city_id
                }</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${
                    flight.departure_time
                }</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${
                    flight.arrival_time
                }</td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                    <button type="button" data-id="${
                        flight.id
                    }"  class="edit text-indigo-600 hover:text-indigo-900">Edit</button>
                </td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                    <button type="button" data-id="${
                        flight.id
                    }" class="delete text-red-600 hover:text-red-800">Delete</button>
                </td>
            </tr>
          `;
}

function getFlights() {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    axios.get(`api/flights${location.search}`, {
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
    })
        .then((response) => {
            const flights = response.data.data;
            document.querySelector(".dynamic-tbody").innerHTML =
                generateFlightsTableRows(flights);
        })
        .catch((error) => {
            console.log(error);
        });
}
