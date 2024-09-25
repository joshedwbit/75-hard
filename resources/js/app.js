import './bootstrap';
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