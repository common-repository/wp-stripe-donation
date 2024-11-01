(function(window, $) {

    // USE STRICT
    "use strict";

    var wpsdAnimatedProgress = document.getElementById('wpsd-animated-progress');
    var wpsdCaptchaField = document.getElementById('wpsd-captcha-field');

    //$('ul#wpsd_donate_amount li:first-child').addClass('active');

    $('ul#wpsd_donate_amount li.amount').click(function() {
        $('ul#wpsd_donate_amount li').removeClass('active')
        $(this).addClass('active');
        var wpsdRadioVal = $(this).data("amount");
        if (wpsdRadioVal !== undefined) {
            $("#wpsd_donate_other_amount").val(wpsdRadioVal);
        }
    });

    if (wpsdAnimatedProgress != null) {

        $(".wpsd-animated-progress span").each(function() {
            $(this).animate({
                    width: $(this).attr("data-progress") + "%",
                },
                1000
            );
            //$(this).text($(this).attr("data-progress") + "%");
        });
    }

    var form = document.getElementById('wpsd-donation-form-id');
    var wpsdDonateAmount = 0;
    var con_one = '';

    var style = {
        base: {
            color: wpsdAdminScriptObj.card_element_color,
            '::placeholder': {
                color: wpsdAdminScriptObj.card_element_color,
            },
        }
    };

    if (form != null) {

        var stripe = Stripe(wpsdAdminScriptObj.stripePKey);
        var elements = stripe.elements();

        var card = elements.create('card', {
            hidePostalCode: true,
            style: style,
        });

        card.mount("#card-element");

        card.addEventListener('change', ({ error }) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });

        form.addEventListener('submit', function(e) {

            e.preventDefault();
            var wpsdShowCheckout = true;

            if ($("#wpsd_donate_other_amount").val() == '') {
                $('#card-errors').show('slow').addClass('error').html('Amount Missing');
                $("#wpsd_donate_other_amount").focus();
                return false;
            }

            if (Number($("#wpsd_donate_other_amount").val()) < Number(wpsdAdminScriptObj.minimum_amount)) {
                $('#card-errors').show('slow').addClass('error').html('Minimum Amont:' + wpsdAdminScriptObj.minimum_amount);
                $("#wpsd_donate_other_amount").focus();
                return false;
            }

            if (Number($("#wpsd_donate_other_amount").val()) >= Number(wpsdAdminScriptObj.minimum_amount)) {
                wpsdDonateAmount = $("#wpsd_donate_other_amount").val();
            }

            if (($("#wpsd_donation_for").val() == '') || ($("#wpsd_donation_for").val() == null)) {
                $('#card-errors').show('slow').addClass('error').html('Please Enter Donation For');
                $("#wpsd_donation_for").focus();
                return false;
            }

            if ($("#wpsd_donator_name").val() == '') {
                $('#card-errors').show('slow').addClass('error').html('Please Enter Name');
                $("#wpsd_donator_name").focus();
                return false;
            }

            if ($("#wpsd_donator_email").val() == '') {
                $('#card-errors').show('slow').addClass('error').html('Please Enter Email');
                $("#wpsd_donator_email").focus();
                return false;
            }

            if (!wpsd_validate_email($("#wpsd_donator_email").val())) {
                $('#card-errors').show('slow').addClass('error').html('Please Enter Valid Email');
                $("#wpsd_donator_email").focus();
                return false;
            }

            if ($("#wpsd_captcha_content").val() == '') {
                $('#card-errors').show('slow').addClass('error').html('Capcha Missing!');
                $("#wpsd_captcha_content").focus();
                return false;
            }

            if ($("#wpsd_captcha_content").val() != $("#wpsd_captcha_content_check").val()) {
                $('#card-errors').show('slow').addClass('error').html('Wrong Capcha Number!');
                $("#wpsd_captcha_content").focus();
                return false;
            }

            if (wpsdCaptchaField != null) {
                if (grecaptcha.getResponse() == "") {
                    $('#card-errors').show('slow').addClass('error').html("Please Verify Captcha!");
                    return false;
                }
            }

            // Address Processing
            var address = [{
                'address_street': $('#wpsd_address_street').val(),
                'address_line2': $('#wpsd_address_line2').val(),
                'address_city': $('#wpsd_address_city').val(),
                'address_state': $('#wpsd_address_state').val(),
                'address_postal': $('#wpsd_address_postal').val(),
                'address_country': $('#wpsd_address_country').val()
            }];
            //var address = $.serialize(address);

            if ($("#wpsd_condition_one").is(":checked")) {
                con_one = $("#wpsd_condition_one").val();
            }

            if (wpsdShowCheckout) {

                $("#wpsd-pageloader").fadeIn();

                $.ajax({
                    url: wpsdAdminScriptObj.ajaxurl,
                    type: "POST",
                    dataType: "JSON",
                    cache: false,
                    data: {
                        action: 'wpsd_donation',
                        name: $("#wpsd_donator_name").val(),
                        email: $("#wpsd_donator_email").val(),
                        amount: wpsdDonateAmount,
                        donation_for: $("#wpsd_donation_for").val(),
                        currency: wpsdAdminScriptObj.currency,
                        idempotency: wpsdAdminScriptObj.idempotency,
                        security: wpsdAdminScriptObj.security,
                        stripeSdk: wpsdAdminScriptObj.stripe_sdk,
                        address: address,
                        g_recaptcha_response: $("#g-recaptcha-response").val(),
                    },
                    success: function(response) {
                        if (response.data.status === 'success') {
                            stripe.confirmCardPayment(response.data.client_secret, {
                                payment_method: {
                                    card: card,
                                    billing_details: {
                                        name: $("#wpsd_donator_name").val(),
                                        email: $("#wpsd_donator_email").val(),
                                    }
                                }
                            }).then(function(result) {

                                if (result.error) {
                                    if (wpsdCaptchaField != null) {
                                        grecaptcha.reset();
                                    }
                                    $("#wpsd-pageloader").fadeOut();
                                    $('#card-errors').text(result.error.message);

                                } else {
                                    if (result.paymentIntent.status === 'succeeded') {
                                        afterPaymentSucceeded($("#wpsd_donator_email").val(), wpsdDonateAmount, $("#wpsd_donation_for").val(), $("#wpsd_donator_name").val(), wpsdAdminScriptObj.currency, $("#wpsd-comments").val(), address, con_one);
                                    }
                                }
                            });
                        }
                        if (response.data.status === 'error') {
                            $("#wpsd-pageloader").fadeOut();
                            $('#card-errors').show('slow').removeClass('success').addClass(response.data.status).html(response.data.message);
                        }
                    }
                });
            }
        });

    }

    $("#wpsd-donation-form-id input[type='radio']").on("click", function() {

        var wpsdRadioVal = $(this).val();
        if (wpsdRadioVal !== undefined) {
            $("#wpsd_donate_other_amount").val(wpsdRadioVal);
        }

    });

    $('#wpsd_donate_other_amount').on('keyup', function(e) {

        $("#wpsd-donation-form-id input[type='radio']").prop("checked", false);

        if (/^(\d+(\.\d{0,2})?)?$/.test($(this).val())) {
            $(this).data('prevValue', $(this).val());
        } else {
            $(this).val($(this).data('prevValue') || '');
        }
    });

    function wpsd_validate_email($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/;
        return emailReg.test($email);
    }

    function afterPaymentSucceeded(email, amount, donateFor, name, currency, comments, address, condition_one) {
        $.ajax({
            url: wpsdAdminScriptObj.ajaxurl,
            type: "POST",
            dataType: "JSON",
            data: {
                action: 'wpsd_donation_success',
                email: email,
                amount: amount,
                donation_for: donateFor,
                name: name,
                currency: currency,
                comments: comments,
                address: address,
                con_one: condition_one
            },
            success: function(response) {
                if (response.status === 'success') {
                    var url = new URL(wpsdAdminScriptObj.successUrl);
                    url.searchParams.set('donation', 'success');
                    window.location.href = url.href;
                }
                if (response.status === 'error') {
                    $('#card-errors').show('slow').removeClass('success').addClass(response.status).html(response.message);
                }
            }
        });
    }

    // searchable dropdown select
    var wpsdAddressCountry = document.getElementById('wpsd_address_country');
    if (wpsdAddressCountry != null) {
        $('div.wpsd-form-item-half-right select#wpsd_address_country').selectize({
            sortField: 'text'
        });
    }

})(window, jQuery);