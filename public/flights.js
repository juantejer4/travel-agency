const deleteModal = document.querySelector(".relative.z-10");
const createModal = document.querySelector("#create-modal");
const arrivalTime = document.querySelector('#arrival-time');
const departureTime = document.querySelector('#departure-time');

var airlines;
var cities;

document.addEventListener("DOMContentLoaded", function () {
    showFlights();

    departureTime.min = new Date().toISOString().slice(0, 16);
    arrivalTime.min = departureTime.value;
    document
        .getElementById("open-create-modal-button")
        .addEventListener("click", function () {
            createModal.classList.remove("invisible");
            createModal.classList.add("visible");
        });

    document
        .getElementById("cancel-create-button")
        .addEventListener("click", function () {
            createModal.classList.add("invisible");
            
            cleanModal(createModal);
        });

    const closeButton = document.querySelector(
        ".absolute.right-0.top-0.hidden.pr-4.pt-4.sm\\:block button"
    );
    const cancelButton = document.querySelector("#cancel-flight-deletion");
    const deleteButton = document.querySelector("#delete-flight");

    closeButton.addEventListener("click", () => {
        deleteModal.classList.add("hidden");
        deleteModal.classList.remove("block");
    });

    cancelButton.addEventListener("click", () => {
        deleteModal.classList.add("hidden");
        deleteModal.classList.remove("block");
    });

    deleteButton.addEventListener("click", () => {
        let id = (deleteModal.dataset.id);
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
        deleteModal.classList.add("hidden");
        deleteModal.classList.remove("block");
    });
});

document.addEventListener("click", function (event) {
    if (event.target && event.target.matches("button.delete")) {
        let id = event.target.dataset.id;
        deleteModal.classList.add("block");
        deleteModal.classList.remove("hidden");
        deleteModal.dataset.id = id;
    }
});

function generateFlightsTableRows(response) {
    flights = response.data;
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

$(document).ready(async function() {
    await getAirlines();

    $('.airlines').select2({
        data: formatAirlines(airlines),
        placeholder: 'Airline',
        width: '100%'
    });
    $('.origin-city').select2({
        placeholder: 'Origin',
        width: '100%',
        disabled: 'true'
    });
    $('.destination-city').select2({
        placeholder: 'Destination',
        width: '100%',
        disabled: 'true'
    });
});

$(".airlines").on("change", function() {
    let selectedAirlineId = $(this).val();
    if(selectedAirlineId != ""){
        let selectedAirline = airlines.find(airline => airline.id == selectedAirlineId);
        cities = selectedAirline.cities.map(city => city.name);
    
        cities = formatCities(cities);
    
        $('.origin-city').empty().append('<option></option>').select2({
            data: cities,
            placeholder: 'Origin'
        });
        $('.destination-city').empty().append('<option></option>').select2({
            placeholder: 'Destination'
        });
    
        $(".origin-city").prop("disabled", false);
        $(".destination-city").prop("disabled", true);
    }
});

$('.origin-city').on('change', function() {
    let selectedCityId = $(this).val();
    if (cities != undefined) {
        let destinationCities = cities.filter(city => city.id != selectedCityId);
        $('.destination-city').empty().append('<option></option>').select2({
            data: destinationCities,
            placeholder: "Destination"
        })
        $(".destination-city").prop("disabled", false);
    }
});
$('#departure-time').on('change', function() {
    $('#arrival-time').prop('disabled', false);
    $('#arrival-time').prop('min', $(this).val());
});
$('#arrival-time').on('change', function() {
    let arrivalTime = new Date($(this).val());
    let departureTime = new Date($('#departure-time').val());

    if(departureTime > arrivalTime){
        $(this).val('');
    }
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

async function getAirlines() {
    try {
        const response = await axios.get('api/airlines');
        airlines = response.data.data.data;
    } catch (error) {
        console.error(error);
    }
}

function formatAirlines(input) {
    var output = [];
    for (var i = 0; i < input.length; i++) {
        var item = input[i];
        output.push({
            id: item.id,
            text: item.name
        });
    }
    return output;
}

function formatCities(input) {
    var output = [];
    for (var i = 0; i < input.length; i++) {
        output.push({
            id: i+1,
            text: input[i]
        });
    }
    return output;
}

function cleanModal(modal) {
    $(".airlines", modal).val(null).trigger("change");
    $(".origin-city", modal).val(null).trigger("change");
    $(".destination-city", modal).val(null).trigger("change");
    $(".origin-city", modal).prop("disabled", true);
    $(".destination-city", modal).prop("disabled", true);
    $(".departure-time", modal).val("");
    $(".arrival-time", modal).val("");
}