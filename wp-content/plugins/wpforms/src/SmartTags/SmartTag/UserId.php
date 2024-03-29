<?php

namespace WPForms\SmartTags\SmartTag;

/**
 * Class UserId.
 *
 * @since 1.6.7
 */
class UserId extends SmartTag {

	/**
	 * Get smart tag value.
	 *
	 * @since 1.6.7
	 *
	 * @param array  $form_data Form data.
	 * @param array  $fields    List of fields.
	 * @param string $entry_id  Entry ID.
	 *
	 * @return int|string
	 */
	public function get_value( $form_data, $fields = [], $entry_id = '' ) {

		$user = $this->get_user( $entry_id );

		return absint( $user->ID ) ?? '';
	}
}
