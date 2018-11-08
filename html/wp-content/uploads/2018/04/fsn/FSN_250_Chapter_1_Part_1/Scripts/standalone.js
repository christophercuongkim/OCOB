
var SilverlightObjectId = 'PlayerXaml';

function GetStandAloneApi() {
	var silverlightObject = document.getElementById(SilverlightObjectId);
	return silverlightObject.content.StandAloneScriptApi;
}

function LoadMyManifest() {
	var manifestXml = unescape(StandAloneManifest);
	GetStandAloneApi().LoadManifest(manifestXml);
}

function LoadMyPlayerOptions() {
	var optionsXml = unescape(StandAlonePlayerOptions);
	GetStandAloneApi().LoadOptions(optionsXml);
}

function SetPageTitle(title) {
	try {
		document.title = title;
	}
	catch (err) {
		// Shed a tear and move on.
	}
}

function onError(sender, e) {
	var error = e.get_error();
	var silverlightObject = document.getElementById(SilverlightObjectId);
	silverlightObject.content.PlayerScriptApi.ReportError(error.errorType, error.errorMessage, error.errorCode);
}

function createPlayerObjectIn(containerId) {
	Silverlight.createObjectEx({
		source: 'Layout.xap',
		parentElement: document.getElementById(containerId),
		id: SilverlightObjectId,
		properties: {
			width: '100%',
			height: '100%',
			inplaceInstallPrompt: true,
			version: '2.0.31005.0'
		},
		initParams: 'autoplay=True,showCover=False,standAlone=True,fileServer=stand-alone,identityTicket=stand-alone'
	});
}

function focusPlugInDelayed() {
	setTimeout('focusPlugIn()', 500);
}

function focusPlugIn() {
	// Don't mess with focus if our page is within a frame.
	if (window != window.top) {
		return;
	}

	// Attempt to give the Silverlight object focus.
	var silverlightObject = document.getElementById(SilverlightObjectId);
	if (silverlightObject) {
		silverlightObject.focus();
	}
}
