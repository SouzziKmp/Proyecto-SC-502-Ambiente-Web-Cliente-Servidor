$(function() {
    console.log("Home JS cargado");

    $('#btn-login').on('click', function() {
        window.location.href = "index.php?action=login";
    });

    $('#btn-registro').on('click', function() {
        window.location.href = "index.php?action=registro";
    });

    const currentAction = new URLSearchParams(window.location.search).get('action');
    
    if (currentAction) {
        $('.navbar-nav .nav-link').each(function() {
            const linkAction = $(this).attr('href');
            if (linkAction && linkAction.includes(`action=${currentAction}`)) {
                $(this).addClass('active fw-bold text-primary');
            }
        });
    }

    $('.nav-link').on('click', function() {
        if ($('.navbar-toggler').is(':visible')) {
            $('.navbar-collapse').collapse('hide');
        }
    });
});