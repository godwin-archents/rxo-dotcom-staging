<?php

/**
 * Block Name: Email signature tool 
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// create id attribute for specific styling
$uid = 'spinco-acf-container-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'spinco-block spinco-block-' . str_replace('acf/spinco-acf-', '', $block['name']);

if (!empty($block['className'])) {
    $className .= sprintf(' %s', $block['className']);
}

if (!empty($block['align'])) {
    $className .= sprintf(' align%s', $block['align']);
}

?>

<div id="<?php echo $uid; ?>" class="<?php echo esc_attr($className); ?> js-rxo-signature-tool">
    <form action="" method="post">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div>
                    <h4>Enter your information</h4>
                    <p>
                        Please refer to the instructions before you begin.
                    </p>
                    <div class="my-3">
                        <a class="btn btn-primary" href="https://internal-tools.rxo.com/wp-content/uploads/sites/2/2022/09/RXO_Email_Signature_Guidelines.pdf" target="_blank" rel="noreferrer">
                            Download Here
                        </a>
                    </div>
                    <p>
                        If you need to correct any entries, make the changes and then
                        click Submit.
                    </p>
                    <div class="mb-3">
                        <label for="fname" class="form-label">Enter Your Name:</label>
                        <input type="text" class="form-control" id="fname">
                    </div>
                    <div class="mb-3">
                        <label for="division" class="form-label">Enter Your Department:</label>
                        <select class="form-select js-choice" id="division">
                            <option value="No Division">[No Division]</option>
                            <option value="Dedicated Transportation">Dedicated Transportation</option>
                            <option value="Expedite">Expedite</option>
                            <option value="Freight Brokerage">Freight Brokerage</option>
                            <option value="Freight Forwarding">Freight Forwarding</option>
                            <option value="Last Mile">Last Mile</option>
                            <option value="Managed Transportation">Managed Transportation</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Enter Your Title:</label>
                        <input type="text" class="form-control" id="title">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Enter Your Street Address:</label>
                        <p class="fs-7 mb-2">Format: 11215 North Community House Road</p>
                        <input type="text" class="form-control" id="address">
                    </div>
                    <div class="mb-3">
                        <label for="address2" class="form-label">Enter Your Street Address line 2:</label>
                        <input type="text" class="form-control" id="address2">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Enter Your City, State and Postal Code:</label>
                        <p class="fs-7 mb-2">Format for US and Canada: Charlotte, NC 28277</p>
                        <input type="text" class="form-control" id="city">
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Select Your Country:</label>
                        <select class="form-select js-choice" id="country">
                            <option value="USA">USA</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AX">Åland Islands</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AG">Antigua and Barbuda</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia, Plurinational State of</option>
                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                            <option value="BA">Bosnia and Herzegovina</option>
                            <option value="BW">Botswana</option>
                            <option value="BV">Bouvet Island</option>
                            <option value="BR">Brazil</option>
                            <option value="IO">British Indian Ocean Territory</option>
                            <option value="BN">Brunei Darussalam</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CA">Canada</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CX">Christmas Island</option>
                            <option value="CC">Cocos (Keeling) Islands</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CD">
                                Congo, the Democratic Republic of the
                            </option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Côte d'Ivoire</option>
                            <option value="HR">Croatia</option>
                            <option value="CU">Cuba</option>
                            <option value="CW">Curaçao</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands (Malvinas)</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="TF">French Southern Territories</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GP">Guadeloupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GG">Guernsey</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HM">
                                Heard Island and McDonald Islands
                            </option>
                            <option value="VA">Holy See (Vatican City State)</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran, Islamic Republic of</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IM">Isle of Man</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JE">Jersey</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">
                                Korea, Democratic People's Republic of
                            </option>
                            <option value="KR">Korea, Republic of</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Lao People's Democratic Republic</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macao</option>
                            <option value="MK">
                                Macedonia, the former Yugoslav Republic of
                            </option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="FM">Micronesia, Federated States of</option>
                            <option value="MD">Moldova, Republic of</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="ME">Montenegro</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NL">Netherlands</option>
                            <option value="NC">New Caledonia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Niger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NF">Norfolk Island</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PK">Pakistan</option>
                            <option value="PW">Palau</option>
                            <option value="PS">Palestinian Territory, Occupied</option>
                            <option value="PA">Panama</option>
                            <option value="PG">Papua New Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PN">Pitcairn</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RE">Réunion</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russian Federation</option>
                            <option value="RW">Rwanda</option>
                            <option value="BL">Saint Barthélemy</option>
                            <option value="SH">
                                Saint Helena, Ascension and Tristan da Cunha
                            </option>
                            <option value="KN">Saint Kitts and Nevis</option>
                            <option value="LC">Saint Lucia</option>
                            <option value="MF">Saint Martin (French part)</option>
                            <option value="PM">Saint Pierre and Miquelon</option>
                            <option value="VC">Saint Vincent and the Grenadines</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome and Principe</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="RS">Serbia</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SX">Sint Maarten (Dutch part)</option>
                            <option value="SK">Slovakia</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="GS">
                                South Georgia and the South Sandwich Islands
                            </option>
                            <option value="SS">South Sudan</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SJ">Svalbard and Jan Mayen</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
                            <option value="TW">Taiwan, Province of China</option>
                            <option value="TJ">Tajikistan</option>
                            <option value="TZ">Tanzania, United Republic of</option>
                            <option value="TH">Thailand</option>
                            <option value="TL">Timor-Leste</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad and Tobago</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="TM">Turkmenistan</option>
                            <option value="TC">Turks and Caicos Islands</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UG">Uganda</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">USA</option>
                            <option value="UM">
                                United States Minor Outlying Islands
                            </option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">
                                Venezuela, Bolivarian Republic of
                            </option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands, British</option>
                            <option value="VI">Virgin Islands, U.S.</option>
                            <option value="WF">Wallis and Futuna</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Enter Your Office Phone:</label>
                        <p class="fs-7 mb-2">Country code added automatically for US and Canada. Include country code elsewhere.</p>
                        <input type="text" class="form-control" id="phone">
                        <span id="phone_instructions" class="fs-7 d-none">Use this exact format in North America 800-123-4567.</span>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Enter Your Mobile Phone:</label>
                        <p class="fs-7 mb-2">Country code added automatically for US and Canada. Include country code elsewhere.</p>
                        <input type="text" class="form-control" id="mobile">
                        <span id="mobile_instructions" class="fs-7 d-none">Use this exact format in North America 800-123-4567.</span>
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="d-none" id="rightContent">
                    <h4>Copy your desktop email signature</h4>
                    <p>
                        Highlight the text and copy (Command+C mac, Ctrl+C win ) and
                        paste (Command+V mac, Ctrl+V win ) in your desktop email app
                        signature.
                    </p>
                    <p id="title_dash_warning" class="d-none">
                        Your title contains a '-'. All Title elements are always upper
                        and lowercase, except for certifications, which should have no
                        periods. Note that Title elements (position and department)
                        should be separated by commas or the word “and.”
                    </p>
                    <!-- Signature output -->
                    <div class="p-4 rounded-3">
                        <div id="desktop_signature"></div>
                    </div>
                    <button type="button" data-clipboard-action="copy" data-clipboard-target="#desktop_signature" class="btn btn-secondary btn-copy my-4">
                        Copy Output&nbsp;&nbsp;
                    </button>
                    <p>
                        If you need to correct an error in your signature, re-type the
                        correct information into the specific field and Re-Submit.
                    </p>
                    <h4>Outlook for mobile devices</h4>
                    <div class="bg-light p-4 rounded-3">
                        <pre id="desktop_html_signature" class="text-wrap"></pre>
                    </div>
                    <button type="button" data-clipboard-action="copy" data-clipboard-target="#desktop_html_signature" class="btn btn-secondary btn-copy my-4">
                        Copy HTML
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<style>
.invalid-feedback { display:block; }
</style>    
<script>
    function RxoSignatureTool(el) {

        var rxoSignForm;

        (function init() {
            rxoSignForm = el.querySelector('form');
            rxoSignForm.addEventListener('submit', formSubmit);
            selectInputs = el.querySelectorAll('.js-choice');
            [].forEach.call(selectInputs, function(sEl, i) {
                let choices = new Choices(sEl, {
                    allowHTML: true,
                });
            });
        })();


        function formSubmit(e) {
            e.preventDefault();
            buildSignature();
            new ClipboardJS('.btn-copy');
            location.href = "#";
            location.href = '#rightContent';
        }

        function buildSignature() {
            var emplNameVal = document.getElementById('fname').value;
            var divisionVal = document.getElementById('division').value;
            var titleVal = document.getElementById('title').value;
            var addressVal = document.getElementById('address').value;
            var address2Val = document.getElementById('address2').value;
            var cityVal = document.getElementById('city').value;
            var countryVal = document.getElementById('country').value;
            var phoneVal = document.getElementById('phone').value;
            var mobileVal = document.getElementById('mobile').value;

            const phoneInstructions = el.querySelector('#phone_instructions');
            const mobileInstructions = el.querySelector('#mobile_instructions');

            phoneInstructions.classList.add('d-none');
            phoneInstructions.classList.remove('invalid-feedback');
            mobileInstructions.classList.add('d-none');
            mobileInstructions.classList.remove('invalid-feedback');

            var phoneisvalid = true;

            if (countryVal === 'USA' || countryVal === 'CA') {
                if (phoneVal.length > 0) {
                    if (!isValidPhonenumber(phoneVal)) {
                        phoneInstructions.classList.add('invalid-feedback');
                        phoneInstructions.classList.remove('d-none');
                        document.getElementById('rightContent').classList.add('d-none');
                        phoneisvalid = false;
                    }
                    phoneVal = '+1 ' + phoneVal;
                }

                if (mobileVal.length > 0) {
                    if (!isValidPhonenumber(mobileVal)) {
                        mobileInstructions.classList.add('invalid-feedback');
                        mobileInstructions.classList.remove('d-none');
                        document.getElementById('rightContent').classList.add('d-none');
                        phoneisvalid = false;
                    }
                    mobileVal = '+1 ' + mobileVal;
                }
            }

            if (titleVal.indexOf('-') !== -1) {
                document.getElementById('title_dash_warning').classList.remove('d-none');
            } else {
                document.getElementById('title_dash_warning').classList.add('d-none');
            }

            var signature = '';

            signature += '<table cellpadding="0" cellspacing="0">';
            signature += '<tbody><tr>';
            signature += '<td style="width:600px;font-family:Arial,sans-serif;font-size:11px;color:#000001;line-height:13px;">';
            signature += '<b style="font-family:Arial,sans-serif;font-size:13px;">' + emplNameVal + '</b>';

            if (titleVal !== '' || divisionVal !== 'No Division') {
                signature += '<br>';
            }

            if (titleVal !== '') {
                signature += titleVal;
            }
            if (titleVal !== '' && divisionVal !== 'No Division') {
                signature += ', ';
            }
            if (divisionVal !== 'No Division') {
                signature += divisionVal;
            }

            signature += '<br><br>';
            signature += '<b style="font-family:Arial,sans-serif;font-size:16px;line-height:18px;">RXO</b>';

            if (addressVal !== '') {
                signature += '<br>' + addressVal;
            }

            if (address2Val !== '') {
                signature += '<br>' + address2Val;
            }

            if (cityVal !== '') {
                signature += '<br>' + cityVal + ' ' + countryVal;
            }

            if (phoneVal !== '') {
                signature += '<br>O: ' + phoneVal;
            }

            if (mobileVal !== '') {
                signature += '<br>M: ' + mobileVal;
            }

            signature += '</td>';
            signature += '</tbody></tr>';
            signature += '</table>';

            if (phoneisvalid) {
                document.getElementById('desktop_signature').innerHTML = signature;
                document.getElementById('desktop_html_signature').innerText = signature;
                document.getElementById('rightContent').classList.remove('d-none');
            }
        }


        function isValidPhonenumber(inputtxt) {
            var phoneno = /^\(?([0-9]{3})\)?-([0-9]{3})?-([0-9]{4})$/;

            if (inputtxt.match(phoneno)) {
                return true;
            } else {
                return false;
            }
        }
    }


    document.addEventListener('DOMContentLoaded', function() {
        const rxoSignToolEl = document.querySelector('.js-rxo-signature-tool');
        if (rxoSignToolEl !== null) {
            new RxoSignatureTool(rxoSignToolEl);
        }
    });
</script>