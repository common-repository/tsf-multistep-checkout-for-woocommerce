function validateEmail(email) {
    //var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))jQuery/;

    var re = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    return re.test(email);
}
var tsf1, wizardHtml;

function checkValues() {
    _tsf_valid = 0;
    jQuery('#tsf-wizard .tsf-step.active').find('.validate-required').each(function() {
        var _input = jQuery(this).find('input');
        var _select = jQuery(this).find('select');

        if (_select.length > 0) {
            _input = _select;
        }

        if (_input.attr('type') === 'email' && !validateEmail(_input.val())) {
            _input.addClass('required-input');
            jQuery(this).find('.tsf-error-message').html(tsf_wizard.tsf_multistep_checkout_email_error);
            _tsf_valid++;
        } else if (_input.attr('type') === 'tel' && _input.val().trim() === '') {
            _input.addClass('required-input');
            jQuery(this).find('.tsf-error-message').html(tsf_wizard.tsf_multistep_checkout_phone_error);
            _tsf_valid++;
        } else if (_input.val().trim() === '') {
            if (_select.length > 0) {
                jQuery(this).find('.select2-container .select2-choice').addClass('required-input');
            } else {
                _input.addClass('required-input');
            }

            jQuery(this).find('.tsf-error-message').html(tsf_wizard.tsf_multistep_checkout_empty_error);
            _tsf_valid++;
        } else {
            _input.removeClass('required-input');
            jQuery(this).find('.tsf-error-message').html('');
        }
    });
    return _tsf_valid;
}

function checkLoginInputs() {
    _valid = 0;
    var jQueryuserName = jQuery('#username');
    var jQuerypassword = jQuery('#password');

    if (jQueryuserName.val().trim() === '') {
        jQueryuserName.addClass('required-input');
        jQueryuserName.parents('.form-row').find('.tsf-error-message').html(tsf_wizard.tsf_multistep_checkout_empty_error);
        _valid++;
    } else {
        jQueryuserName.removeClass('required-input');
        jQueryuserName.parents('.form-row').find('.tsf-error-message').html('');
    }

    if (jQuerypassword.val().trim() === '') {
        jQuerypassword.addClass('required-input');
        jQuerypassword.parents('.form-row').find('.tsf-error-message').html(tsf_wizard.tsf_multistep_checkout_empty_error);
        _valid++;
    } else {
        jQueryuserName.removeClass('required-input');
        jQueryuserName.parents('.form-row').find('.tsf-error-message').html('');
    }
    return _valid;
}

