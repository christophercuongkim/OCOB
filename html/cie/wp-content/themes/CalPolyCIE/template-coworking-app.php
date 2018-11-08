<?php
/**
 * Template Name: Coworking Application
 *
 * @package WordPress
 * @subpackage calpoly-cei
 * @since Cal Poly CEI 1.0
 */
get_header(); ?>

<div class="binding subpage">

	<header>

		<div class="section-label">SLO Hothouse</div>

		<h1><?php echo get_the_title($post->ID); ?></h1>

	</header>

	<div id="coworking-form-wrapper">

		<p style="display:none">We are in the process of updating our coworking application.  If you are interested in applying, please contact Marilyn Murray at mashurst@calpoly.edu.  Thank you!</p>
		
		
		<p >Please complete this form, and expect a response from SLO HotHouse staff within a week. If you do not receive a response, please call our office at 805-756-5171.</p>

		<p>*Required</p>

		<form method="post" action="https://formspree.io/ocob-online@calpoly.edu" id="coworking-form" data-parsley-validate="">
			<input type="hidden" name="_next" value="http://cie.calpoly.edu/application/submission"/>
			<input type="hidden" name="_cc" value="fgonza02@calpoly.edu" />
			<input type="hidden" name="_cc" value="frankg.slo@gmail.com" />
			<input type="hidden" name="_cc" value="nrelliot@calpoly.edu" />
			<input type="hidden" name="_cc" value="clconti@calpoly.edu" />

			<label for="name">Name*</label>
			<input type="text" name="Name" placeholder="Your answer" required="">

			<label for="email">Email*</label>
			<input type="text" name="Email" placeholder="Your answer" required="">

			<label for="phone">Phone number*</label>
			<input type="text" name="Phone" placeholder="Your answer" required="">

			<label for="options">Which of the following options are you interested in? *</label>
			<div id="options-errors"></div>
			<ul class="checklist">
				<li><input type="checkbox" name="InterestedOption" id="option1" value="Open seating co-working space $200/month" required="" data-parsley-errors-container="#options-errors" /><label for="option1"><span></span>Open seating co-working space $200/month</label></li>
				<li><input type="checkbox" name="InterestedOption" id="option3" value="Reserved seating co-working  space $275/month" /><label for="option3"><span></span>Reserved seating co-working space $275/month (You may keep you desk materials, monitor, laptop, etc. here)
				</label></li>
				<li><input type="checkbox" name="InterestedOption" id="option5" value="Small personal office $900/month" /><label for="option5"><span></span>Small personal office $900/month</label></li>
				<li><input type="checkbox" name="InterestedOption" id="option6" value="Medium personal office $1500/month" /><label for="option6"><span></span>Medium personal office $1500/month</label></li>
				<li><input type="checkbox" name="InterestedOption" id="option7" value="Large personal office $2000/month" /><label for="option7"><span></span>Large personal office $2000/month</label></li>
				<li><input type="checkbox" name="InterestedOption" id="option8" value="Personal locker (to store any belongings): $15/month" /><label for="option8"><span></span>Personal locker (to store any belongings): $15/month</label></li>
				<li><input type="checkbox" name="InterestedOption" id="option9" value="Day Pass - Coworking: $25/day - No access to conference rooms" /><label for="option9"><span></span>Day Pass - Coworking: $25/day - No access to conference rooms</label></li>
				<li><input type="checkbox" name="InterestedOption" id="option10" value="Day Pass - Conference Room: $40/hour - 3 hour maximum (longer usage with pre-approval)" /><label for="option10"><span></span>Day Pass - Conference Room: $40/hour - 3 hour maximum (longer usage with pre-approval)</label></li>
				<li><input type="checkbox" name="InterestedOption" id="option11" value="Event Space: $400/4 hours + cleaning fee" /><label for="option11"><span></span>Event Space: $400/4 hours + cleaning fee</label></li>
				<li><input type="checkbox" name="InterestedOption" id="option12" value="Event Space: $800/8 hours + cleaning fee" /><label for="option12"><span></span>Event Space: $800/8 hours + cleaning fee</label></li>
			</ul>
			<p style="margin-top:-40px;">*Nonprofit rates available.</p>

			<label for="comments">Comments</label>
			<input type="text" name="Comments" placeholder="Your answer">

			<label for="website">Your Website and/or LinkedIn Profile (required) *</label>
			<input type="text" name="Website" placeholder="Your answer" required="">

			<label for="college">Are you a student at Cal Poly State University or Cuesta College? If you are a student, please list where and for how long? *</label>
			<div id="college-errors"></div>
			<ul class="checklist">
				<li><input type="checkbox" name="College" id="college1" value="Cal Poly" required="" data-parsley-errors-container="#college-errors" /><label for="college1"><span></span>Cal Poly</label></li>
				<li><input type="checkbox" name="College" id="college2" value="Cuesta College" /><label for="college2"><span></span>Cuesta College</label></li>
				<li><input type="checkbox" name="College" id="college3" value="None" /><label for="college3"><span></span>None</label></li>
				<li><input type="checkbox" name="College" id="college4" class="other-college" value="Other" /><label for="college4"><span></span>Other:</label> <input type="text" name="College" placeholder="Your Answer"></li>
			</ul>

			<label for="individual">Are you working individually or as part of a team? If you are part of a team, will they be coworking too? *</label>
			<div id="individual-errors"></div>
			<ul class="checklist">
				<li><input type="checkbox" name="IndividualOrTeam" id="individual1" value="Individual" required="" data-parsley-errors-container="#individual-errors" /><label for="individual1"><span></span>Individual</label></li>
				<li><input type="checkbox" name="IndividualOrTeam" id="individual2" value="Team" /><label for="individual2"><span></span>Team</label></li>
			</ul>

			<label for="business_description">Briefly describe your business. *</label>
			<input type="text" name="BusinessDescription" placeholder="Your answer">

			<label for="business_stage">What stage is your business in? (You may choose more than one). *</label>
			<div id="business-errors"></div>
			<ul class="checklist">
				<li><input type="checkbox" name="BusinessStage" id="business_stage1" value="Idea" data-parsley-multiple="BusinessStage" required="" data-parsley-errors-container="#business-errors" /><label for="business_stage1"><span></span>Idea</label></li>
				<li><input type="checkbox" name="BusinessStage" id="business_stage2" value="Pre-launch" /><label for="business_stage2" data-parsley-multiple="BusinessStage" ><span></span>Pre-launch</label></li>
				<li><input type="checkbox" name="BusinessStage" id="business_stage3" value="Launch" /><label for="business_stage3" data-parsley-multiple="BusinessStage" ><span></span>Launch</label></li>
				<li><input type="checkbox" name="BusinessStage" id="business_stage4" value="Development/Expansion" /><label for="business_stage4" data-parsley-multiple="BusinessStage" ><span></span>Development/Expansion</label></li>
				<li><input type="checkbox" name="BusinessStage" id="business_stage5" value="Maturity" /><label for="business_stage5" data-parsley-multiple="BusinessStage" ><span></span>Maturity</label></li>
			</ul>

			<label for="BusinessIP">Does your business own any IP or is in the process of creating IP? *</label>
			<input type="text" name="BusinessIP" placeholder="Your answer" required="">

			<label for="AnticipatedGrowth">What is your anticipated growth overall? In terms of sales volume? In terms of employment? Over what period of time? *</label>
			<input type="text" name="AnticipatedGrowth" placeholder="Your answer" required="">

			<label for="Skills/Talents">What are your primary skills and talents? *</label>
			<input type="text" name="Skills/Talents" placeholder="Your answer" required="">

			<label for="NumberBusinesses">How many business starts have you been directly involved in as a founder or primary employee? *</label>
			<select name="NumberBusinesses" required>
				<option value="">Choose</option>
				<option value="0-1">0-1</option>
				<option value="2-4">2-4</option>
				<option value="5-8">5-8</option>
				<option value="9+">9+</option>
			</select>

			<label for="WorkHabits">Describe your work habits. How many hours per week, what hours of the day, and how many days per week? Music, quiet, talking/phone?*</label>
			<input type="text" name="WorkHabits" placeholder="Your answer" required="">

			<label for="ConferenceUse">Do you plan on utilizing the conference rooms? If so, for what hours of the day, and how many days per week? *</label>
			<input type="text" name="ConferenceUse" placeholder="Your answer" required="">

			<label for="DurationOfAnticipatedUse">How long do you plan on using the coworking space? *</label>
			<input type="text" name="DurationOfAnticipatedUse" placeholder="Your answer" required="">
						<label for="StartTime">Anticipated Start Date (MM/DD/YYYY) *</label>
			<input type="text" name="StartTime" placeholder="Your answer" required="">

			<label for="Appeals">What appeals to you about coworking at the SLO HotHouse? *</label>
			<input type="text" name="Appeals" placeholder="Your answer" required="">

			<label for="HowWouldYouContribute">How would you contribute to the coworking environment? *</label>
			<input type="text" name="HowWouldYouContribute" placeholder="Your answer" required="">

			<label for="DoYouKnowAnyoneInvolved">Who do you know that is already involved in the entrepreneurial community here? *</label>
			<input type="text" name="DoYouKnowAnyoneInvolved" placeholder="Your answer" required="">
			<label for="refs">Do you have any references?</label><label for="ReferenceName"><span></span>Reference Name:</label> <input type="text" name="ReferenceName" placeholder="Your Answer"></li>
<label for="ReferenceEmail"><span></span>Reference Email:</label> <input type="text" name="ReferenceEmail" placeholder="Your Answer"></li>

			<label for="Concerns">Do you have any concerns about a shared use work environment? *</label>
			<input type="text" name="Concerns" placeholder="Your answer" required="">

			<label for="Requirements">Do you have any special requirements? *</label>
			<input type="text" name="Requirements" placeholder="Your answer" required="">

			<label for="OtherInfo">What else should we know about you? *</label>
			<input type="text" name="OtherInfo" placeholder="Your answer" required="">

			<input type="submit" value="Submit">

		</form>

	</div>

</div>



<?php get_footer(); ?>
