<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.unban-btn').click(function() {
        var userId = $(this).data('userid');
        
        $.ajax({
            url: '/ban/' + userId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Verwijder de rij uit de tabel
                    $(this).closest('tr').remove();
                    alert('Gebruiker succesvol verwijderd.');
                } else {
                    alert('Er is een fout opgetreden: ' + response.message);
                }
            }.bind(this),
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Er is een fout opgetreden bij het verwijderen van de gebruiker.');
            }
        });
    });
});
</script>