jQuery(function() {
    jQuery('#username').parents('.form-row').append('<div class="tsf-error-message"></div>');
    jQuery('#password').parents('.form-row').append('<div class="tsf-error-message"></div>');


    if (tsf_wizard.tsf_multistep_checkout_merge_order_payment_tabs != 'true' || tsf_wizard.tsf_multistep_checkout_merge_order_payment_tabs == '') {
        jQuery(".shipping-tab .shop_table").empty();
        jQuery(".shop_table").appendTo(".shipping-tab");
    }

    if (tsf_wizard.tsf_multistep_checkout_add_coupon_form == 'true') {
        jQuery(".woocommerce-info a.showcoupon").parent().detach();
        jQuery("form.checkout_coupon").appendTo('.coupon-step');

        setTimeout(function() {
            jQuery(".coupon-step form.checkout_coupon").show();
        }, 1);
    }
    if (tsf_wizard.tsf_multistep_checkout_add_login_form == 'true') {
        jQuery(".woocommerce-info a.showlogin").parent().detach();
        jQuery("form.login").appendTo('.login-step');
        jQuery(".login-step form.login").show();
    }
    jQuery('#tsf-wizard').find('.form-row.validate-required').each(function() {
        jQuery(this).find('input')
            .attr('required', 'required');
        jQuery(this).append('<div class="tsf-error-message"></div>')
    });
    var _index = 0;
    jQuery('#tsf-wizard .tsf-nav-step .gsi-step-indicator').html('');
    jQuery('#tsf-wizard').find('.tsf-title').each(function() {
        _index++;

        jQuery('#tsf-wizard .tsf-nav-step .gsi-step-indicator').append('<li class="current" data-target="' + jQuery(this).attr('data-step') + '">' +
            '<a href="#0">' +
            '    <span class="number">' + _index + '</span>' +
            '    <span class="desc">' +
            '        <div class="label" style="display:block"> ' + jQuery(this).text().trim() + '</div>' +
            '        <span></span>' +
            '    </span>' +
            ' </a>' +
            '</li>');
    });

    jQuery('#tsf-wizard .tsf-step:eq(0)').addClass('active');
    jQuery('#place_order').css({
        'display': 'none'
    })
    var _manySteps = true;
    if (tsf_wizard.tsf_multistep_checkout_nav_position == 'left' || tsf_wizard.tsf_multistep_checkout_nav_position === 'right') {
        _manySteps = false;
    }


    wizardHtml = jQuery('#tsf-wizard').html();

    tsf1 = jQuery('.tsf-wizard-1').tsfWizard({

        stepStyle: tsf_wizard.tsf_multistep_checkout_style,
        stepEffect: tsf_wizard.tsf_multistep_checkout_animation,
        navPosition: tsf_wizard.tsf_multistep_checkout_nav_position,
        validation: true,
        stepTransition: false,
        showStepNum: tsf_wizard.tsf_multistep_checkout_show_step_num == 'true' ? true : false,
        showButtons: true,
        manySteps: _manySteps,
        height: 'auto',
        disableSteps: 'none',
        nextBtn: tsf_wizard.tsf_multistep_checkout_btn_next + ' <i class="fa fa-chevron-right"></i>',
        prevBtn: ' <i class="fa fa-chevron-left"></i> ' + tsf_wizard.tsf_multistep_checkout_btn_prev,
        finishBtn: tsf_wizard.tsf_multistep_checkout_btn_finish + ' <i class="fa fa-shopping-cart"></i>',

        onBeforeNextButtonClick: function(e, validation) {

            var _tsf_valid = checkValues();
            if (_tsf_valid > 1) {

                var elementTop = jQuery('#tsf-wizard .tsf-step.active .required-input').eq(0).offset().top;
                var divTop = jQuery('.tsf-content').offset().top;
                if (elementTop > divTop) {
                    jQuery('.tsf-content').stop().animate({
                        scrollTop: (elementTop - divTop - 20)
                    }, '500');
                } else {
                    //jQuery('.tsf-content').scrollTop(elementTop)
                    jQuery('.tsf-content').stop().animate({
                        scrollTop: elementTop - 20
                    }, '500');
                }
                var elementRelativeTop = elementTop - divTop;

                jQuery('#tsf-wizard .tsf-step.active .required-input').eq(0).offset().top - jQuery('#tsf-wizard .tsf-step.active .required-input').eq(0).offset().top
                e.preventDefault();
            }

        }
    });

    jQuery('.tsf_multistep_checkout_style').val(tsf_wizard.tsf_multistep_checkout_style);
    jQuery('.tsf_multistep_checkout_nav_position').val(tsf_wizard.tsf_multistep_checkout_nav_position);

    jQuery('.tsf-loading-img').remove();
    jQuery('#tsf-wizard').css('visibility', '');

    jQuery('#tsf-wizard .tsf-step.active').find('.validate-required input').change(function() {
        jQuery(this).removeClass('corrected-input');
        var _val = checkValues();
        if (_val == 0) {
            jQuery(this).addClass('corrected-input');
        }
    });
    jQuery('#tsf-wizard .tsf-step.active').find('.validate-required input').on('keyup', function() {
        jQuery(this).removeClass('corrected-input');
        var _val = checkValues();
        if (_val == 0) {
            jQuery(this).addClass('corrected-input');
        }
    });

    jQuery('head').append('<style >.form-control{width:100%;padding: 5px;margin: 5px;}.col-md-4{display:inline-block;width:30%;}</style>');
});

jQuery(document).on('keyup', '#username,#password', function() {
    var jQuerytxt = jQuery(this);
    if (jQuerytxt.val().trim() === '') {
        jQuerytxt.addClass('required-input').removeClass('corrected-input');
        jQuerytxt.parents('.form-row').find('.tsf-error-message').html(tsf_wizard.tsf_multistep_checkout_empty_error);
        _valid++;
    } else {
        jQuerytxt.removeClass('required-input').addClass('corrected-input');
        jQuerytxt.parents('.form-row').find('.tsf-error-message').html('');
    }
});
jQuery(document).on('change', '#username,#password', function() {
    var jQuerytxt = jQuery(this);
    if (jQuerytxt.val().trim() === '') {
        jQuerytxt.addClass('required-input').removeClass('corrected-input');
        jQuerytxt.parents('.form-row').find('.tsf-error-message').html(tsf_wizard.tsf_multistep_checkout_empty_error);
        _valid++;
    } else {
        jQuerytxt.removeClass('required-input').addClass('corrected-input');
        jQuerytxt.parents('.form-row').find('.tsf-error-message').html('');
    }
});
jQuery(document).on('click', '.login-step [type="submit"]', function() {

    _value = checkLoginInputs();

    if (_value > 0) {
        return false;
    }
});
