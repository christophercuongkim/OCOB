<?php

/**
 * A field that will contain a numeric value
 */
class HTMLFloatField extends HTMLTextField {
	function getSize() {
		return isset( $this->mParams['size'] ) ? $this->mParams['size'] : 20;
	}

	function validate( $value, $alldata ) {
		$p = parent::validate( $value, $alldata );

		if ( $p !== true ) {
			return $p;
		}

		$value = trim( $value );

		# http://dev.w3.org/html5/spec/common-microsyntaxes.html#real-numbers
		# with the addition that a leading '+' sign is ok.
		if ( !preg_match( '/^((\+|\-)?\d+(\.\d+)?(E(\+|\-)?\d+)?)?$/i', $value ) ) {
			return $this->msg( 'htmlform-float-invalid' )->parseAsBlock();
		}

		# The "int" part of these message names is rather confusing.
		# They make equal sense for all numbers.
		if ( isset( $this->mParams['min'] ) ) {
			$min = $this->mParams['min'];

			if ( $min > $value ) {
				return $this->msg( 'htmlform-int-toolow', $min )->parseAsBlock();
			}
		}

		if ( isset( $this->mParams['max'] ) ) {
			$max = $this->mParams['max'];

			if ( $max < $value ) {
				return $this->msg( 'htmlform-int-toohigh', $max )->parseAsBlock();
			}
		}

		return true;
	}
}
