/**
 *  For leadership filter, load data on scroll.
 */

$(function () {
    var $infinite_scroll_container = $('#filtered-results');
    var is_max_paged = $infinite_scroll_container.attr('data-max-paged') || false;
    var clear_results = false;
    var is_loading_more = false;
    var filters_delayTimer;

    var rxo_filter_infinity_scroll = function (event) {
        var window_scroll_bottom = $(window).scrollTop() + $(window).height();
        var scroll_offset = parseInt(100);
        var results_scroll_bottom = $infinite_scroll_container.offset().top + $infinite_scroll_container.height();
        if (window_scroll_bottom > (results_scroll_bottom + scroll_offset)) {
            get_leadership_results();
        }
    };

    var get_leadership_results = function (event) {
        if (clear_results) {
            is_max_paged = false;
        }

        if ($infinite_scroll_container.length == 1 && !is_loading_more && !is_max_paged) {
            var data = {
                action: $infinite_scroll_container.attr('data-action'),
                nonce: rxo_filter.nonce,
                args: $infinite_scroll_container.attr('data-filter-args'),
                paged: $infinite_scroll_container.attr('data-filter-page'),
                filters: $('#filter-form').serialize()
            }
            console.log('🚀 ~ file: rxo-filter.js ~ line 34 ~ data', data);

            if (clear_results) {
                data.paged = 1;
                $infinite_scroll_container.empty();
                clear_results = false;
            }

            $.ajax({
                url: rxo_filter.ajaxurl,
                data,
                type: 'POST',
                dataType: "json",
                beforeSend: function () {
                    $('#empty-results').hide();
                    $("#ajax-loader-message").show();
                    is_loading_more = true;
                    $('#ajax-loading-error').empty().hide();
                },
                success: function (response) {
                    if (response && response.data) {
                        if (response.data.results) {
                            $infinite_scroll_container.append(response.data.results);
                            $infinite_scroll_container.attr('data-filter-page', ++data.paged);
                        } else if (!$infinite_scroll_container.children().length) {
                            $('#empty-results').show();
                        }

                        is_max_paged = response.data.is_max_paged || false;
                    }
                },
                error: function (response) {
                    // Show error messages
                    console.log(response);
                    $('#ajax-loading-error').append(response.data.error).show();
                },
                complete: function () {
                    $("#ajax-loader-message").hide();
                    is_loading_more = false;
                }
            });
        } else {
            //End of results
        }
    };

    var addURLparams = function () {
        var formValues = $('#filter-form').serializeArray();
        const url = new URL(window.location.href);
        $.each(formValues, function (i, obj) {
            if (obj.value && obj.value.length) {
                url.searchParams.set(obj.name, obj.value);
            } else {
                url.searchParams.delete(obj.name);
            }
        });
        window.history.replaceState(null, null, url);
    }

    $('#filter-form').on('change', function (e) {
        clear_results = true;
        addURLparams();
        get_leadership_results();
    });

    if ($infinite_scroll_container.length) {
        $(window).on("scroll", rxo_filter_infinity_scroll);
    }

    $('#filter-daterange').each(function () {
        const post = $(this).data('post-type');
        const elem = this;
        const date = new Date();
        date.setMonth(date.getMonth() - 6);
        const options = {
            buttonClass: 'btn',
            autohide: true,
            allowOneSidedRange: true,
            format: 'dd/M/yy',
            maxView: 2,
            showDaysOfWeek: false,
            maxDate: new Date()
        };

        if (post === 'news_article') {
            options.minDate = date
        }

        const dateRangePicker = new DateRangePicker(elem, options);

        $(elem).find('input').each(function () {
            $(this).on('changeDate', function (e) {
                console.log(e);
                $(this).blur();
                if (!$('#filter-daterange input[name="date_after"]')[0].value.length || !$('#filter-daterange input[name="date_before"]')[0].value.length) {
                    return false;
                }
                // delay until both inputs update values
                clearTimeout(filters_delayTimer);
                filters_delayTimer = setTimeout(function () {
                    clear_results = true;
                    get_leadership_results();
                }, 300);
            });
        });
    });
});