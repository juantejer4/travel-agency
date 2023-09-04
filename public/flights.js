const modal = document.querySelector(".relative.z-10");
document.addEventListener("DOMContentLoaded", function () {
    showFlights();

    const closeButton = document.querySelector(
        ".absolute.right-0.top-0.hidden.pr-4.pt-4.sm\\:block button"
    );
    const cancelButton = document.querySelector("#cancel-flight-deletion");
    const deleteButton = document.querySelector("#delete-flight");

    closeButton.addEventListener("click", () => {
        modal.classList.add("hidden");
        modal.classList.remove("block");
    });

    cancelButton.addEventListener("click", () => {
        modal.classList.add("hidden");
        modal.classList.remove("block");
    });

    deleteButton.addEventListener("click", () => {
        let id = (modal.dataset.id);
        axios
            .delete(`api/flights/${id}`, {
                data: { id: id },
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {
                if (response.status !== 200) {
                    throw new Error(
                        `Network response was not ok: ${response.status}`
                    );
                }
                showFlights();
                return response.data;
            });
        modal.classList.add("hidden");
        modal.classList.remove("block");
    });
});

document.addEventListener("click", function (event) {
    if (event.target && event.target.matches("button.delete")) {
        let id = event.target.dataset.id;
        modal.classList.add("block");
        modal.classList.remove("hidden");
        modal.dataset.id = id;
    }
});

function generateFlightsTableRows(response) {
    let flights = response.data;
    const rows = flights.map(generateFlightRow);
    return rows.join("");
}

function generateFlightRow(flight) {
    const originName = flight.origin.name;
    const destinationName = flight.destination.name;
    const airlineName = flight.airline.name;
    return `
            <tr id="flight-${flight.id}" data-flight='${JSON.stringify(
        flight
    )}'>

                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">${
                    flight.id
                }</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${airlineName}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${originName}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${destinationName}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${formatDate(
                    flight.departure_time
                )}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${formatDate(
                    flight.arrival_time
                )}</td>
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

function showFlights() {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    try {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `api/flights${location.search}`);
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const flights = JSON.parse(xhr.responseText).data;
                const rows = generateFlightsTableRows(flights);
                document.querySelector(".dynamic-tbody").innerHTML = rows;
            } else {
                console.log('Request failed.  Returned status of ' + xhr.status);
            }
        };
        xhr.send();
    } catch (error) {
        console.log(error);
    }
}

$(document).ready(function() {
    $('.airlines').select2({
        placeholder: 'Airline',
        width: '80%'
    });
});
$(document).ready(function() {
    $('.origin_city').select2({
        placeholder: 'Origin',
        width: '80%'
    });
});
$(document).ready(function() {
    $('.destiantion_city').select2({
        placeholder: 'Destination',
        width: '80%'
    });
});

function formatDate(dateString) {
    const date = new Date(dateString);
    const year = date.getFullYear().toString().substr(-2);
    const month = (date.getMonth() + 1).toString().padStart(2, "0");
    const day = date.getDate().toString().padStart(2, "0");
    const hours = date.getHours().toString().padStart(2, "0");
    const minutes = date.getMinutes().toString().padStart(2, "0");
    return `${hours}:${minutes} - ${month}/${day}/${year} `;
}
