<div class="flex flex-col flex-1 py-1.5">
    <label for="airlines" class="">Select an airline</label>
    <select class="airlines" id="airlines" name="airlines" required><option></option></select>
</div>

<div class="flex flex-col flex-1 py-1.5">
    <label for="origin_city" class="">Select an origin</label>
    <select class="origin_city" id="origin_city" name="origin_city" required></select>
</div>

<div class="flex flex-col flex-1 py-1.5">
    <label for="destination_city" class="">Select a destination</label>
    <select class="destiantion_city" id="destiantion_city" name="destiantion_city" disabled required></select>
</div>

<div class="py-1.5">
    <label for="departure-time">Departure time:</label>
    <input type="datetime-local" id="departure-time" class="departure-time" name="departure-time" required/>
</div>

<div class="py-1.5">
    <label for="arrival-time">Arrival time:</label>
    <input type="datetime-local" id="arrival-time" class="arrival-time" name="arrival-time" disabled required/>
</div>