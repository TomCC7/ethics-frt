<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Content\Cluster;
use App\Content\Post;
use App\Content\Module;

class SeedRegistrationPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cluster = Cluster::Create(['name' => 'Register Info']);
        $this->createAgreement($cluster);
        $this->createDemographicInformation($cluster);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }

    /**
     * create the agreement post
     */
    protected function createAgreement($cluster)
    {
        $agreement = $cluster->posts()->create(['title' => 'Agreement']);
        // title part
        $title = $agreement->modules()->create([
            'type' => 'text',
            'content' => json_encode(['body' => '<h3 style="text-align: center;">Shanghai Jiao Tong University, University of Michigan-Shanghai Jiao Tong University Joint Institute</h3><h3 style="text-align: center;">CONSENT TO PARTICIPATE IN A RESEARCH STUDY/HAVE ANSWERS COLLECTED AND ANALYZED</h3><h3 style="text-align: center;">Principal Investigator: Rockwell F. Clancy</h3>'])
        ]);
        // description part
        $description = $agreement->modules()->create([
            'type' => 'text',
            'content' => '{"body":"<p><b>Confidentiality <\/b>:<b> <\/b>Please answer as honestly and thoroughly as possible. No specific answers or identifying information will be disclosed publicly.<\/p><p><b>Purpose<\/b>: To better understand the nature of and views about morality and topics related to applied ethics.<\/p><p><b>Procedures<\/b>:<b> <\/b>If you consent to participate, you can read a variety of materials and answers questions about them.<\/p><p><b>Potential Risks or Discomforts<\/b>: There should not be any risks or discomforts. You will be asked to honestly and thoughtfully answer questions about yourself, knowledge, and views.<\/p><p><b>Potential Benefits<\/b>: Better understand topics related to applied ethics, your own views of morality, as well as those of others<\/p><p><b>Questions, Comments, or Concerns<\/b>: If you have any questions, comments, or concerns about the research, you can contact Rockwell F. Clancy via email: rockwell.clancy@sjtu.edu.cn<\/p>"}',
        ]);
        // consent 1
        $consent1 = $agreement->modules()->create([
            'type' => 'choice',
            'content' => '{"question":"Consent for modules:","choices":["I consent to participate in the modules with information saved and used for research purposes","I consent to participate in the modules with information saved but not used for research purposes"],"is_multiple":"0"}',
        ]);
        // consent 2
        $consent2 = $agreement->modules()->create([
            'type' => 'choice',
            'content' => '{"question":"Consent for surveys:","choices":["I consent to participate in the surveys with information saved and used for research purposes","I don\'t want to take surveys"],"is_multiple":"0"}',
        ]);
    }

    protected function createDemographicInformation($cluster)
    {
        $demo = $cluster->posts()->create(['title' => 'Demographic Information']);
        // user_type
        $user_type = $demo->modules()->create([
            'type' => 'choice',
            'content' =>  '{"question":"User Type","choices":["student","non-student"],"is_multiple":"0"}',
        ]);
        // ages
        $age_span = [];
        for ($i = 18; $i < 100; $i++) {
            $age_span[] = $i;
        }
        $ages = $demo->modules()->create([
            'type' => 'select',
            'content' => json_encode([
                'question' => 'Ages',
                'options' => $age_span,
            ]),
        ]);
        // Gender
        $gender = $demo->modules()->create([
            'type' => 'choice',
            'content' => '{"question":"Gender","choices":["male","female","other"],"is_multiple":"0"}',
        ]);
        // Nationality
        $nationality = $demo->modules()->create([
            'type' => 'select',
            'content' => json_encode([
                'question' => 'Nationality',
                'options' => $this->nationality_data,
            ]),
        ]);
        // Identification
        $identification = $demo->modules()->create([
            'type' => 'select',
            'content' => '{"question":"How do you identify?","options":["Asian","Black","Hispanic","White","Other"]}',
        ]);
    }

    /**
     * the nationality data
     * @var array
     */
    protected $nationality_data =
            [
                "United States",
                "China",
                "Afghanistan",
                "Albania",
                "Algeria",
                "Andorra",
                "Angola",
                "Antigua and Barbuda",
                "Argentina",
                "Armenia",
                "Australia",
                "Austria",
                "Azerbaijan",
                "Bahamas",
                "Bahrain",
                "Bangladesh",
                "Barbados",
                "Belarus",
                "Belgium",
                "Belize",
                "Benin",
                "Bhutan",
                "Bolivia",
                "Bosnia and Herzegovina",
                "Botswana",
                "Brazil",
                "Brunei",
                "Bulgaria",
                "Burkina Faso",
                "Burundi",
                "Cabo Verde",
                "Cambodia",
                "Cameroon",
                "Canada",
                "Central African Republic (CAR)",
                "Chad",
                "Chile",
                "Colombia",
                "Comoros",
                "Democratic Republic of the Congo",
                "Republic of the Congo",
                "Costa Rica",
                "Cote dIvoire",
                "Croatia",
                "Cuba",
                "Cyprus",
                "Czech Republic",
                "Denmark",
                "Djibouti",
                "Dominica",
                "Dominican Republic",
                "Ecuador",
                "Egypt",
                "El Salvador",
                "Equatorial Guinea",
                "Eritrea",
                "Estonia",
                "Eswatini",
                "Ethiopia",
                "Fiji",
                "Finland",
                "France",
                "Gabon",
                "Gambia",
                "Georgia",
                "Germany",
                "Ghana",
                "Greece",
                "Grenada",
                "Guatemala",
                "Guinea",
                "Guinea-Bissau",
                "Guyana",
                "Haiti",
                "Honduras",
                "Hungary",
                "Iceland",
                "India",
                "Indonesia",
                "Iran",
                "Iraq",
                "Ireland",
                "Israel",
                "Italy",
                "Jamaica",
                "Japan",
                "Jordan",
                "Kazakhstan",
                "Kenya",
                "Kiribati",
                "Kosovo",
                "Kuwait",
                "Kyrgyzstan",
                "Laos",
                "Latvia",
                "Lebanon",
                "Lesotho",
                "Liberia",
                "Libya",
                "Liechtenstein",
                "Lithuania",
                "Luxembourg",
                "Macedonia",
                "Madagascar",
                "Malawi",
                "Malaysia",
                "Maldives",
                "Mali",
                "Malta",
                "Marshall Islands",
                "Mauritania",
                "Mauritius",
                "Mexico",
                "Micronesia",
                "Moldova",
                "Monaco",
                "Mongolia",
                "Montenegro",
                "Morocco",
                "Mozambique",
                "Myanmar",
                "Namibia",
                "Nauru",
                "Nepal",
                "Netherlands",
                "New Zealand",
                "Nicaragua",
                "Niger",
                "Nigeria",
                "North Korea",
                "Norway",
                "Oman",
                "Pakistan",
                "Palau",
                "Palestine",
                "Panama",
                "Papua New Guinea",
                "Paraguay",
                "Peru",
                "Philippines",
                "Poland",
                "Portugal",
                "Qatar",
                "Romania",
                "Russia",
                "Rwanda",
                "Saint Kitts and Nevis",
                "Saint Lucia",
                "Saint Vincent and the Grenadines",
                "Samoa",
                "San Marino",
                "Sao Tome and Principe",
                "Saudi Arabia",
                "Senegal",
                "Serbia",
                "Seychelles",
                "Sierra Leone",
                "Singapore",
                "Slovakia",
                "Slovenia",
                "Solomon Islands",
                "Somalia",
                "South Africa",
                "South Korea",
                "South Sudan",
                "Spain",
                "Sri Lanka",
                "Sudan",
                "Suriname",
                "Sweden",
                "Switzerland",
                "Syria",
                "Tajikistan",
                "Tanzania",
                "Thailand",
                "Timor-Leste",
                "Togo",
                "Tonga",
                "Trinidad and Tobago",
                "Tunisia",
                "Turkey",
                "Turkmenistan",
                "Tuvalu",
                "Uganda",
                "Ukraine",
                "United Arab Emirates (UAE)",
                "United Kingdom (UK)",
                "Uruguay",
                "Uzbekistan",
                "Vanuatu",
                "Venezuela",
                "Vietnam",
                "Yemen",
                "Zambia",
                "Zimbabwe",
            ];
}
