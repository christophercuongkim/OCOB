<?php
/**
 * Implements Special:Unlockdb
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup SpecialPage
 */

/**
 * Implements Special:Unlockdb
 *
 * @ingroup SpecialPage
 */
class SpecialUnlockdb extends FormSpecialPage {

	public function __construct() {
		parent::__construct( 'Unlockdb', 'siteadmin' );
	}

	public function requiresWrite() {
		return false;
	}

	public function checkExecutePermissions( User $user ) {
		global $wgReadOnlyFile;

		parent::checkExecutePermissions( $user );
		# If the lock file isn't writable, we can do sweet bugger all
		if ( !file_exists( $wgReadOnlyFile ) ) {
			throw new ErrorPageError( 'lockdb', 'databasenotlocked' );
		}
	}

	protected function getFormFields() {
		return array(
			'Confirm' => array(
				'type' => 'toggle',
				'label-message' => 'unlockconfirm',
			),
		);
	}

	protected function alterForm( HTMLForm $form ) {
		$form->setWrapperLegend( false );
		$form->setHeaderText( $this->msg( 'unlockdbtext' )->parseAsBlock() );
		$form->setSubmitTextMsg( 'unlockbtn' );
	}

	public function onSubmit( array $data ) {
		global $wgReadOnlyFile;

		if ( !$data['Confirm'] ) {
			return Status::newFatal( 'locknoconfirm' );
		}

		wfSuppressWarnings();
		$res = unlink( $wgReadOnlyFile );
		wfRestoreWarnings();

		if ( $res ) {
			return Status::newGood();
		} else {
			return Status::newFatal( 'filedeleteerror', $wgReadOnlyFile );
		}
	}

	public function onSuccess() {
		$out = $this->getOutput();
		$out->addSubtitle( $this->msg( 'unlockdbsuccesssub' ) );
		$out->addWikiMsg( 'unlockdbsuccesstext' );
	}

	protected function getGroupName() {
		return 'wiki';
	}
}
