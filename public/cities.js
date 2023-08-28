$("#add-city-button").click(function () {
    $("#add-city-form").removeClass("invisible").addClass("visible");
});
$("#cancel-button").click(function () {
    $("#add-city-form").removeClass("visible").addClass("invisible");
    $("#error-message").removeClass("visible").addClass("invisible");
    $("#name").val("");
});
$(document).ready(function () {
    $(".closeModal").on("click", function (e) {
        $("#interestModal").addClass("invisible");
        $("#error-message-edit").removeClass("visible").addClass("invisible");
    });
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "GET",
        url: `api/cities${location.search}`,
        cache: false,
        processData: false,
        contentType: false,
        success: (cities) => {
            console.log(`api/cities${location.search}`);
            $(".dynamic-tbody").html(generateCityTableRows(cities.data));
        },
        error: function (data) {
            console.log(data);
        },
    });
    $(document).on("click", "button.delete", function () {
        let id = $(this).data("id");
        $.ajax({
            url: `api/cities/${id}`,
            type: "DELETE",
            data: {
                id: id,
            },
            success: function () {
                $.ajax({
                    type: "GET",
                    url: `api/cities${location.search}`,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: (cities) => {
                        $(".dynamic-tbody").html(
                            generateCityTableRows(cities.data)
                        );
                    },
                });
            },
        });
    });
    $(document).on("click", "button.edit", function () {
        let cityName = $(this).parents("tr").find("td:nth-child(2)").text();
        $("#interestModal").removeClass("invisible");
        $("#city-id").val($(this).parents("tr").find("td:nth-child(1)").text());
        $("#city-name").val(cityName);
        $("#city-name").attr("placeholder", cityName);
    });
});
$(document).on("click", "#name-update", function (e) {
    let id = $("#city-id").val();
    var name = $("#city-name").val();
    e.preventDefault();
    $.ajax({
        url: `api/cities/${id}`,
        type: "PUT",
        data: {
            name: name,
        },
        success: function (data) {
            $.ajax({
                type: "GET",
                url: `api/cities${location.search}`,
                cache: false,
                processData: false,
                contentType: false,
                success: (cities) => {
                    $(".dynamic-tbody").html(
                        generateCityTableRows(cities.data)
                    );
                },
            });
            $("#interestModal").addClass("invisible");
            $("#error-message-edit")
                .removeClass("visible")
                .addClass("invisible");
        },
        error: function (data) {
            $message = data.responseJSON.message;
            console.log($message);
            $("#error-message-edit").text($message);
            $("#error-message-edit")
                .removeClass("invisible")
                .addClass("visible");
        },
    });
});
$("#add-city-form").submit(function (e) {
    e.preventDefault();
    var cityData = new FormData(this);
    $.ajax({
        type: "POST",
        url: "api/cities",
        data: cityData,
        cache: false,
        processData: false,
        contentType: false,
        success: (data) => {
            $.ajax({
                type: "GET",
                url: `api/cities${location.search}`,
                cache: false,
                processData: false,
                contentType: false,
                success: (cities) => {
                    $(".dynamic-tbody").html(
                        generateCityTableRows(cities.data)
                    );
                    $("#error-message")
                        .removeClass("visible")
                        .addClass("invisible");
                },
            });
            $("#name").val("");
        },
        error: function (data) {
            $message = data.responseJSON.message;
            $("#error-message").text($message);
            $("#error-message").removeClass("invisible").addClass("visible");
        },
    });
});
function generateCityTableRows(response) {
    let rows = "";
    let cities = response.data;
    cities.forEach(function (city) {
        rows += generateCityRow(city);
    });
    return rows;
}
function generateCityRow(city) {
    return `
          <tr>
              <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">${city.id}</td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${city.name}</td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> - </td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> - </td>
              <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                  <button type="button" data-id="${city.id}"  class="edit text-indigo-600 hover:text-indigo-900">Edit</button>
              </td>
              <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                  <button type="button" data-id="${city.id}" class="delete text-red-600 hover:text-red-800">Delete</button>
              </td>
          </tr>
        `;
}
