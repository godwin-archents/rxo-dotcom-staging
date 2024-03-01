<?php

/**
 * Block Name: Vehicle Services API
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// create id attribute for specific styling
$uid = 'rxo-acf-container-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'rxo-block-' . str_replace('acf/rxo-acf-', '', $block['name']);

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if (!empty($block['className'])) {
    $className .= sprintf(' %s', $block['className']);
}

$fname = '';
$lname = '';
$email = '';
$mobile = '';
$date = '';
$vin = '';
$origin_zipCode = '';
$destination_zipCode = '';
$vs_form_id = VS_FORM_ID;

if (isset($_POST['wpforms']['fields'])) {

    $fname = $_POST['wpforms']['fields'][6];
    $lname =  $_POST['wpforms']['fields'][7];
    $email =  $_POST['wpforms']['fields'][1];
    $mobile =  $_POST['wpforms']['fields'][8];
    $date =  $_POST['wpforms']['fields'][20];
    $vin =  $_POST['wpforms']['fields'][14];
    $origin_zipCode =  $_POST['wpforms']['fields'][9];
    $destination_zipCode =  $_POST['wpforms']['fields'][13];

    $post_fields = array();
    $post_fields[14]['value'] = $vin;
    $post_fields[9]['value'] = $origin_zipCode;
    $post_fields[13]['value'] = $destination_zipCode;


    $rxo_stored_session_vs = sanitize_text_field(get_transient('wp_rxo_dotcom_vs'));
    if ($rxo_stored_session_vs) {
        $vs_response_fields = json_decode(base64_decode($rxo_stored_session_vs));
        $vs_response_fields = std_object_to_array($vs_response_fields);
    }

    $vs_vehicle_year = ($vs_response_fields) ? $vs_response_fields[16]['value'] : '';
    $vs_vehicle_make = ($vs_response_fields) ? $vs_response_fields[17]['value'] : '';
    $vs_vehicle_model = ($vs_response_fields) ? $vs_response_fields[18]['value'] : '';
    $vs_vehicle_price = ($vs_response_fields) ? $vs_response_fields[19]['value'] : '';
}
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="container position-relative py-10 d-flex flex-column">
        <div class="row">
            <div class="col-lg-6 col-12">
                <p class="mb-6">For general inquiries and urgent needs, fill out the form below and one of our reps will reach out immediately.</p>

                <div id="wpform-vehicle-service">
                    <?php echo do_shortcode('[wpforms id="' . $vs_form_id . '"]'); ?>
                </div>

            </div>
            <div class="col-lg-6 col-12">

                <div class="rxo-vs-load-info mb-5">
                    <h3 class="has-text-align-left m-0 mb-5">Vehicle Information</h3>

                    <div class="row vs-vechicle-info m-0">
                        <div class="col-lg-4 col-12 text-center">
                            <p class="fw-700 pb-3 mb-3">Year</p>
                            <div id="pickuptimevalue" class="text-black"><?= $vs_vehicle_year; ?></div>
                        </div>
                        <div class="col-lg-4 col-12 text-center">
                            <p class="fw-700 pb-3 mb-3">Make</p>
                            <div id="originvalue" class="text-black pb-3"><?= $vs_vehicle_make; ?></div>
                        </div>
                        <div class="col-lg-4 col-12 text-center">
                            <p class="fw-700 pb-3 mb-3">Model</p>
                            <div id="destinationvalue" class="text-black pb-3"><?= $vs_vehicle_model; ?></div>
                        </div>
                    </div>
                </div>
                <?php if ($vs_response_fields) : ?>
                    <?php if ($vs_response_fields[19]['value'] != '' && $vs_response_fields[19]['value'] != '??') : ?>
                        <div class="rxo-vs-load-info mb-5">
                            <h3 class="has-text-align-left m-0 mb-5">Your Quote</h3>

                            <div class="vs-vechicle-info m-0 text-center">
                                <h3 class="border-bottom-0 m-0"><?= $vs_vehicle_price; ?><?php //echo '$'. number_format($vs_vehicle_price, 2) .' USD';
                                                                                            ?></h3>
                            </div>
                        </div>
                        <div class="rxo-vs-load-info mb-5">
                            <p class="mb-5">Thank you for quoting with RXO. A Logistics Specialist will be following up with you in the next 15 to 30 minutes via phone and/or email to gather additional information.</p>
                            <p>If your need is immediate please call us directly at <a href="tel:602-635-1050" rel="nofollow">602-635-1050</a>.</p>
                        </div>
                    <?php endif; ?>
                    <?php if ($vs_response_fields[19]['value'] == '??') : ?>
                        <div class="rxo-vs-load-info mb-5">
                            <h3 class="has-text-align-left m-0 mb-5">Your Quote</h3>
                        </div>
                        <div class="rxo-vs-load-info mb-5">
                            <p class="mb-5 fw-bold">Unfortunately, we can’t provide a quote at this time. One of our reps will reach out to you soon.</p>
                        </div>
                    <?php endif; ?>
                <?php elseif (show_block_error()) : ?>
                    <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
                        <div class="toast-body">
                            <?php esc_html_e('Unfortunately, we can’t provide a quote at this time. One of our reps will reach out to you soon.'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div> <!-- Container -->
</div> <!-- Main div -->

<script>
    $(function() {
        $("#wpforms-<?= $vs_form_id ?>-field_6").val("<?= $fname ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_6").val("<?= $fname ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_7").val("<?= $lname ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_1").val("<?= $email ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_8").val("<?= $mobile ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_20").val("<?= $date ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_14").val("<?= $vin ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_9").val("<?= $origin_zipCode ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_13").val("<?= $destination_zipCode ?>");
    });

    $(function() {

        $('input').on('keypress', function(e) {
            if (e.which === 32 && !this.value.length)
                e.preventDefault();
        });

        $('#wpforms-<?= $vs_form_id ?>-field_20-container #wpforms-<?= $vs_form_id ?>-field_20').each(function() {
            const elem = this;
            const options = {
                buttonClass: 'btn',
                autohide: true,
                allowOneSidedRange: true,
                format: 'dd/M/yy',
                maxView: 1,
                showDaysOfWeek: false,
                singleDatePicker: true,
                minDate: new Date()
            };

            const dateRangePicker = new Datepicker(elem, options);

            <?php if ($date != '') { ?>
                $("#wpforms-<?= $vs_form_id ?>-field_20-container #wpforms-<?= $vs_form_id ?>-field_20").val('<?= $date ?>');
            <?php } ?>
        });

    });
</script>

<?php /* ?>
<?php

// create id attribute for specific styling
$uid = 'rxo-acf-container-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'rxo-block-' . str_replace('acf/rxo-acf-', '', $block['name']);
$className .= ' ' . $block['className'] ?? '';

if (!empty($block['className'])) {
    $className .= sprintf(' %s', $block['className']);
}

$fname = '';
$lname = '';
$email = '';
$mobile = '';
$date = '';
$vin = '';
$origin_zipCode = '';
$destination_zipCode = '';

$hostname = $_SERVER['SERVER_NAME'];
$vs_form_id = VS_FORM_ID;

if (isset($_POST['wpforms']['fields'])) {
    $fname = $_POST['wpforms']['fields'][6];
    $lname =  $_POST['wpforms']['fields'][7];
    $email =  $_POST['wpforms']['fields'][1];
    $mobile =  $_POST['wpforms']['fields'][8];
    $date =  $_POST['wpforms']['fields'][20];
    $vin =  $_POST['wpforms']['fields'][14];
    $origin_zipCode =  $_POST['wpforms']['fields'][9];
    $destination_zipCode =  $_POST['wpforms']['fields'][13];

    $post_fields = array();
    $post_fields[14]['value'] = $vin;
    $post_fields[9]['value'] = $origin_zipCode;
    $post_fields[13]['value'] = $destination_zipCode;


    $rxo_stored_session_vs = sanitize_text_field(get_transient('wp_rxo_dotcom_vs'));
    if ($rxo_stored_session_vs) {
        $vs_response_fields = json_decode(base64_decode($rxo_stored_session_vs));
        $vs_response_fields = std_object_to_array($vs_response_fields);
    }

    $vs_vehicle_year = ($vs_response_fields) ? $vs_response_fields[16]['value'] : '';
    $vs_vehicle_make = ($vs_response_fields) ? $vs_response_fields[17]['value'] : '';
    $vs_vehicle_model = ($vs_response_fields) ? $vs_response_fields[18]['value'] : '';
    $vs_vehicle_price = ($vs_response_fields) ? $vs_response_fields[19]['value'] : '';
}

?>


<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="container position-relative py-10 d-flex flex-column">
        <div class="row">
            <div class="col-lg-6 col-12">
                <p class="mb-6">For general inquiries and urgent needs, fill out the form below and one of our reps will reach out immediately.</p>

                <div id="wpform-vehicle-service">
                    <?php echo do_shortcode('[wpforms id="' . $vs_form_id . '"]'); ?>
                </div>

            </div>
            <div class="col-lg-6 col-12">

                <div class="rxo-vs-load-info mb-5">
                    <h3 class="has-text-align-left m-0 mb-5">Vehicle Information</h3>

                    <div class="row vs-vechicle-info m-0">
                        <div class="col-lg-4 col-12 text-center">
                            <p class="fw-700 pb-3 mb-3">Year</p>
                            <div id="pickuptimevalue" class="text-black"><?= $vs_vehicle_year; ?></div>
                        </div>
                        <div class="col-lg-4 col-12 text-center">
                            <p class="fw-700 pb-3 mb-3">Make</p>
                            <div id="originvalue" class="text-black pb-3"><?= $vs_vehicle_make; ?></div>
                        </div>
                        <div class="col-lg-4 col-12 text-center">
                            <p class="fw-700 pb-3 mb-3">Model</p>
                            <div id="destinationvalue" class="text-black pb-3"><?= $vs_vehicle_model; ?></div>
                        </div>
                    </div>
                </div>
                <?php if ($vs_response_fields) : ?>
                    <?php if ($vs_response_fields[19]['value'] != '' && $vs_response_fields[19]['value'] != '??') : ?>
                        <div class="rxo-vs-load-info mb-5">
                            <h3 class="has-text-align-left m-0 mb-5">Your Quote</h3>

                            <div class="vs-vechicle-info m-0 text-center">
                                <h3 class="border-bottom-0 m-0"><?= $vs_vehicle_price; ?></h3>
                            </div>
                        </div>
                        <div class="rxo-vs-load-info mb-5">
                            <p class="mb-5">Thank you for quoting with RXO. A Logistics Specialist will be following up with you in the next 15 to 30 minutes via phone and/or email to gather additional information.</p>
                            <p>If your need is immediate please call us directly at <a href="tel:602-635-1050" rel="nofollow">602-635-1050</a>.</p>
                        </div>
                    <?php endif; ?>
                    <?php if ($vs_response_fields[19]['value'] == '??') : ?>
                        <div class="rxo-vs-load-info mb-5">
                            <h3 class="has-text-align-left m-0 mb-5">Your Quote</h3>
                        </div>
                        <div class="rxo-vs-load-info mb-5">
                            <p class="mb-5 fw-bold">Unfortunately, we can’t provide a quote at this time. One of our reps will reach out to you soon.</p>
                        </div>
                    <?php endif; ?>
                <?php elseif (show_block_error()) : ?>
                    <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
                        <div class="toast-body">
                            <?php esc_html_e('Unfortunately, we can’t provide a quote at this time. One of our reps will reach out to you soon.'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div> <!-- Container -->
</div> <!-- Main div -->

<script>
    $(function() {
        $("#wpforms-<?= $vs_form_id ?>-field_6").val("<?= $fname ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_6").val("<?= $fname ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_7").val("<?= $lname ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_1").val("<?= $email ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_8").val("<?= $mobile ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_20").val("<?= $date ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_14").val("<?= $vin ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_9").val("<?= $origin_zipCode ?>");
        $("#wpforms-<?= $vs_form_id ?>-field_13").val("<?= $destination_zipCode ?>");
    });

    $(function() {

        $('input').on('keypress', function(e) {
            if (e.which === 32 && !this.value.length)
                e.preventDefault();
        });

        $('#wpforms-<?= $vs_form_id ?>-field_20-container #wpforms-<?= $vs_form_id ?>-field_20').each(function() {
            const elem = this;
            const options = {
                buttonClass: 'btn',
                autohide: true,
                allowOneSidedRange: true,
                format: 'dd/M/yy',
                maxView: 1,
                showDaysOfWeek: false,
                singleDatePicker: true,
                minDate: new Date()
            };

            const dateRangePicker = new Datepicker(elem, options);
            <?php if ($date != '') { ?>
                $("#wpforms-<?= $vs_form_id ?>-field_20-container #wpforms-<?= $vs_form_id ?>-field_20").val('<?= $date ?>');
            <?php } ?>
        });
    });
</script>
<?php */ ?>