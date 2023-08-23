document.getElementById('open-create-modal-button').addEventListener('click', function() {
    let createModal = document.getElementById('create-modal');
    createModal.classList.remove('invisible');
    createModal.classList.add('visible');
});
  
document.getElementById('cancel-create-button').addEventListener('click', function() {
  let createModal = document.getElementById('create-modal');
  let nameInput = document.getElementById('name');
  let errorMessage = document.getElementById('error-message');

  createModal.classList.remove('visible');
  createModal.classList.add('invisible');
  
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

    document.addEventListener("click", function(event) {
        if (event.target && event.target.matches("button.delete")) {
          let id = event.target.dataset.id;
          
          fetch(`api/airlines/${id}`, {
            method: 'DELETE',
            body: JSON.stringify({ id: id }),
            headers: {
              'Content-Type': 'application/json'
            }
          })
          .then(response => {
            if (!response.ok) {
              throw new Error(`Network response was not ok: ${response.status}`);
            }
            return response.json();
          })
          .then(() => {
            return fetch(`api/airlines${location.search}`, {
              method: 'GET'
            });
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
            console.error('Fetch error:', error);
          });
        }
      });
      
      document.getElementById('create-airline-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        let name = document.getElementById("new-name").value;
        let description = document.getElementById("new-description").value;
        let cities = selectedCities();

        const data = {
          name: name,
          description: description,
          cities: cities
        };

        console.log(JSON.stringify(data));
        
        fetch('api/airlines', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
          let createModal = document.getElementById('create-modal');
          let errorMessage = document.getElementById('new-name-error-message');
          createModal.classList.remove('visible');
          createModal.classList.add('invisible');
          errorMessage.classList.remove('visible');
          errorMessage.classList.add('invisible');

          fetch(`api/airlines${location.search}`, {
            method: 'GET',
          })
          .then(response => {
            return response.json();
          })
          .then(data => {
            const airlines = data.data;
            document.querySelector(".dynamic-tbody").innerHTML = generateAirlinesTableRows(airlines);
          }) 
        })
        .catch(error => {
          let errorMessage = document.getElementById('new-name-error-message');
          errorMessage.classList.remove('invisible');
          errorMessage.classList.add('visible');
          errorMessage.innerText = error;
        });
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

  function selectedCities() {
    let createModal = document.getElementById("create-modal");
    let checkboxes = createModal.querySelectorAll('input[type="checkbox"]');
    let checkedCities = [];
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            let city = checkbox.name;
            checkedCities.push(city);
        }
    });
    return checkedCities;
  }