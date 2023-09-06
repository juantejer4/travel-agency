<div class="flex flex-col flex-1 py-1.5">
    <label for="{{$mode}}-airline">Select an airline</label>
    <select class="airlines" id="{{$mode}}-airlines" name="airlines" required><option></option></select>
</div>

<div class="flex flex-col flex-1 py-1.5">
    <label for="{{$mode}}-origin-city">Select an origin</label>
    <select class="origin-city" id="{{$mode}}-origin-city" name="origin-city" required></select>
</div>

<div class="flex flex-col flex-1 py-1.5">
    <label for="{{$mode}}-destination-city">Select a destination</label>
    <select class="destination-city" id="{{$mode}}-destination-city" name="destination-city" disabled required></select>
</div>

<div class="py-1.5">
    <label for="{{$mode}}-departure-time">Departure time:</label>
    <input type="datetime-local" id="{{$mode}}-departure-time" class="departure-time" name="departure-time" required/>
</div>

<div class="py-1.5">
    <label for="{{$mode}}-arrival-time">Arrival time:</label>
    <input type="datetime-local" id="{{$mode}}-arrival-time" class="arrival-time" name="arrival-time" disabled required/>
</div>