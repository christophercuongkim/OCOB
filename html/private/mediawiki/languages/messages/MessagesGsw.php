<?php
/** Swiss German (Alemannisch)
 *
 * See MessagesQqq.php for message documentation incl. usage of parameters
 * To improve a translation please visit http://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 */

$fallback = 'de';

$specialPageAliases = array(
	'Allmessages'               => array( 'Alli_Nochrichte' ),
	'Allpages'                  => array( 'Alli_Syte' ),
	'Ancientpages'              => array( 'Veralteti_Syte' ),
	'Badtitle'                  => array( 'Nit-gültige_Sytename' ),
	'Blankpage'                 => array( 'Läärsyte' ),
	'Block'                     => array( 'Sperre' ),
	'Booksources'               => array( 'ISBN-Suech' ),
	'BrokenRedirects'           => array( 'Kaputti_Wyterlaitige' ),
	'Categories'                => array( 'Kategorie' ),
	'ChangeEmail'               => array( 'E-Mai-Adräss_ändere' ),
	'ChangePassword'            => array( 'Passwort_ändre' ),
	'ComparePages'              => array( 'Syte_verglyyche' ),
	'Confirmemail'              => array( 'E-Mail_bstetige' ),
	'Contributions'             => array( 'Byytreeg' ),
	'CreateAccount'             => array( 'Benutzerchonto_aaleege' ),
	'Deadendpages'              => array( 'Sackgassesyte' ),
	'DeletedContributions'      => array( 'Gleschti_Byytreeg' ),
	'DoubleRedirects'           => array( 'Doppleti_Wyterlaitige' ),
	'EditWatchlist'             => array( 'Bearbeitigslischt_bearbeite' ),
	'Emailuser'                 => array( 'E-Mail' ),
	'ExpandTemplates'           => array( 'Vorlage_expandiere' ),
	'Export'                    => array( 'Exportiere' ),
	'Fewestrevisions'           => array( 'Syte_wo_am_wenigschte_bearbeitet_sin' ),
	'FileDuplicateSearch'       => array( 'Datei-Duplikat-Suech' ),
	'Filepath'                  => array( 'Dateipfad' ),
	'Import'                    => array( 'Importiere' ),
	'Invalidateemail'           => array( 'E-Mail_nit_bstetige' ),
	'BlockList'                 => array( 'Gsperrti_IP' ),
	'LinkSearch'                => array( 'Suech_no_Links' ),
	'Listadmins'                => array( 'Ammanne' ),
	'Listbots'                  => array( 'Bötli' ),
	'Listfiles'                 => array( 'Dateie' ),
	'Listgrouprights'           => array( 'Grupperächt' ),
	'Listredirects'             => array( 'Wyterleitige' ),
	'Listusers'                 => array( 'Benutzerlischte' ),
	'Lockdb'                    => array( 'Datebank_sperre' ),
	'Log'                       => array( 'Logbuech' ),
	'Lonelypages'               => array( 'Verwaisti_Syte' ),
	'Longpages'                 => array( 'Langi_Syte' ),
	'MergeHistory'              => array( 'Versionsgschichte_zämefiere' ),
	'MIMEsearch'                => array( 'MIME-Suech' ),
	'Mostcategories'            => array( 'Syte_wo_am_meischte_kategorisiert_sin' ),
	'Mostimages'                => array( 'Dateie_wo_am_meischte_brucht_wäre' ),
	'Mostlinked'                => array( 'Syte_wo_am_meischte_druff_verlinkt_isch' ),
	'Mostlinkedcategories'      => array( 'Kategorie_wo_am_meischte_brucht_wäre' ),
	'Mostlinkedtemplates'       => array( 'Vorlage_wo_am_meischte_brucht_wäre' ),
	'Mostrevisions'             => array( 'Syte_wo_am_meischte_bearbeitet_sin' ),
	'Movepage'                  => array( 'Verschiebe' ),
	'Mycontributions'           => array( 'Myyni_Byytreeg' ),
	'Mypage'                    => array( 'Myyni_Benutzersyte' ),
	'Mytalk'                    => array( 'Myyni_Diskussionssyte' ),
	'Myuploads'                 => array( 'Dateie_wonni_uffeglade_han' ),
	'Newimages'                 => array( 'Neji_Dateie' ),
	'Newpages'                  => array( 'Neji_Syte' ),
	'PasswordReset'             => array( 'Passwort_zruggsetze' ),
	'PermanentLink'             => array( 'Permalink' ),
	'Popularpages'              => array( 'Beliebteschti_Syte' ),
	'Preferences'               => array( 'Ystellige' ),
	'Prefixindex'               => array( 'Vorsilbeverzeichnis' ),
	'Protectedpages'            => array( 'Gschitzti_Syte' ),
	'Protectedtitles'           => array( 'Gsperrti_Titel' ),
	'Randompage'                => array( 'Zuefelligi_Syte' ),
	'RandomInCategory'          => array( 'Zuefelligi_Kategori' ),
	'Randomredirect'            => array( 'Zuefelligi_Wyterleitig' ),
	'Recentchanges'             => array( 'Letschti_Änderige' ),
	'Recentchangeslinked'       => array( 'Änderige_an_verlinkte_Syte' ),
	'Revisiondelete'            => array( 'Versionsleschig' ),
	'Search'                    => array( 'Suech' ),
	'Shortpages'                => array( 'Churzi_Syte' ),
	'Specialpages'              => array( 'Spezialsyte' ),
	'Statistics'                => array( 'Statischtik' ),
	'Tags'                      => array( 'Markierige' ),
	'Unblock'                   => array( 'Freigee' ),
	'Uncategorizedcategories'   => array( 'Kategorie_wo_nit_kategorisiert_sin' ),
	'Uncategorizedimages'       => array( 'Dateie_wo_nit_kategorisiert_sin' ),
	'Uncategorizedpages'        => array( 'Syte_wo_nit_kategorisiert_sin' ),
	'Uncategorizedtemplates'    => array( 'Vorlage_wo_nit_kategorisiert_sin' ),
	'Undelete'                  => array( 'Widerhärstelle' ),
	'Unlockdb'                  => array( 'Sperrig_vu_dr_Datebank_ufhebe' ),
	'Unusedcategories'          => array( 'Kategorie_wo_nit_brucht_wäre' ),
	'Unusedimages'              => array( 'Dateie_wo_nit_brucht_wäre' ),
	'Unusedtemplates'           => array( 'Vorlage_wo_nit_brucht_wäre' ),
	'Unwatchedpages'            => array( 'Syte_wu_nit_beobachtet_wäre' ),
	'Upload'                    => array( 'Uffelade' ),
	'Userlogin'                 => array( 'Amälde' ),
	'Userlogout'                => array( 'Abmälde' ),
	'Userrights'                => array( 'Benutzerrächt' ),
	'Wantedcategories'          => array( 'Kategorie_wo_gwinscht_sin' ),
	'Wantedfiles'               => array( 'Dateie_wo_fähle' ),
	'Wantedpages'               => array( 'Syte_wo_gwinscht_sin' ),
	'Wantedtemplates'           => array( 'Vorlage_wo_fähle' ),
	'Watchlist'                 => array( 'Beobachtigslischte' ),
	'Whatlinkshere'             => array( 'Was_verwyyst_do_druff?' ),
	'Withoutinterwiki'          => array( 'Ohni_Interwiki' ),
);

$magicWords = array(
	'displaytitle'              => array( '1', 'SYTETITEL', 'SEITENTITEL', 'DISPLAYTITLE' ),
);

$linkTrail = '/^([äöüßa-z]+)(.*)$/sDu';

