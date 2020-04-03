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
        $this->createEnglishLevel($cluster);
        $this->createEducation($cluster);
        $this->createBelief($cluster);
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
        $agreement = $cluster->posts()->create([
            'title' => 'Agreement',
            'redirect' => '/contents/Register-Info/Demographic-Information'
        ]);
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
        $demo = $cluster->posts()->create([
            'title' => 'Demographic Information',
            'redirect' => '/contents/Register-Info/English-Level-Information',
        ]);
        $demo->prerequisite = $demo->id - 1;
        $demo->save();
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

    public function createEnglishLevel($cluster)
    {
        $english = $cluster->posts()->create([
            'title' => 'English Level Information',
            'redirect' => '/contents/Register-Info/Educational-Information',
        ]);
        $english->prerequisite = $english->id - 1;
        $english->save();
        // Order
        $order = $english->modules()->create([
            'type' => 'select',
            'content' => '{"question":"Order in which your English was learned:","options":["Native","Second","Third","Forth"]}',
        ]);
        // Listening
        $listening = $english->modules()->create([
            'type' => 'select',
            'content' => '{"question":"Listening","options":["Almost none","Poor","Fair","Good","Very good"]}',
        ]);
        // speaking
        $speaking = $english->modules()->create([
            'type' => 'select',
            'content' => '{"question":"Speaking","options":["Almost none","Poor","Fair","Good","Very good"]}',
        ]);
        // reading
        $reading = $english->modules()->create([
            'type' => 'select',
            'content' => '{"question":"Reading","options":["Almost none","Poor","Fair","Good","Very good"]}',
        ]);
        // writing
        $writing = $english->modules()->create([
            'type' => 'select',
            'content' => '{"question":"Writing","options":["Almost none","Poor","Fair","Good","Very good"]}',
        ]);
    }

    public function createEducation($cluster)
    {
        $education = $cluster->posts()->create([
            'title' => 'Educational Information',
            'redirect' => '/contents/Register-Info/Belief-Information',
        ]);
        $education->prerequisite = $education->id - 1;
        $education->save();
        // Highest Education Degree Achieved
        $degree_get = $education->modules()->create([
            'type' => 'select',
            'content' => '{"question":"Highest Education Degree Achieved","options":["Less than a high school diploma","High school degree or equivalent","Some college, no degree","Associate degree","Bachelor\u2019s degree","Master\u2019s degree","Professional degree","Doctorate"]}',
        ]);
        // Currently Pursuing
        $degree_now = $education->modules()->create([
            'type' => 'select',
            'content' => '{"question":"Currently Pursuing","options":["Bachelor\'s degree","Master\'s degree","Professional degree","Doctorate","None"]}',
        ]);
        // Major
        $major = $education->modules()->create([
            'type' => 'select',
            'content' => json_encode([
                'question' => 'Major',
                'options' => $this->major_data,
            ]),
        ]);
        // Field of work
        $field = $education->modules()->create([
            'type' => 'select',
            'content' => json_encode([
                'question' => 'Field you are in or you want to be in',
                'options' => $this->industry_data,
            ]),
        ]);
        // parental education level
        $parental_level = $education->modules()->create([
            'type' => 'select',
            'content' => '{"question":"Highest Education Degree of Your Parents","options":["Less than a high school diploma","High school degree or equivalent","Some college, no degree","Associate degree","Bachelor\u2019s degree","Master\u2019s degree","Professional degree","Doctorate"]}',
        ]);
        // parental field
        $parental_field = $education->modules()->create([
            'type' => 'select',
            'content' => json_encode([
                'question' => 'The Field of Him/Her',
                'options' => $this->industry_data,
            ]),
        ]);
        // income
        $income = $education->modules()->create([
            'type' => 'select',
            'content' => '{"question":"Combined parental\/familial income per month before taxes in RMB","options":["less than 1,500","1,500-4,500","4,500-9,000","9,000-35,000","35,000-55,000","55,000-80,000","80,000 or more","I don\'t know"]}',
        ]);
    }

    public function createBelief($cluster)
    {
        $belief = $cluster->posts()->create([
            'title' => 'Belief Information',
            'redirect' => '/',
            'message' => 'You\'ve completed registration, welcome!',
        ]);
        $belief->prerequisite = $belief->id - 1;
        $belief->save();
        // religion
        $religion = $belief->modules()->create([
            'type' => 'select',
            'content' => '{"question":"Religious Affiliation","options":["Buddhist","Catholic Christianity","Hindu","Jewish","Mormon","Muslim","Non-believer (agnostic or atheist)","Protestant Christianity","Other"]}',
        ]);
        // Political
        $political = $belief->modules()->create([
            'type' => 'select',
            'content' => '{"question":"Political Orientation","options":["Very liberal","Somewhat liberal","Neither liberal nor conservative","Somewhat conservative","Very conservative"]}',
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

    /**
     * The majors data
     * @var array
     */
    protected $major_data =
    [
        "Accounting",
        "Aerospace Engineering",
        "Afroamerican and African Studies",
        "American Culture",
        "Anthropology",
        "Architecture",
        "Art and Design",
        "Asian Studies",
        "Astronomy and Astrophysics",
        "Athletic Training",
        "Biochemistry",
        "Biology",
        "Biomedical Engineering",
        "Biomolecular Science",
        "Biophysics",
        "Business",
        "Cell and Molecular Biology",
        "Chemical Engineering",
        "Chemistry",
        "Chinese Language and Literature",
        "Civil Engineering",
        "Classical Archaeology",
        "Classical Civilization",
        "Classical Languages and Literatures",
        "Cognitive Science",
        "Communications",
        "Comparative Literature",
        "Computer Engineering",
        "Computer Science",
        "Creative Writing and Literature",
        "Dance",
        "Data Science",
        "Drama",
        "Economics",
        "Electrical Engineering",
        "Elementary Teacher Education",
        "English Language and Literature",
        "Environmental Engineering",
        "Evolutionary Anthropology",
        "Film, Television, and Media",
        "Finance",
        "French and Francophone Studies",
        "Gender and Health",
        "German Language and Literature",
        "Greek (Ancient) Language and Literature",
        "Greek (Modern) Language and Culture",
        "History",
        "History of Art",
        "Industrial and Operations Engineering",
        "Informatics",
        "International Studies",
        "Italian",
        "Judaic Studies",
        "Latin American and Caribbean Studies",
        "Latin Language and Literature",
        "Latina/Latino Studies",
        "Linguistics",
        "Materials Science and Engineering",
        "Mathematics",
        "Mechanical Engineering",
        "Microbiology",
        "Middle East Studies",
        "Music",
        "Music Education",
        "Musical Theatre",
        "Musicology",
        "Naval Architecture and Marine Engineering",
        "Neuroscience",
        "Nuclear Engineering",
        "Nursing",
        "Pharmaceutical Sciences",
        "Philosophy",
        "Physics",
        "Polish",
        "Political Economy and Development",
        "Political Science",
        "Psychology",
        "Public Policy",
        "Romance Languages and Literatures",
        "Russian",
        "Screenwriting",
        "Secondary Teacher Education",
        "Sociology",
        "Spanish",
        "Sport Management",
        "Statistics",
        "Theatre Arts",
        "Theatre Design and Production",
        "Women’s Studies",
    ];

    /**
     * The industry data
     * @var array
     */
    protected $industry_data =
    [
        "Retired or Unemployed",
        "Agriculture, Forestry, Fishing and Hunting",
        "Agriculture, Forestry, Fishing and Hunting",
        "Mining",
        "Utilities",
        "Construction",
        "Computer and Electronics Manufacturing",
        "Other Manufacturing",
        "Wholesale",
        "Retail",
        "Transportation and Warehousing",
        "Publishing",
        "Software",
        "Telecommunications",
        "Broadcasting",
        "Information Services and Data Processing",
        "Other Information Industry",
        "Finance and Insurance",
        "Real Estate, Rental and Leasing",
        "College, University, and Adult Education",
        "Primary/Secondary (K-12) Education",
        "Other Education Industry",
        "Health Care and Social Assistance",
        "Arts, Entertainment, and Recreation",
        "Hotel and Food Services",
        "Government and Public Administration",
        "Legal Services	 Scientific or Technical Services",
        "Homemaker",
        "Military",
        "Religious",
        "Other",
        "I don't know"
    ];
}
