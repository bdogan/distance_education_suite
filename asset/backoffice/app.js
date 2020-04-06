/**
 * Realistic Menu
 */
$('.bo-navbar ul.bo-main-menu > li.nav-item.dropdown > a').realisticMenu();

/**
 * Activate Tooltips
 */
$('[data-toggle="tooltip"]').tooltip();


/**
 * Toast
 */

$('.toast')
    .on('hidden.bs.toast', function () {
        $(this).toast('dispose').remove();
    })
    .toast({
        delay: 4000
    })
    .toast('show');

/**
 * Password change
 */
$("button[data-role='change_password']").on('click', function () {
    $('.password-container').show().find('input').removeAttr('disabled');
    $(this).remove();
});
