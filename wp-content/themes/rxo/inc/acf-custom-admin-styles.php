<?php function rxo_acf_custom_styles_admin_head() { ?>

    <style type="text/css">

        .cb-left-label,
        .cb-right-label {
            border-top: 2px solid #333 !important;
            margin-top: 1.5rem !important;
            padding-top: 1.5rem !important;
            padding-left: 0 !important;
            margin: 1.5rem !important;
        }

        .cb-left-label label,
        .cb-right-label label {
            color: #000 !important;
            cursor: default !important;
            font-size: 2rem !important;
            line-height: 2.8rem !important;
            font-weight: 600 !important;
            font-family: inherit !important;
        }

        .cb-left-label .acf-input,
        .cb-right-label .acf-input {
            display: none !important;
        }

    </style>

<?php }

add_action('acf/input/admin_head', 'rxo_acf_custom_styles_admin_head');