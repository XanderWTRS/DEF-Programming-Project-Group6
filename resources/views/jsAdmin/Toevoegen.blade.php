<script>
let searchInput = document.getElementById('search');
let tableRows = document.querySelectorAll('table tbody tr');

searchInput.addEventListener('input', function() {
    let searchValue = searchInput.value.toLowerCase();

    for (let row of tableRows) {
        let productName = row.cells[0].textContent.toLowerCase();

        if (productName.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
});

document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(event) {
        const confirmDelete = confirm('Weet je zeker dat je dit product wilt verwijderen?');
        if (!confirmDelete) {
            event.preventDefault();
        }
    });
});
</script>
