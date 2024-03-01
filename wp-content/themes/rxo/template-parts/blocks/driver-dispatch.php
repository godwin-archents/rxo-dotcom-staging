<?php

/**
 * Block Name: Driver Dispatch 
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
$className = 'rxo-block ' . str_replace('acf/rxo-acf-', '', $block['name']);

if (!empty($block['className'])) {
    $className .= sprintf(' %s', $block['className']);
}


$url = get_field('url');
$token = get_field('token');
if (isset($_REQUEST['auth-token'])) {
    $token = $_REQUEST['auth-token'];
}
?>
<?php if ($url) : ?>
    <?php
    $geturl = $url . $token;
    $my_curl = curl_init();
    curl_setopt($my_curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($my_curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($my_curl, CURLOPT_URL, $geturl);
    $result = curl_exec($my_curl);
    $httpcode = curl_getinfo($my_curl, CURLINFO_HTTP_CODE);
    if ($httpcode != 200) {
        if ($_REQUEST['action'] != "edit") {
            echo '<script>location.href = "/dispatch-error/";</script>';
        }
        echo '<script>console.log("tracking_error ' . $httpcode . '", "' . curl_error($my_curl) . '");</script>';
        $data = '';
    } else {
        $data = json_decode($result, true);
    }
    curl_close($my_curl);

    if ($data) {
        $carrierCode = $data['carrierCode'];
    } else {
        $carrierCode = '';
    }
    ?>
<?php endif; ?>
<div class=" <?php echo $uid; ?> <?php echo esc_attr($className); ?>">
    <?php if ($url) : ?>
        <div class="load-info">

            <div class="wpforms-container wpforms-container-full" id="wpforms-2304">
                <form id="wpforms-form-2304" class="wpforms-validate wpforms-form" data-formid="2304" method="post" enctype="multipart/form-data" action="/carrier-dispatch/" data-token="c6b0ed6f17d73b65aac635f293c7e3a0">
                    <noscript class="wpforms-error-noscript">Please enable JavaScript in your browser to complete this form.</noscript>
                    <div class="wpforms-field-container">
                        <div id="wpforms-2304-field_1-container" class="wpforms-field wpforms-field-name" data-field-id="1"><label class="wpforms-field-label" for="wpforms-2304-field_1">Driver Name <span class="wpforms-required-label">*</span></label><input type="text" id="wpforms-driverName" class="wpforms-field-large wpforms-field-required" name="wpforms[fields][1]" placeholder="First and Last Name" required></div>
                        <div id="wpforms-2304-field_2-container" class="wpforms-field wpforms-field-phone" data-field-id="2"><label class="wpforms-field-label" for="wpforms-2304-field_2">Mobile Phone <span class="wpforms-required-label">*</span></label><input type="text" id="wpforms-trackingPhoneNumber" class="wpforms-field-large wpforms-field-required wpforms-smart-phone-field" data-rule-smart-phone-field="true" name="wpforms[fields][2]" placeholder="777-777-7777" required></div>
                        <div id="wpforms-2304-field_4-container" class="wpforms-field wpforms-field-select wpforms-conditional-trigger wpforms-field-select-style-modern" data-field-id="4">
                            <label class="wpforms-field-label" for="wpforms-2304-field_4">Tracking Method <span class="wpforms-required-label">*</span></label>
                            <select onchange="choose(this.value)" id="wpforms-preferredTrackingMethod" class="wpforms-field-large wpforms-field-required choicesjs-select js-choice" data-size-class="wpforms-field-row wpforms-field-large" data-search-enabled="" name="wpforms[fields][4]" required="required">
                                <option value="" class="placeholder" disabled selected='selected'>Choose One</option>
                                <option value="Driver Phone#">Mobile</option>
                                <option value="Trailer/Satellite">Trailer/Satellite</option>
                                <option value="ELD">Truck/ELD</option>
                            </select>
                        </div>
                        <div id="wpforms-2304-field_5-container" class="wpforms-field wpforms-field-text wpforms-conditional-field wpforms-conditional-show" data-field-id="5" style="display:none;"><label class="wpforms-field-label" for="wpforms-2304-field_5">Truck Number <span class="wpforms-required-label">*</span></label><input type="text" id="wpforms-tractorNumber" class="wpforms-field-large wpforms-field-required" name="wpforms[fields][5]" placeholder="ex: 16576" required></div>
                        <div id="wpforms-2304-field_6-container" class="wpforms-field wpforms-field-text wpforms-conditional-field wpforms-conditional-show" data-field-id="6" style="display:none;"><label class="wpforms-field-label" for="wpforms-2304-field_6">Trailer number <span class="wpforms-required-label">*</span></label><input type="text" id="wpforms-trailerNumber" class="wpforms-field-large wpforms-field-required" name="wpforms[fields][6]" placeholder="ex: 16576" required></div>
                    </div>
                    <div class="wpforms-submit-container">
                        <button onclick="send()" type="button" name="wpforms[submit]" id="wpforms-submit-2304" class="wpforms-page-button mt-4" data-alt-text="Sending..." data-submit-text="Submit" aria-live="assertive" value="wpforms-submit">Add Information</button>
                    </div>
                </form>
            </div>

            <div id="target" style="padding-top: 20px;"></div>
        </div>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                <?php esc_html_e('No data available to show'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<style>
    body div.wpforms-container .wpforms-form .wpforms-required-label {
        color: var(--#{$prefix}red) !important;
    }
</style>
<script type="text/javascript">
    function choose(val) {
        if (val == "Driver Phone#") {
            $("#wpforms-2304-field_2-container").show();
            $("#wpforms-2304-field_5-container").hide();
            $("#wpforms-2304-field_6-container").hide();
        }

        if (val == "Trailer/Satellite") {
            $("#wpforms-2304-field_2-container").show();
            $("#wpforms-2304-field_5-container").hide();
            $("#wpforms-2304-field_6-container").show();
        }

        if (val == "ELD") {
            $("#wpforms-2304-field_2-container").show();
            $("#wpforms-2304-field_5-container").show();
            $("#wpforms-2304-field_6-container").hide();
        }
    }

    function send() {

        if ($("#wpforms-driverName").val() == "" || $("#wpforms-trackingPhoneNumber").val() == "" || $("#wpforms-preferredTrackingMethod").val() == "") {
            alert("Please Fill Driver Dispatch Form Required Details");
            return false;
        }

        var formdata = {
            encryptedKey: '<?php echo $token; ?>',
            driverName: $("#wpforms-driverName").val(),
            trackingPhoneNumber: $("#wpforms-trackingPhoneNumber").val(),
            tractorNumber: $("#wpforms-tractorNumber").val(),
            trailerNumber: $("#wpforms-trailerNumber").val(),
            carrierCode: '<?php echo $carrierCode; ?>',
            preferredTrackingMethod: $("#wpforms-preferredTrackingMethod").val(),
            updatedBy: "Track-Dispatch-UI"
        }

        $('#target').html('sending..');

        $.ajax({
            url: '<?php echo $url; ?>',
            type: 'post',
            dataType: 'json',
            contentType: 'application/json',
            success: function(data) {
                console.log(data);
                $('#target').html(data);
                document.getElementById("wpforms-form-2304").reset();

            },
            data: JSON.stringify(formdata)
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        selectInputs = document.querySelectorAll('.rxo-block .js-choice');
        [].forEach.call(selectInputs, function(sEl, i) {
            let choices = new Choices(sEl, {
                searchEnabled: false,
                allowHTML: true,
                placeholderValue: '',
                searchPlaceholderValue: 'Search',
            });
        });
    });
</script>