<?php

if (class_exists('WPForms_Template', false)) :
    /**
     * Newco Form template
     * Template for WPForms.
     */
    class WPForms_Template_newco_form_template extends WPForms_Template
    {

        /**
         * Primary class constructor.
         *
         * @since 1.0.0
         */
        public function init()
        {

            // Template name
            $this->name = 'Newco Form template';

            // Template slug
            $this->slug = 'newco_form_template';

            // Template description
            $this->description = 'This template contains dropdowns required for all Newco forms';

            // Template field and settings
            $this->data = array(
                'fields' => array(
                    1 => array(
                        'id' => '1',
                        'type' => 'select',
                        'label' => 'State',
                        'choices' => array(
                            5 => array(
                                'label' => 'Alaska',
                                'value' => 'AK',
                            ),
                            4 => array(
                                'label' => 'Alabama',
                                'value' => 'AL',
                            ),
                            7 => array(
                                'label' => 'Arkansas',
                                'value' => 'AR',
                            ),
                            6 => array(
                                'label' => 'Arizona',
                                'value' => 'AZ',
                            ),
                            8 => array(
                                'label' => 'California',
                                'value' => 'CA',
                            ),
                            9 => array(
                                'label' => 'Colorado',
                                'value' => 'CO',
                            ),
                            10 => array(
                                'label' => 'Connecticut',
                                'value' => 'CT',
                            ),
                            12 => array(
                                'label' => 'District of Columbia',
                                'value' => 'DC',
                            ),
                            11 => array(
                                'label' => 'Delaware',
                                'value' => 'DE',
                            ),
                            13 => array(
                                'label' => 'Florida',
                                'value' => 'FL',
                            ),
                            14 => array(
                                'label' => 'Georgia',
                                'value' => 'GA',
                            ),
                            15 => array(
                                'label' => 'Hawaii',
                                'value' => 'HI',
                            ),
                            19 => array(
                                'label' => 'Iowa',
                                'value' => 'IA',
                            ),
                            16 => array(
                                'label' => 'Idaho',
                                'value' => 'ID',
                            ),
                            17 => array(
                                'label' => 'Illinois',
                                'value' => 'IL',
                            ),
                            18 => array(
                                'label' => 'Indiana',
                                'value' => 'IN',
                            ),
                            20 => array(
                                'label' => 'Kansas',
                                'value' => 'KS',
                            ),
                            21 => array(
                                'label' => 'Kentucky',
                                'value' => 'KY',
                            ),
                            22 => array(
                                'label' => 'Louisiana',
                                'value' => 'LA',
                            ),
                            25 => array(
                                'label' => 'Massachusetts',
                                'value' => 'MA',
                            ),
                            24 => array(
                                'label' => 'Maryland',
                                'value' => 'MD',
                            ),
                            23 => array(
                                'label' => 'Maine',
                                'value' => 'ME',
                            ),
                            26 => array(
                                'label' => 'Michigan',
                                'value' => 'MI',
                            ),
                            27 => array(
                                'label' => 'Minnesota',
                                'value' => 'MN',
                            ),
                            29 => array(
                                'label' => 'Missouri',
                                'value' => 'MO',
                            ),
                            28 => array(
                                'label' => 'Mississippi',
                                'value' => 'MS',
                            ),
                            30 => array(
                                'label' => 'Montana',
                                'value' => 'MT',
                            ),
                            37 => array(
                                'label' => 'North Carolina',
                                'value' => 'NC',
                            ),
                            38 => array(
                                'label' => 'North Dakota',
                                'value' => 'ND',
                            ),
                            31 => array(
                                'label' => 'Nebraska',
                                'value' => 'NE',
                            ),
                            33 => array(
                                'label' => 'New Hampshire',
                                'value' => 'NH',
                            ),
                            34 => array(
                                'label' => 'New Jersey',
                                'value' => 'NJ',
                            ),
                            35 => array(
                                'label' => 'New Mexico',
                                'value' => 'NM',
                            ),
                            32 => array(
                                'label' => 'Nevada',
                                'value' => 'NV',
                            ),
                            36 => array(
                                'label' => 'New York',
                                'value' => 'NY',
                            ),
                            39 => array(
                                'label' => 'Ohio',
                                'value' => 'OH',
                            ),
                            40 => array(
                                'label' => 'Oklahoma',
                                'value' => 'OK',
                            ),
                            41 => array(
                                'label' => 'Oregon',
                                'value' => 'OR',
                            ),
                            42 => array(
                                'label' => 'Pennsylvania',
                                'value' => 'PA',
                            ),
                            55 => array(
                                'label' => 'Puerto Rico',
                                'value' => 'PR',
                            ),
                            43 => array(
                                'label' => 'Rhode Island',
                                'value' => 'RI',
                            ),
                            44 => array(
                                'label' => 'South Carolina',
                                'value' => 'SC',
                            ),
                            45 => array(
                                'label' => 'South Dakota',
                                'value' => 'SD',
                            ),
                            46 => array(
                                'label' => 'Tennessee',
                                'value' => 'TN',
                            ),
                            47 => array(
                                'label' => 'Texas',
                                'value' => 'TX',
                            ),
                            48 => array(
                                'label' => 'Utah',
                                'value' => 'UT',
                            ),
                            50 => array(
                                'label' => 'Virginia',
                                'value' => 'VA',
                            ),
                            49 => array(
                                'label' => 'Vermont',
                                'value' => 'VT',
                            ),
                            51 => array(
                                'label' => 'Washington',
                                'value' => 'WA',
                            ),
                            53 => array(
                                'label' => 'Wisconsin',
                                'value' => 'WI',
                            ),
                            52 => array(
                                'label' => 'West Virginia',
                                'value' => 'WV',
                            ),
                            54 => array(
                                'label' => 'Wyoming',
                                'value' => 'WY',
                            ),
                            56 => array(
                                'label' => 'Alberta',
                                'value' => 'AB',
                            ),
                            57 => array(
                                'label' => 'British Columbia',
                                'value' => 'BC',
                            ),
                            58 => array(
                                'label' => 'Manitoba',
                                'value' => 'MB',
                            ),
                            59 => array(
                                'label' => 'New Brunswick',
                                'value' => 'NB',
                            ),
                            60 => array(
                                'label' => 'Newfoundland',
                                'value' => 'NF',
                            ),
                            61 => array(
                                'label' => 'Northwest Territories',
                                'value' => 'NT',
                            ),
                            62 => array(
                                'label' => 'Nova Scotia',
                                'value' => 'NS',
                            ),
                            63 => array(
                                'label' => 'Nunavut',
                                'value' => 'NU',
                            ),
                            64 => array(
                                'label' => 'Ontario',
                                'value' => 'ON',
                            ),
                            65 => array(
                                'label' => 'Prince Edward Island',
                                'value' => 'PE',
                            ),
                            66 => array(
                                'label' => 'Quebec',
                                'value' => 'QC',
                            ),
                            67 => array(
                                'label' => 'Saskatchewan',
                                'value' => 'SK',
                            ),
                            68 => array(
                                'label' => 'Yukon Territory',
                                'value' => 'YT',
                            ),
                            69 => array(
                                'label' => 'Aguascalientes',
                                'value' => 'AGU',
                            ),
                            70 => array(
                                'label' => 'Baja California',
                                'value' => 'BCN',
                            ),
                            71 => array(
                                'label' => 'Baja California Sur',
                                'value' => 'BCS',
                            ),
                            72 => array(
                                'label' => 'Campeche',
                                'value' => 'CAM',
                            ),
                            73 => array(
                                'label' => 'Chiapas',
                                'value' => 'CHP',
                            ),
                            74 => array(
                                'label' => 'Chihuahua',
                                'value' => 'CHH',
                            ),
                            75 => array(
                                'label' => 'Ciudad de México',
                                'value' => 'CMX',
                            ),
                            76 => array(
                                'label' => 'Coahuila',
                                'value' => 'COA',
                            ),
                            77 => array(
                                'label' => 'Colima',
                                'value' => 'COL',
                            ),
                            78 => array(
                                'label' => 'Durango',
                                'value' => 'DUR',
                            ),
                            79 => array(
                                'label' => 'Estado de México',
                                'value' => 'MEX',
                            ),
                            80 => array(
                                'label' => 'Guanajuato',
                                'value' => 'GUA',
                            ),
                            81 => array(
                                'label' => 'Guerrero',
                                'value' => 'GRO',
                            ),
                            82 => array(
                                'label' => 'Hidalgo',
                                'value' => 'HID',
                            ),
                            83 => array(
                                'label' => 'Jalisco',
                                'value' => 'JAL',
                            ),
                            84 => array(
                                'label' => 'Michoacán\'',
                                'value' => 'MIC',
                            ),
                            85 => array(
                                'label' => 'Morelos',
                                'value' => 'MOR',
                            ),
                            86 => array(
                                'label' => 'Nayarit',
                                'value' => 'NAY',
                            ),
                            87 => array(
                                'label' => 'Nuevo León',
                                'value' => 'NLE',
                            ),
                            88 => array(
                                'label' => 'Oaxaca',
                                'value' => 'OAX',
                            ),
                            89 => array(
                                'label' => 'Puebla',
                                'value' => 'PUE',
                            ),
                            90 => array(
                                'label' => 'Querétaro',
                                'value' => 'QUE',
                            ),
                            91 => array(
                                'label' => 'Quintana Roo',
                                'value' => 'ROO',
                            ),
                            92 => array(
                                'label' => 'San Luis Potosí',
                                'value' => 'SLP',
                            ),
                            93 => array(
                                'label' => 'Sinaloa',
                                'value' => 'SIN',
                            ),
                            94 => array(
                                'label' => 'Sonora',
                                'value' => 'SON',
                            ),
                            95 => array(
                                'label' => 'Tabasco',
                                'value' => 'TAB',
                            ),
                            96 => array(
                                'label' => 'Tamaulipas',
                                'value' => 'TAM',
                            ),
                            97 => array(
                                'label' => 'Tlaxcala',
                                'value' => 'TLA',
                            ),
                            98 => array(
                                'label' => 'Veracruz',
                                'value' => 'VER',
                            ),
                            99 => array(
                                'label' => 'Yucatán',
                                'value' => 'YUC',
                            ),
                            100 => array(
                                'label' => 'Zacatecas',
                                'value' => 'ZAC',
                            ),
                        ),
                        'show_values' => '1',
                        'style' => 'modern',
                        'size' => 'medium',
                    ),
                    2 => array(
                        'id' => '2',
                        'type' => 'select',
                        'label' => 'Country',
                        'choices' => array(
                            4 => array(
                                'label' => 'Afghanistan',
                            ),
                            253 => array(
                                'label' => 'Åland Islands',
                            ),
                            5 => array(
                                'label' => 'Albania',
                            ),
                            6 => array(
                                'label' => 'Algeria',
                            ),
                            7 => array(
                                'label' => 'American Samoa',
                            ),
                            8 => array(
                                'label' => 'Andorra',
                            ),
                            9 => array(
                                'label' => 'Angola',
                            ),
                            10 => array(
                                'label' => 'Anguilla',
                            ),
                            11 => array(
                                'label' => 'Antarctica',
                            ),
                            12 => array(
                                'label' => 'Antigua and Barbuda',
                            ),
                            13 => array(
                                'label' => 'Argentina',
                            ),
                            14 => array(
                                'label' => 'Armenia',
                            ),
                            15 => array(
                                'label' => 'Aruba',
                            ),
                            254 => array(
                                'label' => 'Ascension Island',
                            ),
                            16 => array(
                                'label' => 'Australia',
                            ),
                            17 => array(
                                'label' => 'Austria',
                            ),
                            18 => array(
                                'label' => 'Azerbaijan',
                            ),
                            19 => array(
                                'label' => 'Bahamas',
                            ),
                            20 => array(
                                'label' => 'Bahrain',
                            ),
                            21 => array(
                                'label' => 'Bangladesh',
                            ),
                            22 => array(
                                'label' => 'Barbados',
                            ),
                            23 => array(
                                'label' => 'Belarus',
                            ),
                            24 => array(
                                'label' => 'Belgium',
                            ),
                            25 => array(
                                'label' => 'Belize',
                            ),
                            26 => array(
                                'label' => 'Benin',
                            ),
                            27 => array(
                                'label' => 'Bermuda',
                            ),
                            28 => array(
                                'label' => 'Bhutan',
                            ),
                            29 => array(
                                'label' => 'Bolivia',
                            ),
                            31 => array(
                                'label' => 'Bosnia and Herzegovina',
                            ),
                            32 => array(
                                'label' => 'Botswana',
                            ),
                            33 => array(
                                'label' => 'Bouvet Island',
                            ),
                            34 => array(
                                'label' => 'Brazil',
                            ),
                            35 => array(
                                'label' => 'British Indian Ocean Territory',
                            ),
                            255 => array(
                                'label' => 'British Virgin Islands',
                            ),
                            36 => array(
                                'label' => 'Brunei',
                            ),
                            37 => array(
                                'label' => 'Bulgaria',
                            ),
                            38 => array(
                                'label' => 'Burkina Faso',
                            ),
                            39 => array(
                                'label' => 'Burundi',
                            ),
                            40 => array(
                                'label' => 'Cabo Verde',
                            ),
                            41 => array(
                                'label' => 'Cambodia',
                            ),
                            42 => array(
                                'label' => 'Cameroon',
                            ),
                            43 => array(
                                'label' => 'Canada',
                            ),
                            256 => array(
                                'label' => 'Canary Islands',
                            ),
                            257 => array(
                                'label' => 'Cape Verde',
                            ),
                            258 => array(
                                'label' => 'Caribbean Netherlands',
                            ),
                            44 => array(
                                'label' => 'Cayman Islands',
                            ),
                            45 => array(
                                'label' => 'Central African Republic',
                            ),
                            259 => array(
                                'label' => 'Ceuta and Melilla',
                            ),
                            46 => array(
                                'label' => 'Chad',
                            ),
                            47 => array(
                                'label' => 'Chile',
                            ),
                            48 => array(
                                'label' => 'China',
                            ),
                            49 => array(
                                'label' => 'Christmas Island',
                            ),
                            260 => array(
                                'label' => 'Clipperton Island',
                            ),
                            50 => array(
                                'label' => 'Cocos (Keeling) Islands',
                            ),
                            51 => array(
                                'label' => 'Colombia',
                            ),
                            52 => array(
                                'label' => 'Comoros',
                            ),
                            53 => array(
                                'label' => 'Congo - Brazzaville',
                            ),
                            54 => array(
                                'label' => 'Congo - Kinshasa',
                            ),
                            55 => array(
                                'label' => 'Cook Islands',
                            ),
                            56 => array(
                                'label' => 'Costa Rica',
                            ),
                            57 => array(
                                'label' => 'Croatia',
                            ),
                            58 => array(
                                'label' => 'Cuba',
                            ),
                            59 => array(
                                'label' => 'Curaçao',
                            ),
                            60 => array(
                                'label' => 'Cyprus',
                            ),
                            61 => array(
                                'label' => 'Czech Republic',
                            ),
                            62 => array(
                                'label' => 'Côte d\'Ivoire',
                            ),
                            63 => array(
                                'label' => 'Denmark',
                            ),
                            261 => array(
                                'label' => 'Diego Garcia',
                            ),
                            64 => array(
                                'label' => 'Djibouti',
                            ),
                            65 => array(
                                'label' => 'Dominica',
                            ),
                            66 => array(
                                'label' => 'Dominican Republic',
                            ),
                            67 => array(
                                'label' => 'Ecuador',
                            ),
                            68 => array(
                                'label' => 'Egypt',
                            ),
                            69 => array(
                                'label' => 'El Salvador',
                            ),
                            70 => array(
                                'label' => 'Equatorial Guinea',
                            ),
                            71 => array(
                                'label' => 'Eritrea',
                            ),
                            72 => array(
                                'label' => 'Estonia',
                            ),
                            74 => array(
                                'label' => 'Ethiopia',
                            ),
                            75 => array(
                                'label' => 'Falkland Islands',
                            ),
                            76 => array(
                                'label' => 'Faroe Islands',
                            ),
                            77 => array(
                                'label' => 'Fiji',
                            ),
                            78 => array(
                                'label' => 'Finland',
                            ),
                            79 => array(
                                'label' => 'France',
                            ),
                            80 => array(
                                'label' => 'French Guiana',
                            ),
                            81 => array(
                                'label' => 'French Polynesia',
                            ),
                            82 => array(
                                'label' => 'French Southern Territories',
                            ),
                            83 => array(
                                'label' => 'Gabon',
                            ),
                            84 => array(
                                'label' => 'Gambia',
                            ),
                            85 => array(
                                'label' => 'Georgia',
                            ),
                            86 => array(
                                'label' => 'Germany',
                            ),
                            87 => array(
                                'label' => 'Ghana',
                            ),
                            88 => array(
                                'label' => 'Gibraltar',
                            ),
                            89 => array(
                                'label' => 'Greece',
                            ),
                            90 => array(
                                'label' => 'Greenland',
                            ),
                            91 => array(
                                'label' => 'Grenada',
                            ),
                            92 => array(
                                'label' => 'Guadeloupe',
                            ),
                            93 => array(
                                'label' => 'Guam',
                            ),
                            94 => array(
                                'label' => 'Guatemala',
                            ),
                            95 => array(
                                'label' => 'Guernsey',
                            ),
                            96 => array(
                                'label' => 'Guinea',
                            ),
                            97 => array(
                                'label' => 'Guinea-Bissau',
                            ),
                            98 => array(
                                'label' => 'Guyana',
                            ),
                            99 => array(
                                'label' => 'Haiti',
                            ),
                            100 => array(
                                'label' => 'Heard Island and McDonald Islands',
                            ),
                            101 => array(
                                'label' => 'Honduras',
                            ),
                            102 => array(
                                'label' => 'Hong Kong',
                            ),
                            103 => array(
                                'label' => 'Hungary',
                            ),
                            104 => array(
                                'label' => 'Iceland',
                            ),
                            105 => array(
                                'label' => 'India',
                            ),
                            106 => array(
                                'label' => 'Indonesia',
                            ),
                            107 => array(
                                'label' => 'Iran',
                            ),
                            108 => array(
                                'label' => 'Iraq',
                            ),
                            109 => array(
                                'label' => 'Ireland ',
                            ),
                            110 => array(
                                'label' => 'Isle of Man',
                            ),
                            111 => array(
                                'label' => 'Israel',
                            ),
                            112 => array(
                                'label' => 'Italy',
                            ),
                            113 => array(
                                'label' => 'Jamaica',
                            ),
                            114 => array(
                                'label' => 'Japan',
                            ),
                            115 => array(
                                'label' => 'Jersey',
                            ),
                            116 => array(
                                'label' => 'Jordan',
                            ),
                            117 => array(
                                'label' => 'Kazakhstan',
                            ),
                            118 => array(
                                'label' => 'Kenya',
                            ),
                            119 => array(
                                'label' => 'Kiribati',
                            ),
                            122 => array(
                                'label' => 'Kosovo',
                            ),
                            123 => array(
                                'label' => 'Kuwait',
                            ),
                            124 => array(
                                'label' => 'Kyrgyzstan',
                            ),
                            125 => array(
                                'label' => 'Laos',
                            ),
                            126 => array(
                                'label' => 'Latvia',
                            ),
                            127 => array(
                                'label' => 'Lebanon',
                            ),
                            128 => array(
                                'label' => 'Lesotho',
                            ),
                            129 => array(
                                'label' => 'Liberia',
                            ),
                            130 => array(
                                'label' => 'Libya',
                            ),
                            131 => array(
                                'label' => 'Liechtenstein',
                            ),
                            132 => array(
                                'label' => 'Lithuania',
                            ),
                            133 => array(
                                'label' => 'Luxembourg',
                            ),
                            134 => array(
                                'label' => 'Macau SAR China',
                            ),
                            262 => array(
                                'label' => 'Macedonia',
                            ),
                            135 => array(
                                'label' => 'Madagascar',
                            ),
                            136 => array(
                                'label' => 'Malawi',
                            ),
                            137 => array(
                                'label' => 'Malaysia',
                            ),
                            138 => array(
                                'label' => 'Maldives',
                            ),
                            139 => array(
                                'label' => 'Mali',
                            ),
                            140 => array(
                                'label' => 'Malta',
                            ),
                            141 => array(
                                'label' => 'Marshall Islands',
                            ),
                            142 => array(
                                'label' => 'Martinique',
                            ),
                            143 => array(
                                'label' => 'Mauritania',
                            ),
                            144 => array(
                                'label' => 'Mauritius',
                            ),
                            145 => array(
                                'label' => 'Mayotte',
                            ),
                            146 => array(
                                'label' => 'Mexico',
                            ),
                            147 => array(
                                'label' => 'Micronesia',
                            ),
                            148 => array(
                                'label' => 'Moldova',
                            ),
                            149 => array(
                                'label' => 'Monaco',
                            ),
                            150 => array(
                                'label' => 'Mongolia',
                            ),
                            151 => array(
                                'label' => 'Montenegro',
                            ),
                            152 => array(
                                'label' => 'Montserrat',
                            ),
                            153 => array(
                                'label' => 'Morocco',
                            ),
                            154 => array(
                                'label' => 'Mozambique',
                            ),
                            155 => array(
                                'label' => 'Myanmar [Burma]',
                            ),
                            156 => array(
                                'label' => 'Namibia',
                            ),
                            157 => array(
                                'label' => 'Nauru',
                            ),
                            158 => array(
                                'label' => 'Nepal',
                            ),
                            159 => array(
                                'label' => 'Netherlands',
                            ),
                            263 => array(
                                'label' => 'Netherlands Antilles',
                            ),
                            160 => array(
                                'label' => 'New Caledonia',
                            ),
                            161 => array(
                                'label' => 'New Zealand',
                            ),
                            162 => array(
                                'label' => 'Nicaragua',
                            ),
                            163 => array(
                                'label' => 'Niger',
                            ),
                            164 => array(
                                'label' => 'Nigeria',
                            ),
                            165 => array(
                                'label' => 'Niue',
                            ),
                            166 => array(
                                'label' => 'Norfolk Island',
                            ),
                            168 => array(
                                'label' => 'Northern Mariana Islands',
                            ),
                            264 => array(
                                'label' => 'North Korea',
                            ),
                            169 => array(
                                'label' => 'Norway',
                            ),
                            170 => array(
                                'label' => 'Oman',
                            ),
                            265 => array(
                                'label' => 'Outlying Oceania',
                            ),
                            171 => array(
                                'label' => 'Pakistan',
                            ),
                            172 => array(
                                'label' => 'Palau',
                            ),
                            173 => array(
                                'label' => 'Palestinian Territories',
                            ),
                            174 => array(
                                'label' => 'Panama',
                            ),
                            175 => array(
                                'label' => 'Papua New Guinea',
                            ),
                            176 => array(
                                'label' => 'Paraguay',
                            ),
                            177 => array(
                                'label' => 'Peru',
                            ),
                            178 => array(
                                'label' => 'Philippines',
                            ),
                            179 => array(
                                'label' => 'Pitcairn Islands',
                            ),
                            180 => array(
                                'label' => 'Poland',
                            ),
                            181 => array(
                                'label' => 'Portugal',
                            ),
                            182 => array(
                                'label' => 'Puerto Rico',
                            ),
                            183 => array(
                                'label' => 'Qatar',
                            ),
                            184 => array(
                                'label' => 'Romania',
                            ),
                            185 => array(
                                'label' => 'Russian Federation',
                            ),
                            186 => array(
                                'label' => 'Rwanda',
                            ),
                            187 => array(
                                'label' => 'Réunion',
                            ),
                            188 => array(
                                'label' => 'Saint Barthélemy',
                            ),
                            189 => array(
                                'label' => 'Saint Helena',
                            ),
                            190 => array(
                                'label' => 'Saint Kitts and Nevis',
                            ),
                            191 => array(
                                'label' => 'Saint Lucia',
                            ),
                            192 => array(
                                'label' => 'Saint Martin',
                            ),
                            193 => array(
                                'label' => 'Saint Pierre and Miquelon',
                            ),
                            194 => array(
                                'label' => 'Saint Vincent and the Grenadines',
                            ),
                            195 => array(
                                'label' => 'Samoa',
                            ),
                            196 => array(
                                'label' => 'San Marino',
                            ),
                            198 => array(
                                'label' => 'Saudi Arabia',
                            ),
                            199 => array(
                                'label' => 'Senegal',
                            ),
                            200 => array(
                                'label' => 'Serbia',
                            ),
                            201 => array(
                                'label' => 'Seychelles',
                            ),
                            202 => array(
                                'label' => 'Sierra Leone',
                            ),
                            203 => array(
                                'label' => 'Singapore',
                            ),
                            204 => array(
                                'label' => 'Sint Maarten',
                            ),
                            205 => array(
                                'label' => 'Slovakia',
                            ),
                            206 => array(
                                'label' => 'Slovenia',
                            ),
                            207 => array(
                                'label' => 'Solomon Islands',
                            ),
                            208 => array(
                                'label' => 'Somalia',
                            ),
                            209 => array(
                                'label' => 'South Africa',
                            ),
                            210 => array(
                                'label' => 'South Georgia and the South Sandwich Islands',
                            ),
                            266 => array(
                                'label' => 'South Korea',
                            ),
                            211 => array(
                                'label' => 'South Sudan',
                            ),
                            212 => array(
                                'label' => 'Spain',
                            ),
                            213 => array(
                                'label' => 'Sri Lanka',
                            ),
                            214 => array(
                                'label' => 'Sudan',
                            ),
                            215 => array(
                                'label' => 'Suriname',
                            ),
                            216 => array(
                                'label' => 'Svalbard and Jan Mayen',
                            ),
                            267 => array(
                                'label' => 'Swaziland',
                            ),
                            217 => array(
                                'label' => 'Sweden',
                            ),
                            218 => array(
                                'label' => 'Switzerland',
                            ),
                            219 => array(
                                'label' => 'Syrian',
                            ),
                            268 => array(
                                'label' => 'São Tomé and Príncipe',
                            ),
                            220 => array(
                                'label' => 'Taiwan',
                            ),
                            221 => array(
                                'label' => 'Tajikistan',
                            ),
                            222 => array(
                                'label' => 'Tanzania',
                            ),
                            223 => array(
                                'label' => 'Thailand',
                            ),
                            224 => array(
                                'label' => 'Timor-Leste',
                            ),
                            225 => array(
                                'label' => 'Togo',
                            ),
                            226 => array(
                                'label' => 'Tokelau',
                            ),
                            227 => array(
                                'label' => 'Tonga',
                            ),
                            228 => array(
                                'label' => 'Trinidad and Tobago',
                            ),
                            269 => array(
                                'label' => 'Tristan da Cunha',
                            ),
                            229 => array(
                                'label' => 'Tunisia',
                            ),
                            230 => array(
                                'label' => 'Turkey',
                            ),
                            231 => array(
                                'label' => 'Turkmenistan',
                            ),
                            232 => array(
                                'label' => 'Turks and Caicos Islands',
                            ),
                            233 => array(
                                'label' => 'Tuvalu',
                            ),
                            270 => array(
                                'label' => 'U.S. Outlying Islands',
                            ),
                            271 => array(
                                'label' => 'U.S. Virgin Islands',
                            ),
                            234 => array(
                                'label' => 'Uganda',
                            ),
                            235 => array(
                                'label' => 'Ukraine',
                            ),
                            236 => array(
                                'label' => 'United Arab Emirates',
                            ),
                            237 => array(
                                'label' => 'United Kingdom ',
                            ),
                            239 => array(
                                'label' => 'United States',
                            ),
                            240 => array(
                                'label' => 'Uruguay',
                            ),
                            241 => array(
                                'label' => 'Uzbekistan',
                            ),
                            242 => array(
                                'label' => 'Vanuatu',
                            ),
                            243 => array(
                                'label' => 'Vatican City',
                            ),
                            244 => array(
                                'label' => 'Venezuela',
                            ),
                            245 => array(
                                'label' => 'Vietnam',
                            ),
                            248 => array(
                                'label' => 'Wallis and Futuna',
                            ),
                            249 => array(
                                'label' => 'Western Sahara',
                            ),
                            250 => array(
                                'label' => 'Yemen',
                            ),
                            251 => array(
                                'label' => 'Zambia',
                            ),
                            252 => array(
                                'label' => 'Zimbabwe',
                            ),
                        ),
                        'style' => 'modern',
                        'size' => 'medium',
                    ),
                    3 => array(
                        'id' => '3',
                        'type' => 'select',
                        'label' => ' Dimension',
                        'choices' => array(
                            1 => array(
                                'label' => '-- Please select --',
                            ),
                            2 => array(
                                'label' => 'in',
                            ),
                            3 => array(
                                'label' => 'ft',
                            ),
                            4 => array(
                                'label' => 'cm',
                            ),
                            5 => array(
                                'label' => 'm',
                            ),
                        ),
                        'style' => 'modern',
                        'size' => 'medium',
                    ),
                    4 => array(
                        'id' => '4',
                        'type' => 'select',
                        'label' => 'Timezone',
                        'choices' => array(
                            1 => array(
                                'label' => '-- Please select --',
                            ),
                            2 => array(
                                'label' => 'Eastern',
                            ),
                            3 => array(
                                'label' => 'Central',
                            ),
                            4 => array(
                                'label' => 'Mountain',
                            ),
                            5 => array(
                                'label' => 'Pacific',
                            ),
                            6 => array(
                                'label' => 'UTC',
                            ),
                        ),
                        'style' => 'modern',
                        'size' => 'medium',
                    ),
                    5 => array(
                        'id' => '5',
                        'type' => 'select',
                        'label' => 'Url Target',
                        'choices' => array(
                            1 => array(
                                'label' => 'None ',
                            ),
                            2 => array(
                                'label' => 'New Window',
                                'value' => '_blank',
                            ),
                        ),
                        'show_values' => '1',
                        'style' => 'modern',
                        'size' => 'medium',
                    ),
                    6 => array(
                        'id' => '6',
                        'type' => 'select',
                        'label' => 'Weight',
                        'choices' => array(
                            4 => array(
                                'label' => '-- Please select --',
                            ),
                            1 => array(
                                'label' => 'lb',
                            ),
                            2 => array(
                                'label' => 'kg',
                            ),
                        ),
                        'style' => 'modern',
                        'size' => 'medium',
                    ),
                    7 => array(
                        'id' => '7',
                        'type' => 'select',
                        'label' => ' SPINCO Company',
                        'choices' => array(
                            1 => array(
                                'label' => 'Bounce Logistics, LLC',
                            ),
                            2 => array(
                                'label' => 'CTP Leasing, Inc.',
                            ),
                            3 => array(
                                'label' => 'Con-way Multimodal Inc.',
                            ),
                            4 => array(
                                'label' => 'Jacobson Transportation Company, Inc.',
                            ),
                            5 => array(
                                'label' => 'JHCI Holding USA, Inc. (f/k/a NDL Holding USA Inc.)',
                            ),
                            6 => array(
                                'label' => ' SPINCO CNW, Inc.',
                            ),
                            7 => array(
                                'label' => 'SPINCO Air Charter, LLC',
                            ),
                            8 => array(
                                'label' => 'SPINCO Logistics Cartage, LLC',
                            ),
                            9 => array(
                                'label' => 'SPINCO Courier, LLC',
                            ),
                            10 => array(
                                'label' => 'SPINCO Customs Clearance Solutions, LLC',
                            ),
                            11 => array(
                                'label' => 'SPINCO Dedicated, LLC',
                            ),
                            12 => array(
                                'label' => 'SPINCO Distribution Services, Inc.',
                            ),
                            13 => array(
                                'label' => 'SPINCO Logistics Drayage, LLC',
                            ),
                            14 => array(
                                'label' => 'SPINCO Enterprise Services, Inc.',
                            ),
                            15 => array(
                                'label' => 'SPINCO Logistics Express, LLC',
                            ),
                            16 => array(
                                'label' => 'SPINCO Global Forwarding Canada Inc.',
                            ),
                            17 => array(
                                'label' => 'SPINCO Global Forwarding, Inc.',
                            ),
                            18 => array(
                                'label' => 'SPINCO Intermodal, Inc.',
                            ),
                            19 => array(
                                'label' => 'SPINCO Intermodal Solutions, Inc.',
                            ),
                            20 => array(
                                'label' => 'SPINCO Last Mile, Inc.',
                            ),
                            21 => array(
                                'label' => 'SPINCO Last Mile Canada Inc.',
                            ),
                            22 => array(
                                'label' => 'SPINCO Logistics Canada Inc.',
                            ),
                            23 => array(
                                'label' => 'SPINCO Logistics Freight, Inc.',
                            ),
                            24 => array(
                                'label' => 'SPINCO Logistics Freight Canada Inc.',
                            ),
                            25 => array(
                                'label' => 'SPINCO Logistics, LLC',
                            ),
                            26 => array(
                                'label' => 'SPINCO Logistics, Inc.',
                            ),
                            27 => array(
                                'label' => 'SPINCO Logistics Manufacturing LLC',
                            ),
                            28 => array(
                                'label' => 'SPINCO Logistics NLM, LLC',
                            ),
                            29 => array(
                                'label' => 'SPINCO Logistics Supply Chain Holding Company (f/k/a New Breed Holding Company)',
                            ),
                            30 => array(
                                'label' => 'SPINCO Ocean World Lines, Inc.',
                            ),
                            31 => array(
                                'label' => 'SPINCO Logistics Port Services, LLC',
                            ),
                            32 => array(
                                'label' => 'SPINCO Servco, LLC',
                            ),
                            33 => array(
                                'label' => 'SPINCO Stacktrain, LLC',
                            ),
                        ),
                        'style' => 'modern',
                        'size' => 'medium',
                    ),
                    8 => array(
                        'id' => '8',
                        'type' => 'select',
                        'label' => 'Sector',
                        'choices' => array(
                            1 => array(
                                'label' => 'Automotive',
                            ),
                            2 => array(
                                'label' => 'Chemicals and Petrochemicals',
                            ),
                            3 => array(
                                'label' => 'Construction',
                            ),
                            4 => array(
                                'label' => 'E-commerce',
                            ),
                            5 => array(
                                'label' => 'FMCG no food',
                            ),
                            6 => array(
                                'label' => 'High-Tech',
                            ),
                            7 => array(
                                'label' => 'Household Equipment',
                            ),
                            8 => array(
                                'label' => 'Industrial',
                            ),
                            9 => array(
                                'label' => 'Retail',
                            ),
                            10 => array(
                                'label' => 'Specialist Retailers',
                            ),
                            11 => array(
                                'label' => 'Textiles and Luxury Goods',
                            ),
                            12 => array(
                                'label' => 'Pharmacy',
                            ),
                            13 => array(
                                'label' => 'Other',
                            ),
                        ),
                        'style' => 'modern',
                        'size' => 'medium',
                    ),
                ),
                'field_id' => 9,
                'settings' => array(
                    'form_title' => 'Newco Form template',
                    'form_desc' => 'This template contains dropdowns required for all Newco forms',
                    'submit_text' => 'Submit',
                    'submit_text_processing' => 'Sending...',
                    'antispam' => '1',
                    'recaptcha' => '1',
                    'ajax_submit' => '1',
                    'notification_enable' => '1',
                    'notifications' => array(
                        1 => array(
                            'notification_name' => 'Default Notification',
                            'email' => '{admin_email}',
                            'subject' => 'Thank you for your submission to [NewCo]',
                            'sender_name' => 'NewCo',
                            'sender_address' => 'ananth.sivagnanam@archents.com',
                            'message' => '{all_fields}',
                        ),
                    ),
                    'confirmations' => array(
                        1 => array(
                            'name' => 'Default Confirmation',
                            'type' => 'message',
                            'message' => '<p><span data-sheets-value="{&quot;1&quot;:2,&quot;2&quot;:&quot;Your request has been successfully submitted.&quot;}" data-sheets-userformat="{&quot;2&quot;:6145,&quot;3&quot;:{&quot;1&quot;:0,&quot;3&quot;:1},&quot;14&quot;:{&quot;1&quot;:3,&quot;3&quot;:1},&quot;15&quot;:&quot;Arial&quot;}">Your request has been successfully submitted.</span></p>',
                            'message_scroll' => '1',
                            'page' => '22',
                            'message_entry_preview_style' => 'basic',
                        ),
                    ),
                ),
                'meta' => array(
                    'template' => 'newco_form_template',
                ),
            );
        }
    }
    new WPForms_Template_newco_form_template();
endif;
