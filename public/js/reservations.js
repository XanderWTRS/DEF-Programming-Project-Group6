
function checkOnlyOne(checkbox) {
    var checkboxes = document.getElementsByName('selected_week');
    checkboxes.forEach(function(currentCheckbox) {
        if (currentCheckbox !== checkbox) {
            currentCheckbox.checked = false;
        }
    });
}

document.addEventListener('DOMContentLoaded', (event) => {
    const checkboxes = document.querySelectorAll('.weekCheckbox');
    const reservationbutton = document.getElementById('reservationbutton');

    const updatereservationbuttonState = () => {
        const atLeastOneChecked = Array.from(checkboxes).some(cb => cb.checked);
        reservationbutton.disabled = !atLeastOneChecked;

        if (atLeastOneChecked) {
            startFunction();
        }
    };

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updatereservationbuttonState);
    });
});

function startFunction() {
    console.log("At least one checkbox is now checked!");
}
