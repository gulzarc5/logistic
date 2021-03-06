<?php

use Illuminate\Database\Seeder;
use App\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line('Truncating City Table');
        City::truncate();

        $city = [
                '1'=>[
                    'Adilabad',
                    'Anantapur',
                    'Chittoor',
                    'Kakinada',
                    'Guntur',
                    'Hyderabad',
                    'Karimnagar',
                    'Khammam',
                    'Krishna',
                    'Kurnool',
                    'Mahbubnagar',
                    'Medak',
                    'Nalgonda',
                    'Nizamabad',
                    'Ongole',
                    'Hyderabad',
                    'Srikakulam',
                    'Nellore',
                    'Visakhapatnam',
                    'Vizianagaram',
                    'Warangal',
                    'Eluru',
                    'Kadapa',
                ],
                '2'=>[
                            'Anjaw',
                            'Changlang',
                            'East Siang',
                            'Kurung Kumey',
                            'Lohit',
                            'Lower Dibang Valley',
                            'Lower Subansiri',
                            'Papum Pare',
                            'Tawang',
                            'Tirap',
                            'Dibang Valley',
                            'Upper Siang',
                            'Upper Subansiri',
                            'West Kameng',
                            'West Siang',
                    ],
                '3'=>[
                            'Baksa',
                            'Barpeta',
                            'Bongaigaon',
                            'Cachar',
                            'Chirang',
                            'Darrang',
                            'Dhemaji',
                            'Dima Hasao',
                            'Dhubri',
                            'Dibrugarh',
                            'Goalpara',
                            'Golaghat',
                            'Hailakandi',
                            'Jorhat',
                            'Kamrup',
                            'Kamrup Metropolitan',
                            'Karbi Anglong',
                            'Karimganj',
                            'Kokrajhar',
                            'Lakhimpur',
                            'Marigaon',
                            'Nagaon',
                            'Nalbari',
                            'Sibsagar',
                            'Sonitpur',
                            'Tinsukia',
                            'Udalguri',
                    ],
                '4'=>[
                            'Araria',
                            'Arwal',
                            'Aurangabad',
                            'Banka',
                            'Begusarai',
                            'Bhagalpur',
                            'Bhojpur',
                            'Buxar',
                            'Darbhanga',
                            'East Champaran',
                            'Gaya',
                            'Gopalganj',
                            'Jamui',
                            'Jehanabad',
                            'Kaimur',
                            'Katihar',
                            'Khagaria',
                            'Kishanganj',
                            'Lakhisarai',
                            'Madhepura',
                            'Madhubani',
                            'Munger',
                            'Muzaffarpur',
                            'Nalanda',
                            'Nawada',
                            'Patna',
                            'Purnia',
                            'Rohtas',
                            'Saharsa',
                            'Samastipur',
                            'Saran',
                            'Sheikhpura',
                            'Sheohar',
                            'Sitamarhi',
                            'Siwan',
                            'Supaul',
                            'Vaishali',
                            'West Champaran',
                            'Chandigarh',
                    ],
                '5'=>[
                            'Bastar',
                            'Bijapur',
                            'Bilaspur',
                            'Dantewada',
                            'Dhamtari',
                            'Durg',
                            'Jashpur',
                            'Janjgir-Champa',
                            'Korba',
                            'Koriya',
                            'Kanker',
                            'Kabirdham (Kawardha)',
                            'Mahasamund',
                            'Narayanpur',
                            'Raigarh',
                            'Rajnandgaon',
                            'Raipur',
                            'Surguja',
                    ],
                '31'=>[
                            'Dadra and Nagar Haveli'
                ],
                '32'=>[
                            'Daman',
                            'Diu',
                ],
                '33'=>[
                            'Central Delhi',
                            'East Delhi',
                            'New Delhi',
                            'North Delhi',
                            'North East Delhi',
                            'North West Delhi',
                            'South Delhi',
                            'South West Delhi',
                            'West Delhi',
                ],
                '6'=>[
                            'North Goa',
                            'South Goa'
                ],
                '7'=>[
                            'Ahmedabad',
                            'Amreli district',
                            'Anand',
                            'Banaskantha',
                            'Bharuch',
                            'Bhavnagar',
                            'Dahod',
                            'The Dangs',
                            'Gandhinagar',
                            'Jamnagar',
                            'Junagadh',
                            'Kutch',
                            'Kheda',
                            'Mehsana',
                            'Narmada',
                            'Navsari',
                            'Patan',
                            'Panchmahal',
                            'Porbandar',
                            'Rajkot',
                            'Sabarkantha',
                            'Surendranagar',
                            'Surat',
                            'Vyara',
                            'Vadodara',
                            'Valsad',
                ],
                '8'=>[
                            'Ambala',
                            'Bhiwani',
                            'Faridabad',
                            'Fatehabad',
                            'Gurgaon',
                            'Hissar',
                            'Jhajjar',
                            'Jind',
                            'Karnal',
                            'Kaithal',
                            'Kurukshetra',
                            'Mahendragarh',
                            'Mewat',
                            'Palwal',
                            'Panchkula',
                            'Panipat',
                            'Rewari',
                            'Rohtak',
                            'Sirsa',
                            'Sonipat',
                            'Yamuna Nagar',
                    ],
                '9'=>[
                            'Bilaspur',
                            'Chamba',
                            'Hamirpur',
                            'Kangra',
                            'Kinnaur',
                            'Kullu',
                            'Lahaul and Spiti',
                            'Mandi',
                            'Shimla',
                            'Sirmaur',
                            'Solan',
                            'Una',
                    ],
                '10'=>[
                            'Anantnag',
                            'Badgam',
                            'Bandipora',
                            'Baramulla',
                            'Doda',
                            'Ganderbal',
                            'Jammu',
                            'Kargil',
                            'Kathua',
                            'Kishtwar',
                            'Kupwara',
                            'Kulgam',
                            'Leh',
                            'Poonch',
                            'Pulwama',
                            'Rajauri',
                            'Ramban',
                            'Reasi',
                            'Samba',
                            'Shopian',
                            'Srinagar',
                            'Udhampur',
                    ],
                '11'=>[
                            'Bokaro',
                            'Chatra',
                            'Deoghar',
                            'Dhanbad',
                            'Dumka',
                            'East Singhbhum',
                            'Garhwa',
                            'Giridih',
                            'Godda',
                            'Gumla',
                            'Hazaribag',
                            'Jamtara',
                            'Khunti',
                            'Koderma',
                            'Latehar',
                            'Lohardaga',
                            'Pakur',
                            'Palamu',
                            'Ramgarh',
                            'Ranchi',
                            'Sahibganj',
                            'Seraikela Kharsawan',
                            'Simdega',
                            'West Singhbhum',
                    ],
                '12'=>[
                            'Bagalkot',
                            'Bangalore Rural',
                            'Bangalore Urban',
                            'Belgaum',
                            'Bellary',
                            'Bidar',
                            'Bijapur',
                            'Chamarajnagar',
                            'Chikkamagaluru',
                            'Chikkaballapur',
                            'Chitradurga',
                            'Davanagere',
                            'Dharwad',
                            'Dakshina Kannada',
                            'Gadag',
                            'Gulbarga',
                            'Hassan',
                            'Haveri district',
                            'Kodagu',
                            'Kolar',
                            'Koppal',
                            'Mandya',
                            'Mysore',
                            'Raichur',
                            'Shimoga',
                            'Tumkur',
                            'Udupi',
                            'Uttara Kannada',
                            'Ramanagara',
                            'Yadgir',
                    ],
                '13'=>[
                            'Alappuzha',
                            'Ernakulam',
                            'Idukki',
                            'Kannur',
                            'Kasaragod',
                            'Kollam',
                            'Kottayam',
                            'Kozhikode',
                            'Malappuram',
                            'Palakkad',
                            'Pathanamthitta',
                            'Thrissur',
                            'Thiruvananthapuram',
                            'Wayanad',
                    ],
                '14'=>[
                            'Alirajpur',
                            'Anuppur',
                            'Ashok Nagar',
                            'Balaghat',
                            'Barwani',
                            'Betul',
                            'Bhind',
                            'Bhopal',
                            'Burhanpur',
                            'Chhatarpur',
                            'Chhindwara',
                            'Damoh',
                            'Datia',
                            'Dewas',
                            'Dhar',
                            'Dindori',
                            'Guna',
                            'Gwalior',
                            'Harda',
                            'Hoshangabad',
                            'Indore',
                            'Jabalpur',
                            'Jhabua',
                            'Katni',
                            'Khandwa (East Nimar)',
                            'Khargone (West Nimar)',
                            'Mandla',
                            'Mandsaur',
                            'Morena',
                            'Narsinghpur',
                            'Neemuch',
                            'Panna',
                            'Rewa',
                            'Rajgarh',
                            'Ratlam',
                            'Raisen',
                            'Sagar',
                            'Satna',
                            'Sehore',
                            'Seoni',
                            'Shahdol',
                            'Shajapur',
                            'Sheopur',
                            'Shivpuri',
                            'Sidhi',
                            'Singrauli',
                            'Tikamgarh',
                            'Ujjain',
                            'Umaria',
                            'Vidisha',
                    ],
                '15'=>[
                            'Ahmednagar',
                            'Akola',
                            'Amravati',
                            'Aurangabad',
                            'Bhandara',
                            'Beed',
                            'Buldhana',
                            'Chandrapur',
                            'Dhule',
                            'Gadchiroli',
                            'Gondia',
                            'Hingoli',
                            'Jalgaon',
                            'Jalna',
                            'Kolhapur',
                            'Latur',
                            'Mumbai City',
                            'Mumbai suburban',
                            'Nandurbar',
                            'Nanded',
                            'Nagpur',
                            'Nashik',
                            'Osmanabad',
                            'Parbhani',
                            'Pune',
                            'Raigad',
                            'Ratnagiri',
                            'Sindhudurg',
                            'Sangli',
                            'Solapur',
                            'Satara',
                            'Thane',
                            'Wardha',
                            'Washim',
                            'Yavatmal',
                        ],
                '16'=>[
                            'Bishnupur',
                            'Churachandpur',
                            'Chandel',
                            'Imphal East',
                            'Senapati',
                            'Tamenglong',
                            'Thoubal',
                            'Ukhrul',
                            'Imphal West',
                    ],
                '17'=>[
                            'East Garo Hills',
                            'East Khasi Hills',
                            'Jaintia Hills',
                            'Ri Bhoi',
                            'South Garo Hills',
                            'West Garo Hills',
                            'West Khasi Hills',
                    ],
                '18'=>[
                            'Aizawl',
                            'Champhai',
                            'Kolasib',
                            'Lawngtlai',
                            'Lunglei',
                            'Mamit',
                            'Saiha',
                            'Serchhip',
                    ],
                '19'=>[
                            'Dimapur',
                            'Kohima',
                            'Mokokchung',
                            'Mon',
                            'Phek',
                            'Tuensang',
                            'Wokha',
                            'Zunheboto',
                    ],
                '20'=>[
                            'Angul',
                            'Boudh (Bauda)',
                            'Bhadrak',
                            'Balangir',
                            'Bargarh (Baragarh)',
                            'Balasore',
                            'Cuttack',
                            'Debagarh (Deogarh)',
                            'Dhenkanal',
                            'Ganjam',
                            'Gajapati',
                            'Jharsuguda',
                            'Jajpur',
                            'Jagatsinghpur',
                            'Khordha',
                            'Kendujhar (Keonjhar)',
                            'Kalahandi',
                            'Kandhamal',
                            'Koraput',
                            'Kendrapara',
                            'Malkangiri',
                            'Mayurbhanj',
                            'Nabarangpur',
                            'Nuapada',
                            'Nayagarh',
                            'Puri',
                            'Rayagada',
                            'Sambalpur',
                            'Subarnapur (Sonepur)',
                            'Sundergarh',
                        ],
                '35'=>[
                            'Karaikal',
                            'Mahe',
                            'Pondicherry',
                            'Yanam',
                ],
                '21'=>[
                            'Amritsar',
                            'Barnala',
                            'Bathinda',
                            'Firozpur',
                            'Faridkot',
                            'Fatehgarh Sahib',
                            'Fazilka',
                            'Gurdaspur',
                            'Hoshiarpur',
                            'Jalandhar',
                            'Kapurthala',
                            'Ludhiana',
                            'Mansa',
                            'Moga',
                            'Sri Muktsar Sahib',
                            'Pathankot',
                            'Patiala',
                            'Rupnagar',
                            'Ajitgarh (Mohali)',
                            'Sangrur',
                            'Nawanshahr',
                            'Tarn Taran',
                    ],
                '22'=>[
                            'Ajmer',
                            'Alwar',
                            'Bikaner',
                            'Barmer',
                            'Banswara',
                            'Bharatpur',
                            'Baran',
                            'Bundi',
                            'Bhilwara',
                            'Churu',
                            'Chittorgarh',
                            'Dausa',
                            'Dholpur',
                            'Dungapur',
                            'Ganganagar',
                            'Hanumangarh',
                            'Jhunjhunu',
                            'Jalore',
                            'Jodhpur',
                            'Jaipur',
                            'Jaisalmer',
                            'Jhalawar',
                            'Karauli',
                            'Kota',
                            'Nagaur',
                            'Pali',
                            'Pratapgarh',
                            'Rajsamand',
                            'Sikar',
                            'Sawai Madhopur',
                            'Sirohi',
                            'Tonk',
                            'Udaipur',
                    ],
                '23'=>[
                            'East Sikkim',
                            'North Sikkim',
                            'South Sikkim',
                            'West Sikkim',
                    ],
                '24'=>[
                            'Ariyalur',
                            'Chennai',
                            'Coimbatore',
                            'Cuddalore',
                            'Dharmapuri',
                            'Dindigul',
                            'Erode',
                            'Kanchipuram',
                            'Kanyakumari',
                            'Karur',
                            'Madurai',
                            'Nagapattinam',
                            'Nilgiris',
                            'Namakkal',
                            'Perambalur',
                            'Pudukkottai',
                            'Ramanathapuram',
                            'Salem',
                            'Sivaganga',
                            'Tirupur',
                            'Tiruchirappalli',
                            'Theni',
                            'Tirunelveli',
                            'Thanjavur',
                            'Thoothukudi',
                            'Tiruvallur',
                            'Tiruvarur',
                            'Tiruvannamalai',
                            'Vellore',
                            'Viluppuram',
                            'Virudhunagar',
                    ],
                '25'=>[
                            'Dhalai',
                            'North Tripura',
                            'South Tripura',
                            'Khowai',
                            'West Tripura',
                    ],
                '26'=>[
                            'Agra',
                            'Allahabad',
                            'Aligarh',
                            'Ambedkar Nagar',
                            'Auraiya',
                            'Azamgarh',
                            'Barabanki',
                            'Budaun',
                            'Bagpat',
                            'Bahraich',
                            'Bijnor',
                            'Ballia',
                            'Banda',
                            'Balrampur',
                            'Bareilly',
                            'Basti',
                            'Bulandshahr',
                            'Chandauli',
                            'Chhatrapati Shahuji Maharaj Nagar',
                            'Chitrakoot',
                            'Deoria',
                            'Etah',
                            'Kanshi Ram Nagar',
                            'Etawah',
                            'Firozabad',
                            'Farrukhabad',
                            'Fatehpur',
                            'Faizabad',
                            'Gautam Buddh Nagar',
                            'Gonda',
                            'Ghazipur',
                            'Gorakhpur',
                            'Ghaziabad',
                            'Hamirpur',
                            'Hardoi',
                            'Mahamaya Nagar',
                            'Jhansi',
                            'Jalaun',
                            'Jyotiba Phule Nagar',
                            'Jaunpur district',
                            'Ramabai Nagar (Kanpur Dehat)',
                            'Kannauj',
                            'Kanpur',
                            'Kaushambi',
                            'Kushinagar',
                            'Lalitpur',
                            'Lakhimpur Kheri',
                            'Lucknow',
                            'Mau',
                            'Meerut',
                            'Maharajganj',
                            'Mahoba',
                            'Mirzapur',
                            'Moradabad',
                            'Mainpuri',
                            'Mathura',
                            'Muzaffarnagar',
                            'Panchsheel Nagar district (Hapur)',
                            'Pilibhit',
                            'Shamli',
                            'Pratapgarh',
                            'Rampur',
                            'Raebareli',
                            'Saharanpur',
                            'Sitapur',
                            'Shahjahanpur',
                            'Sant Kabir Nagar',
                            'Siddharthnagar',
                            'Sonbhadra',
                            'Sant Ravidas Nagar',
                            'Sultanpur',
                            'Shravasti',
                            'Unnao',
                            'Varanasi',
                    ],
                '27'=>[
                            'Almora',
                            'Bageshwar',
                            'Chamoli',
                            'Champawat',
                            'Dehradun',
                            'Haridwar',
                            'Nainital',
                            'Pauri Garhwal',
                            'Pithoragarh',
                            'Rudraprayag',
                            'Tehri Garhwal',
                            'Udham Singh Nagar',
                            'Uttarkashi',
                    ],
                '28'=>[
                    'Birbhum',
                    'Bankura',
                    'Bardhaman',
                    'Darjeeling',
                    'Dakshin Dinajpur',
                    'Hooghly',
                    'Howrah',
                    'Jalpaiguri',
                    'Cooch Behar',
                    'Kolkata',
                    'Maldah',
                    'Paschim Medinipur',
                    'Purba Medinipur',
                    'Murshidabad',
                    'Nadia',
                    'North 24 Parganas',
                    'South 24 Parganas',
                    'Purulia',
                    'Uttar Dinajpur',
            ],
        ];

        $this->command->line('Seeding City Table');
        foreach ($city as $state_id => $value) {
          
            foreach ($value as $city) {
                City::create([
                    'name' => $city,
                    'state_id'=>$state_id, 
                    'status'=>1,
                ]);
            }
        }
        $this->command->line('Seeding City Table Done');
    }
}
