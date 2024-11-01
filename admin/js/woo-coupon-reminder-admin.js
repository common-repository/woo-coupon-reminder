jQuery(document).ready(function ($) {
    'use strict';
    /* global viwcr_ajax */
    $('.vi-ui.dropdown').dropdown();
    $('.vi-ui.dropdown select').dropdown();

    $('#viwcr_btn_update_email_data').click(function () {
        let $this = $(this);
        $this.addClass('loading');
        $('.tablenav.top').addClass('viwcr_wrap_scan_coupons');
        $('#vi_update_coupon_progress').remove();
        $.ajax({
            url: viwcr_ajax.ajax,
            method: 'POST',
            data: {
                action: 'scan_coupons',
                nonce: viwcr_ajax.nonce
            },
            beforeSend: function () {
            },
            success: function (response) {

                if (response.status === 'successed') {
                    $('.viwcr_wrap_scan_coupons').addClass('vi_progress').append(`
						<div class="vi-ui indicating progress small" data-value="" data-total="" id="vi_update_coupon_progress">
							<div class="bar"></div>
							<div class="label"></div>
						</div>
					`);
                    $this.removeClass('loading');
                    $('#vi_update_coupon_progress').progress({
                        total: parseInt(response.count),
                        duration: 200,
                        label: 'ratio',
                        text: {
                            ratio: '{value} of {total}',
                            active: 'Update {value} of {total} coupons',
                            success: '{total} Coupons Updated!'
                        }
                    });

                    let params = {};
                    process_update_coupon(parseInt(0), params);
                }
            },
            complete: function () {

            }
        });
        return false;
    });
    let process_update_coupon = function (offset, params) {
        $.ajax({
            method: 'POST',
            url: viwcr_ajax.ajax,
            data: {
                params: params,
                action: 'update_schedule_data_coupon',
                offset: offset,
                nonce: viwcr_ajax.nonce
            },
            dataType: "json",
            success: function (response) {
                if (response.offset === 'done') {
                    alert('All coupons updated');
                    $('#vi_update_coupon_progress').remove();
                    window.location.reload();
                } else {
                    $('#vi_update_coupon_progress').progress('increment');

                    process_update_coupon(parseInt(response.offset), params);
                }
            }
        });
    };
    /*Color picker*/
    $('.color-picker').iris({
        change: function (event, ui) {
            $(this).parent().find('.color-picker').css({backgroundColor: ui.color.toString()});
            $(this).val(ui.color.toString()).trigger('change');
        },
        hide: true,
        border: true
    }).click(function () {
        $('.iris-picker').hide();
        $(this).closest('.field').find('.iris-picker').show();
    });
    $('body').click(function () {
        $('.iris-picker').hide();
    });
    $('.color-picker').click(function (event) {
        event.stopPropagation();
    });

    /*design button "shop now"*/
    let buttonShopNow = $('.viwcr-button-shop-now');
    $('#viwcr_button_title').on('keyup', function () {
        buttonShopNow.html($(this).val());
    });
    $('#viwcr_button_url').on('keyup', function () {
        buttonShopNow.attr('href', $(this).val());
    });
    $('#viwcr_button_font_size').on('change', function () {
        buttonShopNow.css('font-size', $(this).val() + 'px');
    });
    /*Color picker*/
    $('#viwcr_button_text_color').on('change', function () {
        buttonShopNow.css({'color': $(this).val()});
    });
    $('#viwcr_button_background').on('change', function () {
        buttonShopNow.css({'background-color': $(this).val()});
    });

    /*Preview email*/
    $('.preview-emails-html-overlay').on('click', function () {
        $('.preview-emails-html-container').addClass('preview-html-hidden');
    });
    $('#viwcr-preview-emails-button').on('click', function () {
        let button = $(this);
        button.addClass('loading');

        $.ajax({
            method: 'POST',
            url: viwcr_ajax.ajax,
            data: {
                action: 'preview_emails_ajax',
                nonce: viwcr_ajax.nonce,
                heading: $('#viwcr_email_header').val(),
                content: tinyMCE.get('viwcr-email_content') ? tinyMCE.get('viwcr-email_content').getContent() : $('#viwcr-email_content').val(),
                templace_replace: $('#viwcr_email_content_replace').val(),
                button_shop_size: $('#viwcr_button_font_size').val(),
                button_text_color: $('#viwcr_button_text_color').val(),
                button_background_color: $('#viwcr_button_background').val(),
                button_shop_title: $('#viwcr_button_title').val(),
                button_shop_url: $('#viwcr_button_url').val(),

            },
            dataType: 'JSON',
            success: function (response) {
                button.removeClass('loading');

                if (response) {
                    $('.preview-emails-html').html(response.html);
                    $('.preview-emails-html-container').removeClass('preview-html-hidden');
                }
            },
            error: function (err) {
                button.removeClass('loading');
            }
        })
    });
    $('.viwcr-action_enable').on('change', function () {
        let $this = $(this),
            checkboxChecked = 'on',
            checkboxClosest = $this.closest('tr.type-viwcr_email_template '),
            post_id = checkboxClosest.find('.check-column input').val();
        $this.prop('disabled', true);

        if ($this.prop("checked")) {
            checkboxChecked = 'on';
        } else {
            checkboxChecked = 'off';
        }
        $.ajax({
            method: 'POST',
            url: viwcr_ajax.ajax,
            data: {
                action: 'action_ajax_enable_email',
                post_id: post_id,
                checkboxChecked: checkboxChecked,
                nonce: viwcr_ajax.nonce
            },
            dataType: 'JSON',
            success: function (response) {
                $this.prop('disabled', false);
            },
            error: function (err) {
                alert('Error');
                $this.prop('disabled', false);
            }
        })
    });


});


