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

    const unbanButtons = document.querySelectorAll('button');
    unbanButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const studentId = row.dataset.studentId;

            fetch('/ban/' + studentId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // If the request was successful, remove the row from the table
                    row.remove();
                } else {
                    console.error('Failed to unban student: ', data.message);
                }
            })
            .catch(error => console.error('Failed to unban student: ', error));
        });
    });
});
</script>