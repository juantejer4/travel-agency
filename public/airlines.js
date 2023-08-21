document.getElementById('add-airline-button').addEventListener('click', function() {
    var addAirlineForm = document.getElementById('add-airline-form');
    addAirlineForm.classList.remove('invisible');
    addAirlineForm.classList.add('visible');
});
  
document.getElementById('cancel-button').addEventListener('click', function() {
  var addAirlineForm = document.getElementById('add-airline-form');
  var errorMessage = document.getElementById('error-message');
  var nameInput = document.getElementById('name');

  addAirlineForm.classList.remove('visible');
  addAirlineForm.classList.add('invisible');
  
  errorMessage.classList.remove('visible');
  errorMessage.classList.add('invisible');

  nameInput.value = '';
});

document.addEventListener("DOMContentLoaded", function() {
    fetch(`api/airlines${location.search}`, {
      method: 'GET',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`Network response was not ok: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      const airlines = data.data;
      document.querySelector(".dynamic-tbody").innerHTML = generateAirlinesTableRows(airlines);
    })
    .catch(error => {
        console.log(`api/airlines${location.search}`);
      console.error('Fetch error:', error);
    });
  });
  
  function generateAirlinesTableRows(response) {
    let rows = "";
    let airlines = response.data;
    airlines.forEach(function(airline) {
      rows += generateAirlineRow(airline);
    });
    return rows;
  }
  function generateAirlineRow(airline) {
    return `
            <tr>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">${airline.id}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${airline.name}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${airline.description}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> - </td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                    <button type="button" data-id="${airline.id}"  class="edit text-indigo-600 hover:text-indigo-900">Edit</button>
                </td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                    <button type="button" data-id="${airline.id}" class="delete text-red-600 hover:text-red-800">Delete</button>
                </td>
            </tr>
          `;
  }