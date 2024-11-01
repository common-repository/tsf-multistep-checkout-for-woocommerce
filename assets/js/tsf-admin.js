jQuery(document).on('click', '.tsf-tabs li', function() {
    jQuery('.tsf-tabs li').removeClass('active');
    jQuery(this).addClass('active');
    jQuery('.tsf-tab-content').removeClass('active');
    jQuery('.tsf-tab-content[data-target="' + jQuery(this).attr('data-target') + '"]').addClass('active');
});
jQuery(document).on('change', '.tsf_multistep_checkout_style', function() {
    _url = jQuery('.style-preview').attr('data-base-url') + 'assets/images/examples/' + jQuery(this).val() + '.png';
    jQuery('.style-preview').attr('src', _url);
});

jQuery(function() {
    jQuery('.tsf_multistep_checkout_style').change();
});
