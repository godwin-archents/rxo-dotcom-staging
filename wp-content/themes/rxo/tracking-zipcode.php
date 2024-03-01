<?php
/*
 * Template Name: Tracking with Zipcode
 * description: Template for tracking page with tracking code
 */
require_once get_template_directory() . '/inc/tracking-codes.php';

get_header();
?>
<?php
$trackingNumber = filter_var($_REQUEST['trackingNumber'], FILTER_SANITIZE_STRING);

$orderNumber = filter_var($_REQUEST['orderNumber'], FILTER_SANITIZE_STRING);

$zipcodeNumber = filter_var($_REQUEST['zipcode'], FILTER_SANITIZE_STRING);

if (!empty($trackingNumber)) {
    /*
    $multiple_track_codes = is_multiple_track_codes($trackingNumber);
    $is_multiple_track_codes = count($multiple_track_codes) ? true : false;

    if (!$is_multiple_track_codes) {
        $is_track_code = is_track_code($trackingNumber);
    } else {
        $is_track_code = true;
    }
    */
    $is_track_code = true;

    if ($is_track_code) {
        $client_id = TRACKING_CLIENT_ID;
        $client_secret = TRACKING_CLIENT_SECRET;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => TRACKING_SECRET_API,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => array(
                "Accept: application/json",
                "Content-Type: application/json; charset=utf-8",
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'grant_type' => 'client_credentials'
            ),
        ));

        $token = curl_exec($ch);
        $token_httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!$token || $token_httpcode != 200) {
            echo '<script>console.log("token_error ' . $token_httpcode . '", "' . curl_error($ch) . '");</script>';
        }
        curl_close($ch);

        $bearer_token = json_decode($token);

        $curl = curl_init();

        if ($is_multiple_track_codes) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_MULTIPLE_API,
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
                CURLOPT_POSTFIELDS => json_encode($multiple_track_codes)
            ));
        } else {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_API . $trackingNumber,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
            ));
        }

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (!$response || $httpcode != 200) {
            echo '<script>console.log("tracking_error ' . $httpcode . '", "' . curl_error($curl) . '");</script>';
        }
        curl_close($curl);

        $res = json_decode($response);
        $data = std_object_to_array($res);

        if ($data['redirectUrl']) {

            $url = $data['redirectUrl'];
            wp_redirect($url);
            exit;
        }

        if ($data['statusCode'] && $data['statusCode'] == 500) {

            //$url = $data['redirectUrl'];
            //wp_redirect($url);
            //exit;
            $data=[];
        }

        


        // For debugging purpose
        echo '<script>console.log("tracking_response", ' . $response . ');</script>';
    }
}



if ((!empty($orderNumber)) && (!empty($zipcodeNumber))) {
    /*
    $multiple_track_codes = is_multiple_track_codes($trackingNumber);
    $is_multiple_track_codes = count($multiple_track_codes) ? true : false;

    if (!$is_multiple_track_codes) {
        $is_track_code = is_track_code($trackingNumber);
    } else {
        $is_track_code = true;
    }
    */
    $is_track_code = true;

    $trackingOrder = "order/" . $orderNumber . "/zip/" . $zipcodeNumber;

    //$trackingOrder = "order/12592996/zip/J1N1H3";

    if ($is_track_code) {
        $client_id = TRACKING_CLIENT_ID;
        $client_secret = TRACKING_CLIENT_SECRET;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => TRACKING_SECRET_API,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => array(
                "Accept: application/json",
                "Content-Type: application/json; charset=utf-8",
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'grant_type' => 'client_credentials'
            ),
        ));

        $token = curl_exec($ch);
        $token_httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!$token || $token_httpcode != 200) {
            echo '<script>console.log("token_error ' . $token_httpcode . '", "' . curl_error($ch) . '");</script>';
        }
        curl_close($ch);

        $bearer_token = json_decode($token);

        $curl = curl_init();

        if ($is_multiple_track_codes) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_MULTIPLE_API,
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
                CURLOPT_POSTFIELDS => json_encode($multiple_track_codes)
            ));
        } else {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_WITH_ZIPCODE_API . $trackingOrder,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
            ));
        }

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (!$response || $httpcode != 200) {
            echo '<script>console.log("tracking_error ' . $httpcode . '", "' . curl_error($curl) . '");</script>';
        }
        curl_close($curl);

        $res = json_decode($response);
        $data = std_object_to_array($res);

        // For debugging purpose
        echo '<script>console.log("tracking_response", ' . $response . ');</script>';
    }
}

?>
<?php if ($is_multiple_track_codes && $data && count($data) && $httpcode == 200) : ?>

