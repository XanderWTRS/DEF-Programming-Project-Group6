
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
    const submitButton = document.getElementById('submitButton');

    const updateSubmitButtonState = () => {
        const atLeastOneChecked = Array.from(checkboxes).some(cb => cb.checked);
        submitButton.disabled = !atLeastOneChecked;

        if (atLeastOneChecked) {
            startFunction();
        }
    };

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSubmitButtonState);
    });
});

function startFunction() {
    console.log("At least one checkbox is now checked!");
}
