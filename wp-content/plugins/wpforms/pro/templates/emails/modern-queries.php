<?php
/**
 * Modern media queries style template.
 *
 * This template can be overridden by copying it to yourtheme/wpforms/emails/modern-queries.php.
 *
 * Note: To override the existing styles of the template in this file, ensure that all
 * overriding styles are declared as !important to take precedence over the default styles.
 *
 * @since 1.8.5
 * @since 1.8.6 Added dark mode variables.
 *
 * @var string $email_background_color_dark  Background color for the email.
 * @var string $email_body_color_dark        Background color for the email content body.
 * @var string $email_text_color_dark        Text color for the email content.
 * @var string $email_links_color_dark       Color for links in the email content.
 * @var string $email_typography_dark        Preferred typography font-family for email content.
 * @var string $header_image_max_width_dark  Maximum width for the header image.
 * @var string $header_image_max_height_dark Maximum height for the header image.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require WPFORMS_PLUGIN_DIR . 'assets/pro/css/emails/partials/modern_media_queries.css';

?>

@media (prefers-color-scheme: dark) {
	body, .body {
		background-color: <?php echo sanitize_hex_color( $email_background_color_dark ); ?> !important;
	}

	.wrapper-inner {
		background-color: <?php echo sanitize_hex_color( $email_body_color_dark ); ?> !important;
	}

	body, table.body, h1, h2, h3, h4, h5, h6, p, td, th, a {
		color: <?php echo sanitize_hex_color( $email_text_color_dark ); ?> !important;
		font-family: <?php echo esc_attr( $email_typography_dark ); ?> !important;
	}

	a, a:visited,
	a:hover, a:active,
	h1 a, h1 a:visited,
	h2 a, h2 a:visited,
	h3 a, h3 a:visited,
	h4 a, h4 a:visited,
	h5 a, h5 a:visited,
	h6 a, h6 a:visited {
		color: <?php echo sanitize_hex_color( $email_links_color_dark ); ?> !important;
	}

	a.button-link {
		background-color: <?php echo sanitize_hex_color( $email_body_color_dark ); ?> !important;
		border: 1px solid <?php echo sanitize_hex_color( $email_links_color_dark ); ?> !important;
		color: <?php echo sanitize_hex_color( $email_links_color_dark ); ?> !important;
	}

	.footer, .footer a {
		color: <?php echo sanitize_hex_color( wpforms_generate_contrasting_color( $email_text_color_dark, 50, 45 ) ); ?> !important;
	}

	<?php if ( ! empty( $header_image_max_width_dark ) && ! empty( $header_image_max_height_dark ) ) : ?>
	.dark-mode .header-image {
		max-width: <?php echo esc_attr( $header_image_max_width_dark ); ?>px !important;
	}
	.dark-mode .header-image img {
		max-height: <?php echo esc_attr( $header_image_max_height_dark ); ?>px !important;
	}
	<?php endif; ?>
}