<?php elseif ($is_track_code && $data && count($data) && $httpcode == 200) : ?>
    <?php

    $deliveryInfo = array();
    $progressInfo =  array();
    $keyInfo =  array();
    $groupInfo =  array();
    $groupInfoRows = array();
    $accordionInfo =  array();
    $equipmentInfo =  array();
    $shipmentInfo =  array();
    $trackingNumber = '';

    foreach ($data['components'] as $componentsData) {
        if ($componentsData['component_name'] == "track-delivery-details") {
            $deliveryInfo = $componentsData['component_data'];
        }
        if ($componentsData['component_name'] == "track-progress-tracker") {
            $progressInfo = $componentsData['component_data'];
        }
        if ($componentsData['component_name'] == "track-key-value-list") {
            $keyInfo = $componentsData['component_data']['items'];
            $trackingNumber = $keyInfo[0]['item_value'];
        }
        if ($componentsData['component_name'] == "track-group-list") {
            $groupInfo = $componentsData['component_data']['items'];
            if (isset($groupInfo[0]['group_rows'])) {
                $groupInfoRows = $groupInfo[0]['group_rows'];
            }
        }
        if ($componentsData['component_name'] == "track-accordion") {
            if ($componentsData['panel_title'] == "Items") {
                $accordionInfo = $componentsData['component_data']['items'];
            }
            if ($componentsData['panel_title'] == "EQUIPMENT") {
                $equipmentInfo = $componentsData['component_data']['items'];
            }
        }
        if ($componentsData['component_name'] == "track-table") {
            $shipmentInfo = $componentsData['component_data'];
        }
    }
    ?>
<?php else : ?>

<?php endif; ?>


