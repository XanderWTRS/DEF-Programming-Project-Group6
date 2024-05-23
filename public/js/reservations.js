
function checkOnlyOne(checkbox) {
    var checkboxes = document.getElementsByName('selected_week');
    checkboxes.forEach(function(currentCheckbox) {
        if (currentCheckbox !== checkbox) {
            currentCheckbox.checked = false;
        }
    });
}
