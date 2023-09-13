const createModal = document.getElementById("create-modal");
const editModal = document.getElementById("edit-modal");

document.addEventListener("DOMContentLoaded", function () {
    getAirlines();

    document
        .getElementById("open-create-modal-button")
        .addEventListener("click", function () {
            createModal.classList.remove("invisible");
            createModal.classList.add("visible");
        });

    document
        .getElementById("create-form")
        .addEventListener("submit", function (event) {
            event.preventDefault();

            let errorMessage = document.getElementById(
                "new-name-error-message"
            );
            errorMessage.classList.add("invisible");

            const data = {
                name: document.getElementById("new-name").value,
                description: document.getElementById("new-description").value,
                cities: selectedCities(createModal),
            };

            fetch("api/airlines", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify(data),
            })
                .then((response) => {
                    if (!response.ok) {
                        return response.json().then((errorJson) => {
                            throw new Error(errorJson.message);
                        });
                    }
                })
                .then((data) => {
                    getAirlines();
                    clearCreateForm();
                })
                .catch((error) => {
                    errorMessage.classList.remove("invisible");
                    errorMessage.innerText = error;
                });
        });

    document
        .getElementById("cancel-create-button")
        .addEventListener("click", function () {
            clearCreateForm();
        });

    document
        .getElementById("cancel-edit-button")
        .addEventListener("click", function () {
            let errorMessage = document.getElementById(
                "edit-name-error-message"
            );

            editModal.classList.add("invisible");
            errorMessage.classList.add("invisible");

        });

    document.addEventListener("click", function (event) {
        if (event.target && event.target.matches("button.delete")) {
            let id = event.target.dataset.id;

            fetch(`api/airlines/${id}`, {
                method: "DELETE",
                body: JSON.stringify({ id: id }),
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(
                            `Network response was not ok: ${response.status}`
                        );
                    }
                    return response.json();
                })
                .then(() => {
                    return fetch(`api/airlines${location.search}`, {
                        method: "GET",
                    });
                })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(
                            `Network response was not ok: ${response.status}`
                        );
                    }
                    return response.json();
                })
                .then((data) => {
                    const airlines = data.data;
                    document.querySelector(".dynamic-tbody").innerHTML =
                        generateAirlinesTableRows(airlines);
                })
                .catch((error) => {
                    console.error("Fetch error:", error);
                });
        }
    });

    document.addEventListener("click", function (event) {
        if (event.target && event.target.matches("button.edit")) {
            let id = event.target.dataset.id;
            let airline = JSON.parse(
                document
                    .getElementById(`airline-${id}`)
                    .getAttribute("data-airline")
            );
            resetCheckboxes();
            airline.cities.forEach((city) => {
                const cityCheckbox = document.querySelector(
                    `input[id="edit-${city.name}"]`
                );
                if (cityCheckbox) {
                    cityCheckbox.checked = true;
                }
            });
            document.querySelector("#id").value = id;
            document.querySelector("#edit-name").value = airline.name;
            document.querySelector("#edit-name").placeholder = airline.name;
            document.querySelector("#edit-description").value =
                airline.description;
            document.querySelector("#edit-description").placeholder =
                airline.description !== null
                    ? airline.description
                    : "[No description]";
            editModal.classList.remove("invisible");
        }
    });
    document
        .getElementById("edit-form")
        .addEventListener("submit", function (event) {
            event.preventDefault();

            let id = document.getElementById("id").value;
            let name = document.getElementById("edit-name").value;
            let description = document.getElementById("edit-description").value;
            let errorMessage = document.getElementById(
                "edit-name-error-message"
            );
            errorMessage.classList.add("invisible");
            let cities = selectedCities(editModal);

            const data = {
                name: name,
                description: description,
                cities: cities,
            };

            fetch(`api/airlines/${id}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify(data),
            })
                .then((response) => {
                    if (!response.ok) {
                        return response.json().then((errorJson) => {
                            throw new Error(errorJson.message);
                        });
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log(data);
                    errorMessage.classList.add("invisible");
                    editModal.classList.add("invisible");

                    getAirlines();
                })
                .catch((error) => {
                    errorMessage.classList.remove("invisible");
                    errorMessage.innerText = error;
                });
            errorMessage.classList.add("invisible");
        });
});

function generateAirlinesTableRows(response) {
    let airlines = response.data;
    return airlines.map(generateAirlineRow).join('');;
}
function generateAirlineRow(airline) {
    return `
            <tr id="airline-${airline.id}" data-airline='${JSON.stringify(
        airline
    )}'>

                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">${
                    airline.id
                }</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${
                    airline.name
                }</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${
                    airline.description ? airline.description : "-"
                }</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${airline.incoming_flights_count}</td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                    <button type="button" data-id="${
                        airline.id
                    }"  class="edit text-indigo-600 hover:text-indigo-900">Edit</button>
                </td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                    <button type="button" data-id="${
                        airline.id
                    }" class="delete text-red-600 hover:text-red-800">Delete</button>
                </td>
            </tr>
          `;
}

function selectedCities(modal) {
  let checkboxes = modal.querySelectorAll('input[type="checkbox"]');
  let checkedCities = Array.from(checkboxes)
      .filter(checkbox => checkbox.checked)
      .map(checkbox => checkbox.name);
  return checkedCities;
}


function resetCheckboxes() {
    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach((checkbox) => {
        checkbox.checked = false;
    });
}

function clearCreateForm() {
    createModal.classList.add("invisible");
    document.getElementById("new-name-error-message").classList.add("invisible");
    document.getElementById("new-name").value = "";
    document.getElementById("new-description").value = "";
    resetCheckboxes();
}

function getAirlines() {
    fetch(`api/airlines${location.search}`, {
        method: "GET",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            const airlines = data.data;
            document.querySelector(".dynamic-tbody").innerHTML =
                generateAirlinesTableRows(airlines);
        });
}