<main id="primary" class="site-main">
    <div class="container-fluid px-0 bg-black py-7 bg-pattern-right">
        <div class="container">
            <h2 class="text-white">Tracking Results</h2>
        </div>
    </div>
    <div class="container py-6">
        <div class="row">
            <div class="col-12">
                <!--
                <form class="align-items-center border-2 border-bottom border-primary-dark d-flex" action="<?php echo esc_url(home_url('/tracking-with-zipcode')); ?>" method="GET">
                    <input type="text" maxlength="255" placeholder="Tracking Number" name="trackingNumber" id="search-input" class="form-control flex-grow-1 order-1 border-0 bg-transparent" value="<?= $trackingNumber; ?>" required />
                    <button class="btn btn-link py-0 order-2 order-xl-0" type="submit" aria-label="search">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.6368 11.8022C9.52023 12.6702 8.11723 13.187 6.59352 13.187C2.95202 13.187 0 10.235 0 6.59352C0 2.95202 2.95202 0 6.59352 0C10.235 0 13.187 2.95202 13.187 6.59352C13.187 8.11718 12.6702 9.52013 11.8023 10.6366L16 14.8343L14.8344 15.9998L10.6368 11.8022ZM11.5387 6.59352C11.5387 9.32463 9.32463 11.5387 6.59352 11.5387C3.8624 11.5387 1.64838 9.32463 1.64838 6.59352C1.64838 3.8624 3.8624 1.64838 6.59352 1.64838C9.32463 1.64838 11.5387 3.8624 11.5387 6.59352Z" fill="#1C1C1C"></path>
                        </svg>
                    </button>
                    <button class="btn btn-link py-0 order-3 d-none d-xl-block" onclick="hideSearchContainer()" type="button" aria-label="close searchbar">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.53267 8L15.6633 1.86253C16.0886 1.43681 16.0886 0.745011 15.6633 0.31929C15.2381 -0.10643 14.5471 -0.10643 14.1218 0.31929L7.99114 6.45676L1.86047 0.337029C1.43522 -0.0886917 0.744186 -0.0886917 0.318937 0.337029C-0.106312 0.762749 -0.106312 1.45455 0.318937 1.88027L6.44961 8L0.336656 14.1375C-0.0885936 14.5632 -0.0885936 15.255 0.336656 15.6807C0.761905 16.1064 1.45293 16.1064 1.87818 15.6807L8.00886 9.54324L14.1395 15.6807C14.5648 16.1064 15.2558 16.1064 15.6811 15.6807C16.1063 15.255 16.1063 14.5632 15.6811 14.1375L9.53267 8Z" fill="#1C1C1C"></path>
                        </svg>
                    </button>
                </form>
                -->
                <form class="align-items-center" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
                    <div class="w-100">
                        <div class="col-md-12 col-sm-12 col-lg-4 p-2 float-start">
                            <input type="text" maxlength="255" placeholder="Order Number" name="orderNumber" id="search-input" class="form-control" required  value="<?= $orderNumber; ?>" />
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-4 p-2 float-start">
                            <input type="text" maxlength="255" placeholder="Zipcode" name="zipcode" id="search-input" class="form-control" required  value="<?= $zipcodeNumber; ?>"/>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-4 p-2 float-start">
                            <button class="btn btn-primary" type="submit" aria-label="search">Track a shipment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php if ($is_multiple_track_codes && $data && count($data) && $httpcode == 200) : ?>

    <?php elseif ($is_track_code && $data && count($data) && $httpcode == 200) : ?>


        <div class="container article-width pb-6">
            <div class="row mb-7">
                <div class="col-12">
                    <?php if (trim($deliveryInfo['title']) != "") { ?>
                        <p class="mb-0"><?php echo $deliveryInfo['title']; ?> </p>
                    <?php } ?>
                    <?php if (trim($deliveryInfo['weekday']) != "") { ?>
                        <h3 class="my-2"><?php echo $deliveryInfo['weekday']; ?>, <?php echo $deliveryInfo['month_day']; ?> at <?php echo $deliveryInfo['time']; ?> </h3>
                    <?php } ?>
                    <div class="progress-steps col-12 col-lg-10 mx-auto my-5">
                        <?php
                        $progressCurrentStep = $progressInfo['complete_step'];
                        $progressCurrentState = $progressInfo['state'];

                        if (count($progressInfo['progress_items']) > 0) {
                            $p = 0;
                            foreach ($progressInfo['progress_items'] as $progressInfoItemData) {
                                $p++;
                        ?>
                        <div class="steps 
                        <?php 
                        if ($progressCurrentStep > $p) { echo 'complete'; } 
                        else if ($progressCurrentStep == $p && $progressCurrentState=="success" && $progressCurrentStep == 1) { echo 'complete'; } 
                        else if ($progressCurrentStep == $p && $progressCurrentState=="success" && $progressCurrentStep == 3) { echo 'complete'; } 
                        else if ($progressCurrentStep == $p && $progressCurrentState=="success" && $progressCurrentStep < 3) { echo 'inprogress'; } 
                        else if ($progressCurrentStep == $p && $progressCurrentState=="warning") { echo 'indanger'; } 
                        else if ($progressCurrentStep == $p+1) { echo 'inprogress'; } 
                        else { } 
                        ?> 
                        ">
                        <?php echo $progressInfoItemData['label']; ?>
                        </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                    <p>Tracking number: <strong><?php echo $trackingNumber; ?></strong></p>
                    <?php if (isset($deliveryInfo['badge_label'])) { ?>
                        <p>Status:<strong><?php echo $deliveryInfo['badge_label']; ?></strong></p>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <?php if (count($keyInfo) > 0) { ?>
                        <div class="mb-7">
                            <h4 class="border-bottom">Details</h4>
                            <?php
                            foreach ($keyInfo as $keyInfoData) {
                            ?>
                                <?php if ($keyInfoData['item_key'] != "Tracking #") { ?>
                                    <p class="mb-2"><?php echo $keyInfoData['item_key']; ?>: <strong><?php echo $keyInfoData['item_value']; ?></strong></p>
                                <?php } ?>
                            <?php
                            }
                            ?>
                        </div>
                    <?php } ?>
                    <?php if (count($equipmentInfo) > 0) { ?>
                        <div class="mb-7">
                            <h4 class="border-bottom">Equipment</h4>
                            <?php
                            $i = 0;
                            foreach ($equipmentInfo as $equipmentInfoData) {
                                $i++;
                            ?>
                                <p class="mb-2">ID: <strong> <?php echo $equipmentInfoData['item_title']; ?></strong></p>
                                <?php foreach ($equipmentInfoData['item_details'] as $equipmentInfoDetailData) { ?>
                                    <p class="mb-1"><?php echo $equipmentInfoDetailData['key']; ?>: <strong><?php echo $equipmentInfoDetailData['value']; ?></strong></p>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if (count($accordionInfo) > 0) { ?>
                        <div class="mb-5">
                            <h4 class="border-bottom">Items</h4>
                            <div class="accordion tracking-accordion" id="tracking-items">
                                <?php
                                $i = 0;
                                foreach ($accordionInfo as $accordionInfoData) {
                                    $i++;
                                ?>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header my-0" id="item<?= $i ?>">
                                            <button class="text-capitalize accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#details<?= $i ?>" aria-expanded="true" aria-controls="details<?= $i ?>">
                                                <?php echo $accordionInfoData['item_title']; ?>
                                            </button>
                                        </h5>
                                        <div id="details<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="item<?= $i ?>" data-bs-parent="#tracking-items">
                                            <div class="accordion-body">
                                                <?php foreach ($accordionInfoData['item_details'] as $accordionInfoDetailData) { ?>
                                                    <p class="mb-1"><?php echo $accordionInfoDetailData['key']; ?>: <strong><?php echo $accordionInfoDetailData['value']; ?></strong></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>


                    <?php if (count($shipmentInfo) > 0) { ?>
                        <div class="mb-5">
                            <h4 class="border-bottom">Shipments</h4>
                            <div class="accordion tracking-accordion" id="tracking-items">
                                <?php
                                $i = 1000;
                                $j = 0;
                                foreach ($shipmentInfo['table_head'] as $shipmentInfoData) {
                                    $i++;
                                    if ($shipmentInfoData == "Shipment #") {
                                ?>
                                        <?php foreach ($shipmentInfo['table_rows'] as $shipmentInfoRowData) { ?>
                                            <div class="accordion-item">
                                                <h5 class="accordion-header my-0" id="item<?= $i ?>">
                                                    <button class="text-capitalize accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#details<?= $i ?>" aria-expanded="true" aria-controls="details<?= $i ?>">
                                                        <?php echo $shipmentInfoData; ?> <?php echo $shipmentInfoRowData['row_items'][$j]['item_label']; ?>
                                                    </button>
                                                </h5>
                                                <div id="details<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="item<?= $i ?>" data-bs-parent="#tracking-items">
                                                    <div class="accordion-body">
                                                        <?php $k = 0;
                                                        foreach ($shipmentInfoRowData['row_items'] as $shipmentInfoDetailData) { ?>
                                                            <?php if ($shipmentInfo['table_head'][$k] == "Origin" || $shipmentInfo['table_head'][$k] == "Destination") {  ?>
                                                                <p class="mb-1"><?php echo $shipmentInfo['table_head'][$k]; ?>: <strong><?php echo $shipmentInfoDetailData['item_label']; ?></strong></p>
                                                            <?php } ?>
                                                            <?php if (trim($shipmentInfo['table_head'][$k]) == "") {  ?>
                                                                <?php
                                                                $item_link = $shipmentInfoDetailData['item_link'];
                                                                $item_track = str_replace("/track/shipment/", "", $item_link);
                                                                //$item_track = "RXONC60SHOGNFHPJ22";
                                                                ?>
                                                                <p class="mb-1"><a href="<?php echo esc_url(home_url('/tracking-with-zipcode')); ?>?trackingNumber=<?php echo $item_track; ?>" class="text-black text-decoration-underline">View Additional Details</a></p>
                                                            <?php } ?>
                                                        <?php $k++;
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                <?php
                                        $j++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>


                </div>
                <?php if (count($groupInfoRows) > 0) { ?>
                    <div class="col-12 col-lg-6">
                        <h4 class="border-bottom">History</h4>
                        <div class="d-flex flex-column progress-steps progress-vertical">
                            <?php
                            $i = 0;
                            foreach ($groupInfoRows as $groupInfoRowsData) {
                                $i++;

                                $location = explode(",", $groupInfoRowsData['row_content'][0]);
                            ?>
                                <div class="steps active">
                                    <div class="fs-6"><?php echo ucfirst(strtolower($groupInfoRowsData['row_head'])); ?></div>
                                    <div class="text-500"><?php echo $groupInfoRowsData['row_content'][1] . ' ' . ucwords(strtolower($location[0])) . ', ' . $location[1]; ?></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-12 col-lg-6"></div>
                <?php } ?>
            </div>
        </div>
    <?php else : ?>
        <div class="container article-width pb-6">
            <div class="row mb-7">
                <div class="col-12 col-md-11 col-lg-10 col-xl-9 mx-auto">
                    <?php
                    if (!empty($trackingNumber)) {
                        //echo $is_track_code ? 'No information found' : 'Invalid tracking number';
                    ?>
                        <h3 class="text-black fs-4">That tracking number is not associated with a shipment. If your tracking information does not begin with ‘RXO’, please try again</h3>

                        <form class="align-items-center" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
                            <div class="w-100">
                                <div class="col-12 p-2">
                                    <input type="text" maxlength="255" placeholder="Order Number" name="orderNumber" id="search-input" class="form-control" required />
                                </div>
                                <div class="col-12 p-2">
                                    <input type="text" maxlength="255" placeholder="Zipcode" name="zipcode" id="search-input" class="form-control" required />
                                </div>
                                <div class="col-12 p-2">
                                    <button class="btn btn-primary" type="submit" aria-label="search">Track a shipment</button>
                                </div>
                            </div>
                        </form>
                    <?php
                    } else {
                        echo '<h3>Enter your Order number and Zipcode</h3>';
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>
<style>
    @media (min-width: 1300px) {
        .article-width {
            max-width: 1100px !important;
        }
    }



    .progress-vertical .steps.active::before {
        background-color: black !important;
    }
</style>
<?php get_footer(); ?>