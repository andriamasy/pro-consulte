import '../css/tailwind.scss';
import '../css/admin.scss';

const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');

mobileMenuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});

$(document).ready(function() {
    $('a[id^="call_"]').on('click', function(event) {
        event.preventDefault();

        // Récupère infos spécialiste
        var infos = $(this).data('specialist');
        $("#specialist-code").text(infos.code);
        $("#specialist-name").text(infos.name);

        // Affiche la popup
        $('#popup-modal').removeClass('hidden');

        // Récupère l'ID du lien cliqué
        var fullId = $(this).attr('id');

        // Utilise une expression régulière pour extraire le dernier chiffre de l'ID
        var specialistId = fullId.match(/\d+$/)[0];

        // Effectue l'appel AJAX
        $.ajax({
            url: '/specialist/call', // Remplacez par l'URL de votre API
            type: 'POST',
            data: {
                specialist_id: specialistId
            },
            success: function(response) {
                // Traitez la réponse en cas de succès
                console.log('Success:', response);
            },
            error: function(xhr, status, error) {
                // Traitez les erreurs
                console.error('Error:', error);
            }
        });
    });

    // Fermer la popup
    $('#close-popup').on('click', function() {
        $('#popup-modal').addClass('hidden');
    });
});