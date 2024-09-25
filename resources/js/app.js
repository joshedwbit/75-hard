import './bootstrap';
import flatpickr from "flatpickr";
import { handleCheckboxLogic } from './checkbox-handler'

let waterCountCheckboxes = document.querySelectorAll('.js-todays-entry input[name="water_count[]"]');
let workoutCheckboxes = document.querySelectorAll('.js-todays-entry input[name="workouts[]"]');

let editWaterCountCheckboxes = document.querySelectorAll('.js-edit-entry input[name="water_count[]"]');
let editWorkoutCheckboxes = document.querySelectorAll('.js-edit-entry input[name="workouts[]"]');

let pastWaterCountCheckboxes = document.querySelectorAll('.js-past-entry input[name="water_count[]"]');
let pastWorkoutCheckboxes = document.querySelectorAll('.js-past-entry input[name="workouts[]"]');


handleCheckboxLogic(waterCountCheckboxes);
handleCheckboxLogic(workoutCheckboxes);

handleCheckboxLogic(editWaterCountCheckboxes);
handleCheckboxLogic(editWorkoutCheckboxes);

handleCheckboxLogic(pastWaterCountCheckboxes);
handleCheckboxLogic(pastWorkoutCheckboxes);


// flatpickr
let dateFilteredPickerInput = document.querySelector('.js-filter-date-picker');
let filteredDate = dateFilteredPickerInput.getAttribute('data-filtered-date');

flatpickr(dateFilteredPickerInput, {
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d-m-Y",
    // altFormat: "F j, Y",
    defaultDate: filteredDate || new Date().fp_incr(-1),
    maxDate: new Date().fp_incr(-1),
    minDate: "2022-01-01",
    inline: true,
});