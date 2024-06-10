<script>    
document.addEventListener("DOMContentLoaded", function() {
    let searchInput = document.getElementById('search');
    let tableRows = document.querySelectorAll('table tbody tr');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    searchInput.addEventListener('input', function() {
        let searchValue = searchInput.value.toLowerCase();

        for (let row of tableRows) {
            let studentName = row.cells[0].textContent.toLowerCase();

            if (studentName.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });

    const unbanButtons = document.querySelectorAll('.unban-btn'); // Update de selector
    unbanButtons.forEach(button => {
        button.addEventListener('click', function() {
            const studentName = this.getAttribute('data-student-name'); // Haal de gebruikersnaam op van het data-attribuut

            fetch('/ban/' + encodeURIComponent(studentName), { // Verzend de gebruikersnaam als onderdeel van de URL
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Row verwijderen
                    const row = this.closest('tr');
                    row.remove();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>