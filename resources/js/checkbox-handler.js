export function handleCheckboxLogic(checkboxSet) {
    checkboxSet.forEach(element => {
        element.addEventListener('click', function(e) {
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