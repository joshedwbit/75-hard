import './bootstrap';

function handleCheckboxLogic(checkboxSet) {
    checkboxSet.forEach(element => {
        element.addEventListener('click', function(e) {
            console.log('print');
            clearCheckboxes(checkboxSet);
            for (var i=0; i < element.value; i++) {
                checkboxSet[i].checked = true;
            }
        })
    })
}

function clearCheckboxes(checkboxSet) {
    checkboxSet.forEach(checkbox => {
        checkbox.checked = false;
    })
}

let waterCountCheckboxes = document.querySelectorAll('.js-todays-entry input[name="water_count[]"]');
let workoutCheckboxes = document.querySelectorAll('.js-todays-entry input[name="workouts[]"]');

handleCheckboxLogic(waterCountCheckboxes);
handleCheckboxLogic(workoutCheckboxes);