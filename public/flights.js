document.addEventListener("DOMContentLoaded", function () {
    getFlights();
});

async function generateFlightsTableRows(response) {
    let flights = response.data;
    const rows = await Promise.all(flights.map(generateFlightRow));
    return rows.join('');
}

async function generateFlightRow(flight) {
    const originName = await getCityNameById(flight.origin_city_id);
    const destinationName = await getCityNameById(flight.destination_city_id);
    const airlineName = await getAirlineNameById(flight.airline_id);
    return `
            <tr id="flight-${flight.id}" data-flight='${JSON.stringify(flight)}'>

                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">${
                    flight.id
                }</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${
                    airlineName
                }</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${originName}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${
                    destinationName
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

async function getFlights() {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    try {
        const response = await axios.get(`api/flights${location.search}`, {
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        const flights = response.data.data;
        const rows = await generateFlightsTableRows(flights);
        document.querySelector(".dynamic-tbody").innerHTML = rows;
    } catch (error) {
        console.log(error);
    }
}

async function getCityNameById(id) {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    try {
        const response = await axios.get(`api/cities/${id}`, {
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        return response.data.name;
    } catch (error) {
        console.log(error);
    }
}
async function getAirlineNameById(id) {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    try {
        const response = await axios.get(`api/airlines/${id}`, {
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        return response.data.name;
    } catch (error) {
        console.log(error);
    }
}