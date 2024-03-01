<?php

/**
 * Interview Questions Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// create id attribute for specific styling
$uid = 'spinco-acf-container-' . $block['id'];

if (!empty($block['anchor'])) {
    $uid = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'spinco-block ' . str_replace('acf/spinco-acf-', '', $block['name']);

if (!empty($block['className'])) {
    $className .= sprintf(' %s', $block['className']);
}

if (!empty($block['align'])) {
    $className .= sprintf(' align%s', $block['align']);
}
?>

<div id="<?php echo esc_attr($uid); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="row">
        <div id="block1" class="col-12 col-lg-6">
            <form action="#" id="contactformX" method="post">
                <p>
                    It's time to prepare for your interview. This Interview Guide tool will assist you in determining the questions to use during your interview. If your business unit/department has pre-approved guides, please continue to use the existing guides. You may always reach out to your recruiting partner or HR partner if you have questions regarding interview guides.
                </p>
                <div class="row gx-5">
                    <div class="col-12 col-lg-6 ">
                        <label class="wpforms-field-label">Job location <span class="text-red">*</span></label>
                        <div class="pb-3">
                            <input type="text" name="job_location" maxlength="128" id="id_job_location" class="form-control" placeholder="Job Location" required />
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 ">
                        <label class="wpforms-field-label">Business unit <span class="text-red">*</span></label>
                        <div class="pb-3">
                            <select data-trigger name="business_unit" class="js-choice" required>
                                <option value="Brokerage">Brokerage</option>
                                <option value="Corporate">Corporate</option>
                                <option value="Freight Forwarding">Freight Forwarding</option>
                                <option value="Last Mile">Last Mile</option>
                                <option value="Managed Transportation">Managed Transportation</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 ">
                        <label class="wpforms-field-label">Job title <span class="text-red">*</span></label>
                        <div class="pb-3">
                            <input type="text" name="job_title" maxlength="128" id="id_job_title" class="form-control" placeholder="Job title" required />
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 ">
                        <label class="wpforms-field-label">Candidate type <span class="text-red">*</span></label>
                        <div class="pb-3">
                            <select data-trigger name="candidate_type" class="js-choice" id="id_candidate_type" required>
                                <option value="Hourly">Hourly</option>
                                <option value="Professional IC">Professional IC</option>
                                <option value="Leader">Leader</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 ">
                        <label class="wpforms-field-label">Job function <span class="text-red">*</span></label>
                        <div class="pb-3">
                            <select data-trigger name="job_function" class="js-choice" id="id_job_function" required>
                                <option value="Administrative">Administrative</option>
                                <option value="Communications">Communications</option>
                                <option value="Corporate Strategy">Corporate Strategy</option>
                                <option value="Customer Support">Customer Support</option>
                                <option value="Engineering">Engineering</option>
                                <option value="Executive">Executive</option>
                                <option value="Finance &amp; Accounting">Finance &amp; Accounting</option>
                                <option value="Human Resources">Human Resources</option>
                                <option value="IT">IT</option>
                                <option value="Legal">Legal</option>
                                <option value="Operations">Operations</option>
                                <option value="Procurement">Procurement</option>
                                <option value="Sales">Sales</option>
                                <option value="Warehouse Operations">Warehouse Operations</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 ">
                        <label class="wpforms-field-label">Panel interview <span class="text-red">*</span></label>
                        <div class="pb-3">
                            <select data-trigger name="panel_interview" class="js-choice" id="id_panel_interview" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 py-3">
                        <input id="formbtn" onclick="formSubmit(this)" type="button" value="Submit" class="btn btn-primary rounded-pill px-5 py-2 FormsSig-form-bttn">
                    </div>
                </div>
            </form>
        </div>
        <div id="block2" class="col-12 col-lg-6 d-none">
            <h4 class="mb-2">Capabilities:</h4>
            <p class="m-0 pb-4">Below is a list of 23 capabilities. A capability should reflect the skills, knowledge and behaviors a person needs to possess to be successful in the role.</p>
            <p class="m-0 pb-4">Please review all of the capabilities and choose 4 – 6 that best align with the role and job description. You can review the definition of each capability after you click on the plus sign (+).</p>
            <p class="m-0 pb-4">Select 1 -2 questions per capability. Each leading question will also include some probing questions to assist you in getting a complete answer from the candidates.</p>
            <ul class="InterviewQuestionnaire-capabilities">
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Accountability" data-capability-description="Takes ownership when completing work tasks and making decisions to achieve project and/or organizational objectives; accepts responsibility for mistakes/errors; takes steps to correct mistakes/errors and prevent them from happening again." data-capability-id="1" type="button">
                        <span>Accountability</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="1" data-primary-question-id="1" type="button">
                                <span>Describe a situation in which you identified a problem and took action to correct it because others were unwilling to do so.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>Why were others unwilling to take action?</li>
                                <li>What made you decide to take action?</li>
                                <li>What specific actions did you take?</li>
                                <li>How did others react to your actions?</li>
                                <li>What were the results?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="1" data-primary-question-id="2" type="button">
                                <span>Tell me about a time you did not meet the expectations of your supervisor or a client. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you know you didn&#39;t meet your supervisor&#39;s or client&#39;s expectations?</li>
                                <li>How could you have better met expectations?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="1" data-primary-question-id="3" type="button">
                                <span>At times, we may not be satisfied with our own performance. Tell me about an instance when you weren't pleased with your performance.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What did you do about it?</li>
                                <li>Did your performance improve? How do you know?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="1" data-primary-question-id="4" type="button">
                                <span>Give me an example of a team project where you needed to take charge of the project to get it back on track. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the project?</li>
                                <li>What was your role in the project?</li>
                                <li>Why did you take charge?</li>
                                <li>How did you hold yourself and the rest of the team accountable?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="1" data-primary-question-id="5" type="button">
                                <span>Describe how you have created and sustained an environment where direct reports are held accountable for achieving desired results. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>How did you define and measure accountability?</li>
                                <li>How did you communicate your expectations for high performance?</li>
                                <li>What did you do that succeeded? What didn&#39;t?</li>
                                <li>How did the organization&#39;s business goals factor into this effort?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="1" data-primary-question-id="6" type="button">
                                <span>Describe the steps you have taken to ensure Associates are achieving results. Please provide specific examples. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>How did you promote accountability?</li>
                                <li>What did you do that succeeded? What didn&#39;t?</li>
                                <li>How did you monitor progress?</li>
                                <li>How have you conveyed a sense of urgency?</li>
                                <li>What was the impact of your efforts?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Business Acumen and Orientation" data-capability-description="Demonstrates knowledge of business metrics (e.g., financial, market, and transportation and logistics industry data) to understand and improve business results; applies one's understanding of business functions, industry trends, and RXO&#39; position to contribute to effective business tactics and strategies." data-capability-id="2" type="button">
                        <span>Business Acumen and Orientation</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="2" data-primary-question-id="7" type="button">
                                <span>Tell me about a time you leveraged your knowledge of the organization to solve a problem for a customer.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the problem?</li>
                                <li>What information did you use?</li>
                                <li>How did you obtain this information?</li>
                                <li>What was the result?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="2" data-primary-question-id="8" type="button">
                                <span>How would your last supervisor rate your knowledge of the business on a scale from one to ten with one having little knowledge and ten being an expert?</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>Why would your supervisor give you that rating?</li>
                                <li>Can you give me an example of when your knowledge of the business impacted your performance?</li>
                                <li>How did your knowledge of the business impact this situation?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="2" data-primary-question-id="9" type="button">
                                <span>Tell me about a time at work when you needed to analyze financial information to identify trends and underlying issues. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>How did you organize the information?</li>
                                <li>What conclusions did you draw?</li>
                                <li>Were your insights used by others?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="2" data-primary-question-id="10" type="button">
                                <span>Tell me about a time when you used _______ (financial, market, economic, industry, or performance) data to identify the strengths and opportunities for improving a business unit, department, or team.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What data or information did you consider? Why?</li>
                                <li>How did you use the data?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="2" data-primary-question-id="11" type="button">
                                <span>At times, you have to balance the needs of the customer with the demand for efficiency in the business. Can you give me an example of when you were faced with this dilemma? What did you do?</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the dilemma?</li>
                                <li>How did you balance customer and organizational needs?</li>
                                <li>What was the outcome?</li>
                                <li>Looking back, is there anything you would have done differently to come to a mutually satisfying outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="2" data-primary-question-id="12" type="button">
                                <span>Describe a time when you analyzed and integrated current and future customer, market, and industry trends to develop strategic initiatives for your functional area, unit, and/or organization.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>Describe the strategic initiatives you developed.</li>
                                <li>How did these align with organizational direction?</li>
                                <li>Who did you involve in this process?</li>
                                <li>How did you translate the strategic initiatives into actionable plans?</li>
                                <li>What steps did you take to implement these plans?</li>
                                <li>What measurements did you to use to determine success?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Communication" data-capability-description="Communicates effectively in writing and orally, sharing information with the appropriate audience at the appropriate time; leverages active listening techniques to ensure understanding of spoken information and seeks to view situations from the perspective of others; shares opinions, facts, and thoughts with clarity, transparency, and honesty; demonstrates comfort with formal and informal means of communication." data-capability-id="3" type="button">
                        <span>Communication</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="3" data-primary-question-id="13" type="button">
                                <span>Tell me about a tough conversation that you had to have with a coworker or customer. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>Why was this a difficult conversation?</li>
                                <li>How did you approach the conversation?</li>
                                <li>How did your coworker/customer respond?</li>
                                <li>Would you have done anything differently? Can you give me an example of when you actually did this?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="3" data-primary-question-id="14" type="button">
                                <span>Tell me about a time you had to express your ideas in a meeting. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the focus of the discussion?</li>
                                <li>How did you convey your message?</li>
                                <li>How did your audience respond?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="3" data-primary-question-id="15" type="button">
                                <span>Tell me about a situation in which you were particularly effective communicating with others. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>Why was your communication in this instance so effective?</li>
                                <li>How did you know your communication was effective?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="3" data-primary-question-id="16" type="button">
                                <span>Describe a situation at work that required you to adjust your communication style to adapt to a person from a different background. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>Who were you communicating with?</li>
                                <li>How did you adapt your style?</li>
                                <li>How did the person respond?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="3" data-primary-question-id="17" type="button">
                                <span>Describe a time you had to communicate a complex and/or technical concept to a non-technical audience.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the concept?</li>
                                <li>What steps did you take to communicate with your audience?</li>
                                <li>How did you determine whether your message was received?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="3" data-primary-question-id="18" type="button">
                                <span>Describe a time when you needed to be careful discussing sensitive information with a client or internal partner. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you approach the conversation?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Compassion" data-capability-description="Treats others with respect and dignity; shows awareness of others&#39; needs; responds to others&#39; feelings in a perceptive and sensitive way; expresses empathy and compassion when dealing with the needs and problems of others." data-capability-id="4" type="button">
                        <span>Compassion</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="4" data-primary-question-id="19" type="button">
                                <span>Describe a situation where you had to accommodate some urgent requests from someone you have not interacted with before.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What were the requests you had to accommodate?</li>
                                <li>How did you respond to the person&#39;s requests?</li>
                                <li>What challenges did you face?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="4" data-primary-question-id="20" type="button">
                                <span>Describe a time when you had to say &quot;no&quot; to a customer or a coworker while considering their feelings.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you communicate with the customer or coworker?</li>
                                <li>How did the customer or coworker react?</li>
                                <li>What, if anything, would you do differently next time?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="4" data-primary-question-id="21" type="button">
                                <span>Describe a situation where you adjusted a work plan to accommodate other team members&#39; schedules, preferences, or skill levels. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the work plan about?</li>
                                <li>What kind of adjustments did you make?</li>
                                <li>How did other team members react to your adjusted work plan?</li>
                                <li>What, if anything, would you do differently next time?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="4" data-primary-question-id="22" type="button">
                                <span>Describe a situation where you worked with people with different backgrounds to complete a project together.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>Did you do anything different to accommodate others&#39; different values or backgrounds? If so, what did you do?</li>
                                <li>What challenges did you encounter?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="4" data-primary-question-id="23" type="button">
                                <span>Describe a situation where your direct report sought support from you on a challenge he/she encountered at work.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What challenge did your direct report encounter?</li>
                                <li>How did you respond to the direct report&#39;s needs for support?</li>
                                <li>What did you do to support the direct report?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="4" data-primary-question-id="24" type="button">
                                <span>Describe a time when you had to give feedback to a direct report who did not meet his/her performance goals.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>Why did the direct report fail to meet his/her performance goals?</li>
                                <li>What feedback did you give to the direct report?</li>
                                <li>How did the direct report respond to your feedback?</li>
                                <li>What was the outcome of the conversation?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Creativity" data-capability-description="Keeps an open mind to new ideas and opportunities; contributes creative solutions to challenge the status quo, think expansively, and leverage diverse resources; adapts to changes quickly and gains commitment from others on new processes or strategies." data-capability-id="5" type="button">
                        <span>Creativity</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="5" data-primary-question-id="25" type="button">
                                <span>Describe a time when you had to use a different approach to complete an assignment than you have used before. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the assignment?</li>
                                <li>What steps did you take to come up with the different approach?</li>
                                <li>How did others react to your new approach?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="5" data-primary-question-id="26" type="button">
                                <span>Describe a time when you were asked to improve an existing way to solve a problem at work. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the problem you had to solve?</li>
                                <li>How did you improve the original way to solve the problem?</li>
                                <li>What challenge did you face?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="5" data-primary-question-id="27" type="button">
                                <span>Tell me about a time your professional knowledge enabled you to develop and implement an innovation.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What was your innovation?</li>
                                <li>How did your knowledge of engineering standards enable you to develop the innovation?</li>
                                <li>What was the result of the innovation?</li>
                                <li>What, if anything, would you do differently?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="5" data-primary-question-id="28" type="button">
                                <span>Describe a time when you recommended new or innovative solutions to improve your company&#39;s position in the marketplace.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>Why were new or innovative solutions required in that situation?</li>
                                <li>What did you do that succeeded? What didn't?</li>
                                <li>How did you gain buy-in for your recommendations?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="5" data-primary-question-id="29" type="button">
                                <span>Describe how you have created and sustained an environment that results in innovative thinking.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What strategies did you use?</li>
                                <li>What succeeded? Why?</li>
                                <li>What did not succeed? Why?</li>
                                <li>How did you measure the impact of your efforts?</li>
                                <li>How did you reinforce innovative behavior?</li>
                                <li>What barriers did you encounter? How did you overcome them?</li>
                                <li>What were the results?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="5" data-primary-question-id="30" type="button">
                                <span>Describe the programs or projects you have initiated that enhanced organizational effectiveness using new technology.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the new technology?</li>
                                <li>What issues did you consider when developing the strategies?</li>
                                <li>What challenges did you face and how did you overcome them?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Customer Service" data-capability-description="Develops and maintains professional, positive working relationships with internal and external customers; stays approachable and takes time to address customers&#39; needs, as well as their concerns and complaints; remains calm and professional when dealing with difficult people." data-capability-id="6" type="button">
                        <span>Customer Service</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="6" data-primary-question-id="31" type="button">
                                <span>What steps have you taken to increase your understanding of customers&#39; interests, needs, preferences, and expectations in order to improve customer service? </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What tools or techniques did you utilize to gather and/or analyze information?</li>
                                <li>How did you use this information to improve customer service?</li>
                                <li>What did you do that succeeded? What didn&#39;t?</li>
                                <li>What were the results of your efforts?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="6" data-primary-question-id="32" type="button">
                                <span>Describe a time when you effectively resolved a customer&#39;s request. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation? What resources, policies, or information did you use to help the person?</li>
                                <li>What information did you gather to assist in resolving the request?</li>
                                <li>Who did you involve? What was the person&#39;s reaction?</li>
                                <li>What, if anything, would you do differently next time?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="6" data-primary-question-id="33" type="button">
                                <span>Describe a time when you identified and addressed an issue that impacted your ability to deliver effective customer service and support. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the issue? How did you identify the issue?</li>
                                <li>What information did you gather? What actions did you take?</li>
                                <li>What challenges did you face and how did you overcome them?</li>
                                <li>What was the outcome of your efforts?</li>
                                <li>What, if anything, would you have done differently?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="6" data-primary-question-id="34" type="button">
                                <span>Describe the a relationships you have built with a key customer. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What steps did you take?</li>
                                <li>How did you leverage these relationships to improve customer service?</li>
                                <li>Have you ever encountered any difficulties during the course of this relationship?</li>
                                <li>How did you resolve the issues?</li>
                                <li>What was the impact of your efforts?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="6" data-primary-question-id="35" type="button">
                                <span>Describe a specific example of how you have grown your business through better customer service. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What steps did you take?</li>
                                <li>How did you identify the specific areas needing growth?</li>
                                <li>What information did you use?</li>
                                <li>What challenges did you face and how did you overcome them?</li>
                                <li>What worked? What could you have improved upon?</li>
                                <li>What was a specific impact of your efforts?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="6" data-primary-question-id="36" type="button">
                                <span>Describe the most critical challenges that you face today in providing quality service to your customers.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What are the challenges?</li>
                                <li>What steps do you take to address the challenges and improve the quality of customer service?</li>
                                <li>What resources, if any, do you leverage to address the challenges?</li>
                                <li>How have your efforts impacted your organization?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Dealing with Ambiguity" data-capability-description="Adapts easily to new policies, methods, and procedures to effectively manage change; maintains composure when confronted with unexpected events; accounts for the possibility of unexpected events into plans and processes; develops strategies to cope with unexpected events." data-capability-id="7" type="button">
                        <span>Dealing with Ambiguity</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="7" data-primary-question-id="37" type="button">
                                <span>Tell me about a time when you had to change the way you completed a task based on new information or feedback you were given. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you respond to the information or feedback?</li>
                                <li>What changes did you make in your performance of the task?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="7" data-primary-question-id="38" type="button">
                                <span>Describe a time when you had to shift your attention quickly from one assignment to another because of changing deadlines or priorities. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the change in deadlines or priorities?</li>
                                <li>How did you respond and what actions did you take?</li>
                                <li>How did you adapt in that situation?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="7" data-primary-question-id="39" type="button">
                                <span>Describe a time when you were asked to complete a task that you had never worked on before. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What steps did you take to plan and complete the task?</li>
                                <li>What information did you consider?</li>
                                <li>How did you know that you had successfully completed the task?</li>
                                <li>What did you learn from the situation that you could apply to others?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="7" data-primary-question-id="40" type="button">
                                <span>Describe a recent work-related project that was challenging because it was fast-paced or there were many changes. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was challenging about the assignment?</li>
                                <li>What tools or resources did you use?</li>
                                <li>What did you do that succeeded? What didn&#39;t?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="7" data-primary-question-id="41" type="button">
                                <span>Describe how you have helped others in your organization to adapt to changes in the workplace. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What actions did you take to make sure the employee overcame the changes?</li>
                                <li>What were some challenges you faced and how did you overcome them?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="7" data-primary-question-id="42" type="button">
                                <span>Describe a time when you and your team had to adapt quickly to competing demands and changing priorities. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation and how did you respond?</li>
                                <li>What did you learn from this experience?</li>
                                <li>How did you use this experience to enhance your organization&#39;s ability to adapt?</li>
                                <li>What was the impact of your efforts?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Decision Making/Problem Solving" data-capability-description="Makes decisions and solves problems that enhance team, unit, and/or organizational performance based on analysis, experience, and judgment; integrates all of the available information in order to determine the root cause of problems and make the best possible decision in a timely manner; considers benefits, risks, and immediate and future implications of decisions; involves others as appropriate to gain buy-in and implement decisions." data-capability-id="8" type="button">
                        <span>Decision Making/Problem Solving</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="8" data-primary-question-id="43" type="button">
                                <span>Tell me about a time when you had to make a decision, even though you felt you didn't have all the information you needed.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What information did you have? What information were you missing?</li>
                                <li>How did you come to your decision?</li>
                                <li>What was the outcome of the decision you made?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="8" data-primary-question-id="44" type="button">
                                <span>Tell me about a time you were under pressure from a colleague or leader to make a decision quickly. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>Why was the decision under time pressure?</li>
                                <li>How did you approach your decision-making process?</li>
                                <li>How efficiently did you make the decision?</li>
                                <li>What was the outcome? Were you deliberate enough in your analysis?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="8" data-primary-question-id="45" type="button">
                                <span>Describe a time when you had to make an assessment, recommendation, or decision when directions or guidelines were either new or unclear. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the assessment, recommendation, or decision?</li>
                                <li>What was your role in making the assessment, recommendation, or decision?</li>
                                <li>What steps did you take to interpret the guidelines?</li>
                                <li>What alternatives did you consider? How did you determine the implications of each alternative?</li>
                                <li>How did you deal with unclear information?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="8" data-primary-question-id="46" type="button">
                                <span>Give me an example of a time you had to make a decision where you needed to carefully consider a great deal of conflicting, as well as supporting, information, opinions and data.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the decision?</li>
                                <li>What information did you consider?</li>
                                <li>What challenges did you face and how did you overcome them?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="8" data-primary-question-id="47" type="button">
                                <span>Describe a time when you had to defend a difficult business decision that you made or were involved in making.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the decision?</li>
                                <li>What factors were considered in making the decision?</li>
                                <li>What challenges or resistance did you face in making the decision?</li>
                                <li>Who did you have to defend the decision to?</li>
                                <li>How were you able to maintain your position that the right decision was made?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="8" data-primary-question-id="48" type="button">
                                <span>Describe how you have monitored and analyzed key information or factors (such as economic, financial, customer, industry, staff, etc.) to make a complex leadership decision.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>Why was the decision so important? What were the implications?</li>
                                <li>What information/factors did you monitor and analyze? What processes or steps did you use?</li>
                                <li>What was your decision-making process? Describe the strategies you used to incorporate this information or these factors into your decision-making process.</li>
                                <li>How did you know when you had enough information to make the decision?</li>
                                <li>How did you determine if you made an effective decision?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Delegating" data-capability-description="Assigns task responsibility and/or decision-making authority to others, as appropriate, in order to maximize organizational and individual effectiveness. Ensures that tasks are appropriately allocated and satisfactorily completed by monitoring performance against a predetermined deadline and/or measure of quality." data-capability-id="9" type="button">
                        <span>Delegating</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="9" data-primary-question-id="49" type="button">
                                <span>We all experience heavy work loads requiring us to get others to help. Tell me about a time when you worked with another employee to help you with a heavy workload. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>How did you decide what work to give to the person?</li>
                                <li>How did things work out?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="9" data-primary-question-id="50" type="button">
                                <span>Describe a time when you were assigned a task when you already had a full plate. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you respond?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="9" data-primary-question-id="51" type="button">
                                <span>Describe the factors you consider when delegating work to others. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>How do you ensure the work delegated is consistent with others&#39; skill levels?</li>
                                <li>How did you track the employee&#39;s progress?</li>
                                <li>How do you share feedback with the employee?</li>
                                <li>Can you give me a specific example of when you applied these factors?</li>
                                <li>What has been the impact of your efforts on employees and on the organization?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="9" data-primary-question-id="52" type="button">
                                <span>Describe a success you have had in delegating a complex or difficult task to an employee.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the task? Why was it complex or difficult?</li>
                                <li>What factors did you consider when selecting this employee for the task?</li>
                                <li>How did you measure his/her performance?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="9" data-primary-question-id="53" type="button">
                                <span>Tell me about a time where you delegated too much work or responsibility to a member of your team who was not able to complete the task.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation? What did you delegate?</li>
                                <li>How did you respond?</li>
                                <li>How did you manage the situation?</li>
                                <li>What did you learn?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="9" data-primary-question-id="54" type="button">
                                <span>Describe a time when you delegated a task to a team member who did not perform the task as you would have performed it. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you handle it?</li>
                                <li>How did you measure success?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Developing Self and Others" data-capability-description="Possesses self-awareness and understands personal strengths and developmental needs; seeks and/or provides growth opportunities, guidance, and support in the development of self or other employees by providing specific and meaningful feedback and by identifying and addressing performance gaps." data-capability-id="10" type="button">
                        <span>Developing Self and Others</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="10" data-primary-question-id="55" type="button">
                                <span>Tell me about a time when you had to show a new employee how to do the job. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What steps did you take?</li>
                                <li>How did the person respond?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="10" data-primary-question-id="56" type="button">
                                <span>Describe a time when you helped a co-worker improve their work performance. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What steps did you take?</li>
                                <li>How did they react to your help?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="10" data-primary-question-id="57" type="button">
                                <span>Give an example of when you have proactively sought feedback from others. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What was the impact of that feedback?</li>
                                <li>How did you feel after receiving the feedback?</li>
                                <li>How did you incorporate the feedback into your future behavior?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="10" data-primary-question-id="58" type="button">
                                <span>Provide an example of when you successfully coached a team member to either raise their level of performance or exit the organization.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What coaching approach did you utilize?</li>
                                <li>How did the team member respond?</li>
                                <li>Looking back, is there anything you would have done differently?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="10" data-primary-question-id="59" type="button">
                                <span>Describe a time when you mentored an employee for career advancement. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What steps did you take?</li>
                                <li>How did you determine the specific developmental opportunities?</li>
                                <li>What resources, tools, or opportunities did you provide?</li>
                                <li>How did you help the employee overcome obstacles along the way? What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="10" data-primary-question-id="60" type="button">
                                <span>Describe a time when you improved the performance of an underperforming team. What specific actions did you take to achieve this turnaround?</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What did you consider when identifying the appropriate actions to take?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Initiative" data-capability-description="Recognizes assignments or tasks that need to be completed; takes independent action and completes job tasks without being instructed to complete them; seeks out additional assignments or tasks; demonstrates eagerness, enthusiasm, persistence, and optimism when working." data-capability-id="11" type="button">
                        <span>Initiative</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="11" data-primary-question-id="61" type="button">
                                <span>Tell me about a time when you were working on an assignment and it caused you a great deal of frustration.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What steps did you take to respond to this situation?</li>
                                <li>Were you successful? How did you know you were successful?</li>
                                <li>What did you learn from the experience? What did you enjoy about it?</li>
                                <li>How did you feel about the situation?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="11" data-primary-question-id="62" type="button">
                                <span>Describe a situation in which you were able to identify and work independently on an assignment without the instruction of your manager. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What challenges or setbacks did you face?</li>
                                <li>What steps did you take in response to these challenges or setbacks?</li>
                                <li>How did the situation turn out? How did your manager respond?</li>
                                <li>What did you learn from the experience?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="11" data-primary-question-id="63" type="button">
                                <span>Tell me about a time you recognized a problem before your supervisor or others in the organization did. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What problem did you recognize?</li>
                                <li>How did you respond?</li>
                                <li>How was the problem addressed? Did you play a role?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="11" data-primary-question-id="64" type="button">
                                <span>Tell me about a time when your initiative led to a change occurring in a work process or product. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>How did you identify the change required?</li>
                                <li>What steps did you take to implement the change?</li>
                                <li>Who did you partner with to implement the change?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="11" data-primary-question-id="65" type="button">
                                <span>Tell me about a time when you needed to take action in order to seize an opportunity.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you take action?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="11" data-primary-question-id="66" type="button">
                                <span>Describe a project where it was challenging to get employees to take ownership of achieving objectives. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the project?</li>
                                <li>How did you inspire others to take initiative?</li>
                                <li>How did you measure success?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Integrity/Respectfulness" data-capability-description="Implements, upholds, and enforces ethical standards and compliance with local, state, and federal laws as well as company policies; presents oneself in a positive and professional manner with other employees and customers, showing integrity, respect, and ethical behavior in all work situations; reports ethical and compliance issues promptly." data-capability-id="12" type="button">
                        <span>Integrity/Respectfulness</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="12" data-primary-question-id="67" type="button">
                                <span>Did you ever have to deal with situations where others weren&#39;t following policies and procedures? If so what did you do? </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you encourage others to uphold the highest standards of integrity and ethics?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="12" data-primary-question-id="68" type="button">
                                <span>Tell me about a time when you could have gotten away with making an error but decided to let your supervisor know.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the error?</li>
                                <li>How did you take responsibility for it?</li>
                                <li>What were the consequences?</li>
                                <li>How did you react?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="12" data-primary-question-id="69" type="button">
                                <span>What kinds of work-related situations have you faced that challenged your integrity and ethical standards? Can you give me a specific example of how you handled such a situation?</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>Who was involved?</li>
                                <li>How did you react?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="12" data-primary-question-id="70" type="button">
                                <span>What steps have you taken to communicate and support the highest standards of integrity and ethics in your area of responsibility? Please provide specific examples.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>How have you judged the success of your efforts?</li>
                                <li>What challenges did you face and how did you overcome them?</li>
                                <li>What worked? What didn&#39;t work?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="12" data-primary-question-id="71" type="button">
                                <span>Describe a situation when you were faced with a challenging business decision that had ethical implications.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What decision did you make?</li>
                                <li>What was the nature and scope of the ethical and business implications?</li>
                                <li>How did you frame the issue when communicating to others?</li>
                                <li>What was the result?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="12" data-primary-question-id="72" type="button">
                                <span>Describe a process or initiative you have implemented to promote and reinforce organizational standards for integrity and ethics. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the process/initiative?</li>
                                <li>Why was it needed?</li>
                                <li>What information did you consider?</li>
                                <li>What did you do that succeeded? What didn&#39;t?</li>
                                <li>What, if anything, would you have done differently?</li>
                                <li>What was the impact of your efforts?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Leadership" data-capability-description="Uses appropriate methods and interpersonal styles to motivate, and guide one's team or department to complete tasks and drive business results." data-capability-id="13" type="button">
                        <span>Leadership</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="13" data-primary-question-id="73" type="button">
                                <span>Describe a time when how you gained support and buy-in from senior leaders for a business plan that you drove.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What actions did you take?</li>
                                <li>What were the outcomes?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="13" data-primary-question-id="74" type="button">
                                <span>Sometimes teams get off track when working toward completing a project or achieving a goal. Describe a time when this happened and you were able to help your team get back on track.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the problem?</li>
                                <li>What steps did you take to address the issues?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="13" data-primary-question-id="75" type="button">
                                <span>Describe a time when you had to gain the commitment of others at a large-scale change, such as a new vision or strategy for accomplishing goals that you were implementing. First, describe the change effort. Then, describe the steps you took to communicate this change and gain commitment.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What change were you trying to implement? Why was change necessary?</li>
                                <li>What obstacles or resistance did you encounter?</li>
                                <li>How did you try to overcome any resistance or resentment?</li>
                                <li>What did you do to try to gain commitment from others?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="13" data-primary-question-id="76" type="button">
                                <span>Describe a time when you established performance expectations for a team.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>How did you set the expectations?</li>
                                <li>How did you manage or monitor performance against these expectations?</li>
                                <li>What were the results?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="13" data-primary-question-id="77" type="button">
                                <span>Describe the steps you have taken to ensure work-related tasks and operations performed by you and others met company standards. Please provide specific examples.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was your role?</li>
                                <li>How did you ensure customer satisfaction with products and services?</li>
                                <li>How did you determine the impact of your efforts?</li>
                                <li>What did you do that succeeded? What didn&#39;t?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="13" data-primary-question-id="78" type="button">
                                <span>Describe how you have gained support and buy-in from your coworkers and direct reports for a task-related idea you had to improve performance and business outcomes.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What did you do that succeeded? What didn&#39;t?</li>
                                <li>How did you communicate your idea to your coworkers and direct reports?</li>
                                <li>How did you ensure support from your coworkers and direct reports?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Learning and Intellectual Curiosity" data-capability-description="Seeks out opportunities to learn new skills, tasks, processes, and best practices to grow as a professional; quickly comprehends and applies new information from formal and informal learning on the job." data-capability-id="14" type="button">
                        <span>Learning and Intellectual Curiosity</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="14" data-primary-question-id="79" type="button">
                                <span>Describe a time when you were able to learn something complex in a short period of time. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What made this complex?</li>
                                <li>How did the short period of time you had to learn impact you?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="14" data-primary-question-id="80" type="button">
                                <span>Tell me about a time where you learned a new practice or procedure through observing a co-worker perform a task.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the practice or procedure that you were observing?</li>
                                <li>Who were you observing?</li>
                                <li>How did you apply what you observed into your own work?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="14" data-primary-question-id="81" type="button">
                                <span>Describe steps that you have taken to learn about best practices within your organization.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What steps have you taken?</li>
                                <li>What are examples of best practices that you have learned about?</li>
                                <li>How have you implemented these practices into how you complete your work?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="14" data-primary-question-id="82" type="button">
                                <span>Tell me about a time when you identified a personal skill gap that was impacting your work.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the skill gap?</li>
                                <li>How did you recognize you had a skill gap?</li>
                                <li>What steps did you take to address the gaps?</li>
                                <li>How effective were you in developing the skill? How do you know?</li>
                                <li>Have you applied the skill in other situations? Can you give me a specific example?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="14" data-primary-question-id="83" type="button">
                                <span>How have you built and sustained an environment that promoted and supported continuous learning in your organization? </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What steps did you take?</li>
                                <li>Why did you consider continuous learning important?</li>
                                <li>What challenges did you face and how did you overcome them?</li>
                                <li>What was the impact of your efforts?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="14" data-primary-question-id="84" type="button">
                                <span>Describe what you have done to improve the knowledge of employees in your organization. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What characteristics have you emphasized?</li>
                                <li>How have you addressed continuous learning?</li>
                                <li>What challenges did you face and how did you overcome them?</li>
                                <li>What was the impact of your efforts?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Persuasion/Influence" data-capability-description="Convinces or persuades key stakeholders clearly and concisely by presenting and discussing opinions, ideas, and positions; articulates messages and talking points in a convincing, confident, and poised manner; presents visionary and appealing messages to inspire and lead multiple internal and external constituencies to adopt a common vision; listens to others' points of view during debates or negotiations; adapts communication styles to others." data-capability-id="15" type="button">
                        <span>Persuasion/Influence</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="15" data-primary-question-id="85" type="button">
                                <span>Please recall an experience when you needed to convince someone at or above your level that his or her approach toward an issue was less effective than yours.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the issue?</li>
                                <li>How did this person&#39;s viewpoint differ from your own?</li>
                                <li>How did you persuade the person to accept your viewpoint?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="15" data-primary-question-id="86" type="button">
                                <span>Describe a time where you attempted to convince others to accept your idea when you had a controversial or unpopular opinion compared to other employees (e.g., coworkers, supervisors).</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the idea or change?</li>
                                <li>Why did you think it would be unpopular?</li>
                                <li>How did you gain support for the idea or change?</li>
                                <li>What problems did you encounter and how did you overcome them?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="15" data-primary-question-id="87" type="button">
                                <span>Tell me about a time when you strongly felt that a policy or decision made by another person or group was the wrong decision to make.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the decision and why did you think it was wrong?</li>
                                <li>Did you take any action to attempt to change the decision? If so, what was the action?</li>
                                <li>What was the reaction to your opinion?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="15" data-primary-question-id="88" type="button">
                                <span>Tell me about a time when you had to get the buy-in of others higher in the organization for a new or challenging project.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What were you trying to accomplish and why did you need support?</li>
                                <li>Whose support did you seek?</li>
                                <li>What methods did you use to gain their support?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="15" data-primary-question-id="89" type="button">
                                <span>Describe a recent example of how you managed resistance to a new initiative. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the initiative or process?</li>
                                <li>What steps did you take? What were the reasons for the resistance?</li>
                                <li>What challenges did you face and how did you overcome them?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="15" data-primary-question-id="90" type="button">
                                <span>Tell me about a time when you had to inspire others and build commitment for process-driven changes.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>How did your techniques differ for those higher vs. lower in the organization?</li>
                                <li>What resistance did you face?</li>
                                <li>What approach did you take to gain support for these changes?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Quality" data-capability-description="Sets and follows standards for work to achieve a high level of quality or service free of errors or omissions by following relevant procedures and paying attention to details." data-capability-id="16" type="button">
                        <span>Quality</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="16" data-primary-question-id="91" type="button">
                                <span>Describe a time when you reported potential errors in a work-related system/situation to your supervisor.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the system/situation?</li>
                                <li>What were the errors that you identified?</li>
                                <li>How did you communicate the errors to your supervisor?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="16" data-primary-question-id="92" type="button">
                                <span>Describe processes that you have implemented to ensure that you are providing customers with accurate and high quality information. Please provide specific examples.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What steps did you take?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="16" data-primary-question-id="93" type="button">
                                <span>Describe a time when your work was not up to company standards or was lacking in quality.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What were the main issues with your work?</li>
                                <li>What did you do to increase the quality of your work?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="16" data-primary-question-id="94" type="button">
                                <span>Tell me about a time when you needed to follow specific strategies and standards to ensure a high quality outcome.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What strategies or standards did you need to follow?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="16" data-primary-question-id="95" type="button">
                                <span>Describe the strategies you have developed to maximize efficiency, effectiveness, and productivity.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What steps did you take to implement these strategies?</li>
                                <li>How did you measure the impact of your efforts?</li>
                                <li>Were you able to maintain this level of performance? If so, how?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="16" data-primary-question-id="96" type="button">
                                <span>Describe a time when you transformed a critical improvement opportunity into an operational success. In your answer, describe how you identified the opportunity and the action plans you implemented to produce improvement.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What information did you consider?</li>
                                <li>How did your efforts impact overall practices and operation in your area of responsibility?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Relationship Building/Networking" data-capability-description="Develops and maintains quality relationships and partnerships based on transparency, trust, communication, and credibility with others to accomplish work objectives; builds and leverages appropriate networks inside and outside of the organization to identify opportunities, create partnerships, and assess the competitive environment." data-capability-id="17" type="button">
                        <span>Relationship Building/Networking</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="17" data-primary-question-id="97" type="button">
                                <span>Describe the steps you have taken to address and help resolve conflicts or disagreements between coworkers. Please provide specific examples.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What steps did you take to help coworkers work together better?</li>
                                <li>How did you communicate with them?</li>
                                <li>What did you do to build trust?</li>
                                <li>What was the impact of your efforts?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="17" data-primary-question-id="98" type="button">
                                <span>What key relationships have you established to meet job goals? How did you initiate these relationships and why were they important?</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What steps did you take?</li>
                                <li>How did you decide whom to target?</li>
                                <li>What information did you need?</li>
                                <li>How did you measure your success?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="17" data-primary-question-id="99" type="button">
                                <span>Describe a time when you were able to develop a positive working relationship with a customer, supervisor, or co-worker, who others thought was difficult to work with.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What made the individual difficult to work with?</li>
                                <li>What steps did you take to develop the relationship?</li>
                                <li>What was the outcome of the situation?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="17" data-primary-question-id="100" type="button">
                                <span>Describe a professional relationship that you had with a coworker or manager that was at times difficult or strained.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you handle it?</li>
                                <li>What was the result?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="17" data-primary-question-id="101" type="button">
                                <span>Describe how you have developed strategic relationships to generate a competitive advantage for your team.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What relationships have you developed?</li>
                                <li>How did you represent the organization?</li>
                                <li>How did you engage your team?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="17" data-primary-question-id="102" type="button">
                                <span>Describe a situation in which you developed and implemented strategies that involved using relationships and networks to solve a business challenge.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What did you do to establish relationships?</li>
                                <li>How did you use those relationships and networks?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Resilience/Adaptability" data-capability-description="Persists in working towards work objectives even in the face of opposition or challenges; quickly bounces back after setbacks or failures." data-capability-id="18" type="button">
                        <span>Resilience/Adaptability</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="18" data-primary-question-id="103" type="button">
                                <span>Describe a recent work-related project that was challenging because it was fast-paced or there were many opportunities for potential failure.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was challenging about the assignment?</li>
                                <li>What tools or resources did you use?</li>
                                <li>What did you do that succeeded? What didn&#39;t?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="18" data-primary-question-id="104" type="button">
                                <span>Tell me about a time where you changed how you completed a work task based on previous setbacks for failures.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the task?</li>
                                <li>What was your initial method for completing the task? What was your final method?</li>
                                <li>What steps did you take to change how you completed the task?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="18" data-primary-question-id="105" type="button">
                                <span>Describe a work accomplishment that required you to overcome substantial obstacles or adversity.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the work accomplishment?</li>
                                <li>What were the obstacles or adversity?</li>
                                <li>Did you overcome the obstacles or adversity? If yes, what did you do to overcome them?</li>
                                <li>What was the result?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="18" data-primary-question-id="106" type="button">
                                <span>Describe a time when you were able to learn and grow from a project setback.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the project?</li>
                                <li>What was the setback that occurred?</li>
                                <li>What steps did you take to overcome this setback?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="18" data-primary-question-id="107" type="button">
                                <span>Describe a time when you successfully implemented a new work task or procedure that was initially unsuccessful.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the work task or procedure?</li>
                                <li>What made it unsuccessful initially?</li>
                                <li>What actions did you take to attempt to rectify the situation?</li>
                                <li>What was the final outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="18" data-primary-question-id="108" type="button">
                                <span>Tell me about a time when a business initiative did not go as planned. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What did you do to turn it around and make it work?</li>
                                <li>What information did you use?</li>
                                <li>How did you turn things around?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Results Orientation" data-capability-description="Establishes and pursues realistic goals to timely completion, overcomes challenges, drives for value creation and reliable results; accepts responsibility to monitor, track, and continuously improve results; demonstrates commitment to follow through and stay motivated." data-capability-id="19" type="button">
                        <span>Results Orientation</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="19" data-primary-question-id="109" type="button">
                                <span>Describe a situation in which you implemented solutions that achieved personal or work-related goals and initiatives.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was your plan?</li>
                                <li>Who did you involve, if anyone?</li>
                                <li>What challenges did you face and how did you overcome them?</li>
                                <li>How did you measure your success?</li>
                                <li>What would you do differently based on your results?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="19" data-primary-question-id="110" type="button">
                                <span>Describe what you have done to meet or exceed defined targets over the past 6 months.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What were the targets or objectives?</li>
                                <li>How did you achieve these targets?</li>
                                <li>What did you use to measure the impact of your efforts?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="19" data-primary-question-id="111" type="button">
                                <span>Tell me about a time you followed through a project plan, tracked progress, and achieved the expected results.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you determine the appropriate project steps?</li>
                                <li>How did you track the project progress against the timeline?</li>
                                <li>What was the result?</li>
                                <li>What, if anything, would you do differently?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="19" data-primary-question-id="112" type="button">
                                <span>Describe what you have done to ensure results were achieved in your area of responsibility over the last 6 months.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What were the objectives?</li>
                                <li>What were your contingency plans?</li>
                                <li>What were your metrics?</li>
                                <li>What was the result?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="19" data-primary-question-id="113" type="button">
                                <span>Describe how you have moved an underperforming segment of your responsibility area to a high-performing segment.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What steps did you take?</li>
                                <li>What were your metrics?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="19" data-primary-question-id="114" type="button">
                                <span>Describe your current approach to monitoring the results delivered by your team. How do you make sure your team&#39;s results are consistent with established goals, schedules, and budgets?</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What routines, methods or information sources do use to monitor your team&#39;s results?</li>
                                <li>What tools or techniques do you use to seek input from others about your team' results?</li>
                                <li>What measures or metrics do you use to track your team's results?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Safety" data-capability-description="Stays up to date with safety policies and procedures; follows safety policies and procedures when completing work and encourages others to work in a safe manner; responds appropriately in an emergency and reports unsafe conditions or safety hazards; monitors safety in the work environment and contributes to initiatives that promote a safety culture." data-capability-id="20" type="button">
                        <span>Safety</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="20" data-primary-question-id="115" type="button">
                                <span>Tell me about a time when you had to explain safety policies or procedures to someone else.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you make sure you were providing the accurate information?</li>
                                <li>How did you communicate safety policies or procedures to help others understand them?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="20" data-primary-question-id="116" type="button">
                                <span>Tell me about a time when you had to address a cleanliness or safety issue. Please provide specific examples. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What specific steps did you take?</li>
                                <li>How did you handle exceptions to safety standards?</li>
                                <li>What obstacles did you face, and how did you overcome them?</li>
                                <li>What did you learn from the situation?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="20" data-primary-question-id="117" type="button">
                                <span>Tell me about a situation when you utilized your knowledge of occupational health and safety initiatives (e.g., EAP referrals, FMLA, disability case management, etc.) to make a work-related decision.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What decision did you have to make?</li>
                                <li>What steps did you take?</li>
                                <li>What was the result?</li>
                                <li>What, if anything, would you do differently?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="20" data-primary-question-id="118" type="button">
                                <span>Tell me about a time you used metrics or measures to assess safety in your area.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What kinds of analyses did you conducted?</li>
                                <li>What metrics did you use?</li>
                                <li>Which metrics were most successful in identifying areas of concern?</li>
                                <li>What, if anything, would you do differently?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="20" data-primary-question-id="119" type="button">
                                <span>Tell me about a time when you utilized your knowledge of safety policies, procedures and regulations to enhance employee safety on your team or in your work unit.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What steps did you take?</li>
                                <li>How did your knowledge of safety policies and regulations assist you?</li>
                                <li>What was the result?</li>
                                <li>What, if anything, would you do differently?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="20" data-primary-question-id="120" type="button">
                                <span>Tell me about a time when you participated in a safety audit or investigated a safety incident.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was your role?</li>
                                <li>What steps did you take?</li>
                                <li>What was the result?</li>
                                <li>What, if anything, would you do differently?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Sales Ability" data-capability-description="Applies marketplace and product knowledge as well as selling skills tailored to the needs of the customer; positively impacts customers&#39; business and compliantly delivers sales results; develops and maintains customer relationships; proactively drives account growth and develops new accounts; aligns sales strategies with business objectives to maximize mutually beneficial results." data-capability-id="21" type="button">
                        <span>Sales Ability</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="21" data-primary-question-id="121" type="button">
                                <span>Tell me about the day-to-day sales processes you have performed in your current or previous jobs. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What did you do?</li>
                                <li>What steps did you take to follow up on customer concerns, issues, and requests?</li>
                                <li>How have you increased sales and built relationships with customers?</li>
                                <li>Did you build interest in new sales? If so, please describe.</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="21" data-primary-question-id="122" type="button">
                                <span>Describe an instance where your connection with a customer led to new sales/business? </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What steps did you take to build trust with the customer?</li>
                                <li>How did the new customer contribute to your sales results?</li>
                                <li>What did you learn from the process?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="21" data-primary-question-id="123" type="button">
                                <span>Describe a time when you used analytical findings to identify business development opportunities and achieve a competitive advantage.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What information did you consider?</li>
                                <li>What analyses did you perform?</li>
                                <li>What steps did you take?</li>
                                <li>What did you do that succeeded? What didn't?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="21" data-primary-question-id="124" type="button">
                                <span>Tell me about your largest sales account that you had managed or supported in the past 12 months. You do not need to provide the customer/client name. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>How did you acquire this account?</li>
                                <li>What responsibilities did you have for this account?</li>
                                <li>What challenge did you face in managing or supporting the account?</li>
                                <li>How did this account contribute to your individual sales target and your team&#39;s or company&#39;s financial goals?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="21" data-primary-question-id="125" type="button">
                                <span>Describe a time when you partnered with others across functions to develop and execute a business or account plan to drive sales.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you identify who to partner with?</li>
                                <li>What financial acumen and analytics did you incorporate into the plan?</li>
                                <li>What resources did you use to develop the plan?</li>
                                <li>What steps did you take to execute the plan?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="21" data-primary-question-id="126" type="button">
                                <span>Tell me about a time when you identified and reacted to changes in the external landscape (e.g., marketplace, competition) that impacted your sales objectives.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you identify changes? What were the changes?</li>
                                <li>How did the changes impact your sales objectives?</li>
                                <li>What implications did these changes have on business?</li>
                                <li>Did you make adjustments to business plans and account management strategies? If so, what were the adjustments?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Teamwork" data-capability-description="Actively participates as a committed member of a team, cooperating and working well with other team members to accomplish goals; builds on others&#39; work and contributes to others&#39; success; compromises to establish consensus and move forward; shares information with others, adheres to team expectations and guidelines, and fulfills team responsibilities." data-capability-id="22" type="button">
                        <span>Teamwork</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="22" data-primary-question-id="127" type="button">
                                <span>Describe a time when you were asked to help a team member with work-related task even though you had your own portion of the team's work to complete.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>Why were you asked to help this person?</li>
                                <li>What other commitments did you have?</li>
                                <li>Did you assist the individual? Why or why not?</li>
                                <li>What steps did you take to assist the other person?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="22" data-primary-question-id="128" type="button">
                                <span>Describe a time when you needed to share resources with others on a team to complete one or more projects at work.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What were the projects?</li>
                                <li>What information did you consider?</li>
                                <li>Who did you involve?</li>
                                <li>What challenges did you face and how did you overcome them?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="22" data-primary-question-id="129" type="button">
                                <span>Tell me about a time when you reached an agreement or compromise with a co-worker in order to complete a work assignment or task.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the issue?</li>
                                <li>What steps did you take to understand the other person's point of view?</li>
                                <li>How were you able to reach a compromise with the other person?</li>
                                <li>What was the outcome of the situation?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="22" data-primary-question-id="130" type="button">
                                <span>Tell me about a time when you were working with a group on an assignment or task and the members of the group had many different ideas or points of view.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How did you communicate your idea or point of view?</li>
                                <li>What challenges did you and/or the team encounter?</li>
                                <li>What steps did you take to overcome these challenges?</li>
                                <li>What was the outcome of the situation? Did you agree with it?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="22" data-primary-question-id="131" type="button">
                                <span>Describe a situation in which your peer needed support or resources from you during a time when your workload was already heavy.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What support or resources were being asked of you?</li>
                                <li>What were your conflicting priorities?</li>
                                <li>How did you respond to your peer?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="22" data-primary-question-id="132" type="button">
                                <span>Describe a time when you have organized activities and projects to cultivate a team-based environment where team members are encouraged to openly share information and support each other.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>How did you come up with the plans for those activities and projects?</li>
                                <li>How did you communicate your plan to your team?</li>
                                <li>How did you reinforce the expected behaviors?</li>
                                <li>What challenges did you face and how did you overcome them?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="InterviewQuestionnaire-listItem">
                    <button class="js-add-capability-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-name="Time Management" data-capability-description="Plans, manages, prioritizes, and organizes project elements considering time constraints, urgency, process improvements, business needs, budget, and available resources." data-capability-id="23" type="button">
                        <span>Time Management</span>
                    </button>
                    <ul class="js-interview-questionnaire-primary-questions d-none">
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="23" data-primary-question-id="133" type="button">
                                <span>Describe a time where you developed a plan to complete a project or task with another employee (e.g., supervisor, co-worker).</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the project or task?</li>
                                <li>What steps did you take to plan out how you were going to complete the project?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="23" data-primary-question-id="134" type="button">
                                <span>What techniques or approaches have you used to keep track of items that need your attention? Tell me about a time when you used that technique or approach.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>How has your approach changed? Why?</li>
                                <li>Is your approach effective? How do you know?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="23" data-primary-question-id="135" type="button">
                                <span>Describe a recent situation or project in which you developed a back-up or contingency plan. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the back-up or contingency plan?</li>
                                <li>Why did you think a back-up or contingency plan was necessary?</li>
                                <li>What steps did you take in developing the back-up or contingency plan?</li>
                                <li>What was the outcome? What did you learn and how did you apply this in the future?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="23" data-primary-question-id="136" type="button">
                                <span>Describe a time where a project became confusing due to poor planning and time management.</span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the project?</li>
                                <li>What made the initial planning poor?</li>
                                <li>What steps did you take to improve the planning?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="23" data-primary-question-id="137" type="button">
                                <span>Describe the planning that went into a recent project. In your response, describe how you set timelines for yourself and your team. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the project?</li>
                                <li>Who did you involve in developing project plans?</li>
                                <li>How did you track progress?</li>
                                <li>How did you help your team meet the timelines and accomplish their goals?</li>
                                <li>What was the outcome?</li>
                            </ul>
                        </li>
                        <li class="InterviewQuestionnaire-listItem">
                            <button class="js-add-primary-question-button btn border-0 p-0 bg-transparent rounded-0 text-start" data-capability-id="23" data-primary-question-id="138" type="button">
                                <span>Describe a time when you had to help a struggling employee set expectation and timelines to become more organized. </span>
                            </button>
                            <ul class="d-none js-interview-questionnaire-probe-questions">
                                <li>What was the situation?</li>
                                <li>What actions did you take?</li>
                                <li>What was the impact of your efforts?</li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <br />
            <input type="button" onclick="formBackSubmit(this)" value="Back" class="btn btn-primary rounded-pill px-5 py-2 FormsSig-form-bttn">
        </div>
        <div id="block3" class="col-12 col-lg-6 d-none">
            <h4>Your chosen questions will appear here</h4>
            <div id="capability1" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability2" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability3" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability4" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability5" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability6" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability7" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability8" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability9" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability10" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability11" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability12" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability13" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability14" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability15" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability16" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability17" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability18" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability19" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability20" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability12" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability22" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <div id="capability23" class="border capabilitybox mb-3 p-3 rounded-3"></div>
            <br />
            <input type="button" onclick="formPDFCSubmit(this)" value="Submit" class="btn btn-primary rounded-pill px-5 py-2 FormsSig-form-bttn">
            <br />
        </div>
        <div id="block4" class="col-12 --show-in-pdf" style="display:none">
            <div class="pdf-content-block">
                <div class="PDF-header-section"> <img height="24" src="<?php echo get_site_url(); ?>/wp-content/themes/spinco/images/rxo-logo.svg" class="custom-logo" alt="RXO | Massive capacity. Cutting-edge technology.">
                    <p class="text-center p-3">Interview Guide</p>
                </div>
                <table class="PDF-table" nobr="true">
                    <tbody>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Candidate Name: </span></td>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Date of Interview: </span></td>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Candidate type: </span> <span id="display_candidate_type"></span></td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Interviewer Name:</span></td>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Job location: </span> <span id="display_job_location"></span></td>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Panel Interview: </span> <span id="display_panel_interview"></span></td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Job Title:</span> <span id="display_job_title"></span></td>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Requisition: </span></td>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Job function: </span> <span id="display_job_function"></span></td>
                        </tr>
                    </tbody>
                </table>
                <h1 class="PDF-subtitle text-center text-decoration-underline text-uppercase fs-4 ">Instructions</h1>
                <ol class="PDF-list px-5 mx-5">
                    <li> We recommend you review the interview training sessions available in the RXO University related to the
                        do's and don't of interviewing and how to conduct an effective behavioral interview </li>
                    <li> <span class="text-decoration-underline">Do not</span> ask questions regarding the following protected classifications: race/color, national origin or
                        ethnic background, religion, gender, age, disability, marital status/family status, sexual orientation,
                        pregnancy, military status and genetic information </li>
                    <li> If the candidate volunteers information that is not relevant to the position, the best way to handle
                        this situation is not acknowledge, pursue it nor to make note of it </li>
                    <li> Ask the same questions of all candidates to allow for true comparison </li>
                    <li> Review application materials for in advance for past jobs/experiences that are most relevant to the
                        interview </li>
                </ol>
                <p> The response to each question should be scored using a 5-point scale. </p>
                <ul class="PDF-list px-5 mx-5">
                    <li> At the low end (1), answers are considered poor, below expectations, never having exhibited such type of
                        behavior, or are unfamiliar with a concept. </li>
                    <li> At the middle range (3), answers are considered to be meeting expectations, the average answer,
                        sometimes exhibited such type of behavior, or familiar with a concept. </li>
                    <li> At the high end (5), answers are considered to be exceeding expectations, an excellent answer,
                        frequently exhibiting such type of behavior, or not only is familiar with the concept, but applies the
                        concept. </li>
                </ul>
                <p> Select the check box under the appropriate score for each question. </p>
                <table class="PDF-table" nobr="true">
                    <thead>
                        <th colspan="5" class="PDF-cellHeader">
                            <h1 class="text-black text-center m-0 p-0 fs-4">General Rating Scale</h1>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi">1</td>
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi">2</td>
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi">3</td>
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi">4</td>
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi">5</td>
                        </tr>
                        <tr class="PDF-checkboxes">
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi"><span class="PDF-checkbox">&nbsp;</span></td>
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi"><span class="PDF-checkbox">&nbsp;</span></td>
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi"><span class="PDF-checkbox">&nbsp;</span></td>
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi"><span class="PDF-checkbox">&nbsp;</span></td>
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi"><span class="PDF-checkbox">&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi" colspan="2">Little to No Demonstration of Capability</td>
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi">Demonstrates Capability</td>
                            <td class="PDF-cell PDF-cell--highlighted text-center font-demi" colspan="2">Consistently Demonstrates Capability</td>
                        </tr>
                        <tr>
                            <td class="PDF-cell text-centerr" colspan="2">Below Expectations Little to No Demonstration of Capability Under-Delivers</td>
                            <td class="PDF-cell text-center">Meets Expectations Demonstrates Capability Delivers</td>
                            <td class="PDF-cell text-center" colspan="2">Exceeds Expectations  Consistently Demonstrates Capability Delivers Above & Beyond</td>
                        </tr>
                    </tbody>
                </table>
                <div class="with-page-break"></div>
                <div class="html2pdf__page-break"></div>
                <div class="PDF-header-section"> <img height="24" src="<?php echo get_site_url(); ?>/wp-content/themes/spinco/images/rxo-logo.svg" class="custom-logo" alt="RXO | Massive capacity. Cutting-edge technology.">
                    <p class="text-center p-3">Interview Guide</p>
                </div>
                <h1 class="PDF-subtitle text-center text-decoration-underline text-uppercase m-2 p-2 fs-4">Opening the Interview</h1>
                <p> It is important to kickoff the interview in a positive and proper manner. Use the information in this section
                    to successfully kickoff the interview. </p>
                <ul class="PDF-list px-5 mx-5">
                    <li> Welcome the candidate </li>
                    <li> Introduce yourself and any other interviewers </li>
                    <li> Build Rapport </li>
                    <li> Set expectations of the interview (length, types of questions, order of interview, etc) </li>
                    <li> Provide overview of position and company </li>
                </ul>
                <h1 class="PDF-subtitle text-center text-decoration-underline text-uppercase m-2 p-2 fs-4">Introduction / Background Questions</h1>
                <p> Use this section to obtain information about how the candidates meet the required skills and knowledge for
                    the role using specifics from the job description. </p>
                <table class="PDF-table" nobr="true">
                    <tbody>
                        <tr>
                            <td class="PDF-cell PDF-cell--thin">Why are you currently seeking new employment? </td>
                            <td class="PDF-cell PDF-userEntryCell--large">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-cell--thin">Why are you interested in this role and working at RXO?</td>
                            <td class="PDF-cell PDF-userEntryCell--large">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <div class="with-page-break"></div>
                <div class="html2pdf__page-break"></div>
                <div class="PDF-header-section"> <img height="24" src="<?php echo get_site_url(); ?>/wp-content/themes/spinco/images/rxo-logo.svg" class="custom-logo" alt="RXO | Massive capacity. Cutting-edge technology.">
                    <p class="text-center p-3">Interview Guide</p>
                </div>
                <h1 class="center PDF-subtitle text-center text-decoration-underline text-uppercase m-2 p-2 fs-4">Current / Past Employment Review</h1>
                <h1 class="center PDF-subtitle text-center text-decoration-underline text-uppercase m-2 p-2 fs-4">(use as many or as few as needed)</h1>
                <table class="PDF-table" nobr="true">
                    <thead>
                        <tr>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Employer name:</h1>
                            </th>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Dates:</h1>
                            </th>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Position Title:</h1>
                            </th>
                        </tr>
                        <tr>
                            <th class="PDF-cell PDF-cell--thin PDF-userEntryCell">&nbsp;</th>
                            <th class="PDF-cell PDF-cell--thin PDF-userEntryCell">&nbsp;</th>
                            <th class="PDF-cell PDF-cell--thin PDF-userEntryCell">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"> What are/were your major responsibilities/duties? </td>
                            <td class="PDF-cell PDF-userEntryCell" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"> How do you see using these responsibilities here in this role? </td>
                            <td class="PDF-cell PDF-userEntryCell" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"> What other skills (technical, system, computer, etc.) did you obtain which relates to the role here? </td>
                            <td class="PDF-cell PDF-userEntryCell" colspan="2">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <table class="PDF-table" nobr="true">
                    <thead>
                        <tr>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Employer name:</h1>
                            </th>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Dates:</h1>
                            </th>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Position Title:</h1>
                            </th>
                        </tr>
                        <tr>
                            <th class="PDF-cell PDF-cell--thin PDF-userEntryCell">&nbsp;</th>
                            <th class="PDF-cell PDF-cell--thin PDF-userEntryCell">&nbsp;</th>
                            <th class="PDF-cell PDF-cell--thin PDF-userEntryCell">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"> What are/were your major responsibilities/duties? </td>
                            <td class="PDF-cell PDF-userEntryCell" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"> How do you see using these responsibilities here in this role? </td>
                            <td class="PDF-cell PDF-userEntryCell" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"> What other skills (technical, system, computer, etc.) did you obtain which relates to the role here? </td>
                            <td class="PDF-cell PDF-userEntryCell" colspan="2">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <div class="with-page-break"></div>
                <div class="html2pdf__page-break"></div>
                <div class="PDF-header-section"> <img height="24" src="<?php echo get_site_url(); ?>/wp-content/themes/spinco/images/rxo-logo.svg" class="custom-logo" alt="RXO | Massive capacity. Cutting-edge technology.">
                    <p class="text-center p-3">Interview Guide</p>
                </div>
                <h1 class="center PDF-subtitle text-center text-decoration-underline text-uppercase m-2 p-2 fs-4">Current / Past Employment Review</h1>
                <h1 class="center PDF-subtitle text-center text-decoration-underline text-uppercase m-2 p-2 fs-4">(use as many or as few as needed)</h1>
                <table class="PDF-table" nobr="true">
                    <thead>
                        <tr>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Employer name:</h1>
                            </th>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Dates:</h1>
                            </th>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Position Title:</h1>
                            </th>
                        </tr>
                        <tr>
                            <th class="PDF-cell PDF-cell--thin PDF-userEntryCell">&nbsp;</th>
                            <th class="PDF-cell PDF-cell--thin PDF-userEntryCell">&nbsp;</th>
                            <th class="PDF-cell PDF-cell--thin PDF-userEntryCell">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"> What are/were your major responsibilities/duties? </td>
                            <td class="PDF-cell PDF-userEntryCell" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"> How do you see using these responsibilities here in this role? </td>
                            <td class="PDF-cell PDF-userEntryCell" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"> What other skills (technical, system, computer, etc.) did you obtain which relates to the role here? </td>
                            <td class="PDF-cell PDF-userEntryCell" colspan="2">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <table class="PDF-table" nobr="true">
                    <thead>
                        <tr>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Employer name:</h1>
                            </th>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Dates:</h1>
                            </th>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Position Title:</h1>
                            </th>
                        </tr>
                        <tr>
                            <th class="PDF-cell PDF-cell--thin PDF-userEntryCell">&nbsp;</th>
                            <th class="PDF-cell PDF-cell--thin PDF-userEntryCell">&nbsp;</th>
                            <th class="PDF-cell PDF-cell--thin PDF-userEntryCell">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"> What are/were your major responsibilities/duties? </td>
                            <td class="PDF-cell PDF-userEntryCell" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"> How do you see using these responsibilities here in this role? </td>
                            <td class="PDF-cell PDF-userEntryCell" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"> What other skills (technical, system, computer, etc.) did you obtain which relates to the role here? </td>
                            <td class="PDF-cell PDF-userEntryCell" colspan="2">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <div class="with-page-break"></div>
                <div class="html2pdf__page-break"></div>
                <div id="behavioralcontenthere"></div>
                <div class="PDF-header-section"> <img height="24" src="<?php echo get_site_url(); ?>/wp-content/themes/spinco/images/rxo-logo.svg" class="custom-logo" alt="RXO | Massive capacity. Cutting-edge technology.">
                    <p class="text-center p-3">Interview Guide</p>
                </div>
                <h1 class="PDF-subtitle text-center text-decoration-underline text-uppercase m-2 p-2 fs-4">Closing the Interview</h1>
                <p> Use the information in this section to close the interview with the candidate. </p>
                <ul class="PDF-list px-5 mx-5">
                    <li> Ask the candidate: Are there questions about the company or this opportunity that I/we can answer for you? </li>
                    <li> Set expectation on next steps (additional interviews, timing of communications, etc.) </li>
                    <li> Thank the candidate for his/her time </li>
                </ul>
                <div class="with-page-break"></div>
                <div class="PDF-header-section"> <img height="24" src="<?php echo get_site_url(); ?>/wp-content/themes/spinco/images/rxo-logo.svg" class="custom-logo" alt="RXO | Massive capacity. Cutting-edge technology.">
                    <p class="text-center p-3">Interview Guide</p>
                </div>
                <h1 class="PDF-subtitle text-center text-decoration-underline text-uppercase m-2 p-2 fs-4">Final Interview Scoring Matrix</h1>
                <table class="PDF-table" nobr="true">
                    <tbody>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Candidate Name: </span></td>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Date of Interview: </span></td>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Candidate type: </span> <span id="display_candidate_type1"></span></td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Interviewer Name:</span></td>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Job location: </span> <span id="display_job_location1"></span></td>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Panel Interview: </span> <span id="display_panel_interview1"></span>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Job Title:</span> <span id="display_job_title1"></span></td>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Job function: </span> <span id="display_job_function1"></span></td>
                            <td class="PDF-cell PDF-userEntryCell align-top"><span class="fw-bold">Requisition: </span></td>
                        </tr>
                    </tbody>
                </table>
                <div id="ratingcontenthere"></div>
                <table class="PDF-table" nobr="true">
                    <thead>
                        <tr>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Interview Summary</h1>
                            </th>
                            <th class="PDF-cell PDF-cellHeader">
                                <h1 class="text-black text-center p-0 m-0 fs-4">Description</h1>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell PDF-cell--thin align-top">Strength</td>
                            <td class="PDF-cell PDF-userEntryCell">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="PDF-cell PDF-userEntryCell PDF-cell--thin align-top">Development Opportunities</td>
                            <td class="PDF-cell PDF-userEntryCell">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <p class="fw-bold"> You now must send the final page of this document to the Talent Acquisition contact (recruiter
                    and/or recruiting coordinator) in order for it to be stored in the recruiting tool. </p>
            </div>
        </div>
        <div id="block5" class="col-12 d-none text-center" style="min-height:400px;">
            <h3 class="mb-2">Thank you, your download will begin shortly</h3>
            <a href="/interview-questionnaire/" class="btn btn-link text-black mb-3">Create another guide</a>
            <p id="downloading">Downloading....</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        selectInputs = document.querySelectorAll('.spinco-block.interview-questions .js-choice');
        [].forEach.call(selectInputs, function(sEl, i) {
            let choices = new Choices(sEl, {
                allowHTML: true,
                placeholderValue: '',
                searchPlaceholderValue: 'Search',
            });
        });
    });
</script>