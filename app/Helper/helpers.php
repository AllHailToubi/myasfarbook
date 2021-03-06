<?php
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

define( 'AMENITIES_ROOM', "3,1,4,6,8,10,17,20,23");

define( 'PLUGINS', "/plugins/");
define( 'CSS', "/css/");
define( 'JS', "/js/");
define( 'JS_ADMIN', "/js/admin/");
define( 'IMAGES_HOTELS', "/images/hotels/");
define( 'IMAGES_ROOMS', "/images/rooms/");
define( 'IMAGES_PROFILE', "/images/profile/");




if (!function_exists('currentRoute')) {
    function currentRoute(...$routes)
    {
        foreach($routes as $route) {
            if(request()->url() == $route) {
                return ' active';
            }
        }
    }
}

if (!function_exists('getValue')) {
    function getValue($param,$default){
        return !empty($param)?$param:$default;
    }
}


function convertYoutube($string) {
	return preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"<iframe width=\"100%\" height=\"100%\" src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
		$string
	);
}





/**
 * LogW
 *
 * @param  mixed $message
 * @return void
 */
function LogW($message){
	Log::warning('ErrorBooking W: '.$message);
}
/**
 * LogE le log des erreurs 
 *
 * @param  mixed $message
 * @return void
 */
function LogE($message){
	Log::error('ErrorBooking E: '.$message);
}

function LogI($message){
	Log::info('ErrorBooking I: '.$message);
}

function agencyID(){
	return "1";
}

function devise(){
	return "DHs";
}

/* $local app()->getLocale() */
function get_country_lists($locale="en"){
	if($locale=="fr"){
		return array(
			'AF' => 'Afghanistan',
			'AX' => 'Îles Aland',
			'AL' => 'Albanie',
			'DZ' => 'Algérie',
			'AS' => 'Samoa américaines',
			'AD' => 'Andorre',
			'AO' => 'Angola',
			'AI' => 'Anguilla',
			'AQ' => 'Antarctique',
			'AG' => 'Antigua-et-Barbuda',
			'AR' => 'Argentine',
			'AM' => 'Arménie',
			'AW' => 'Aruba',
			'AU' => 'Australie',
			'AT' => 'Autriche',
			'AZ' => 'Azerbaïdjan',
			'BS' => 'Bahamas',
			'BH' => 'Bahreïn',
			'BD' => 'Bangladesh',
			'BB' => 'Barbade',
			'BY' => 'Belarus',
			'BE' => 'Belgique',
			'BZ' => 'Belize',
			'BJ' => 'Bénin',
			'BM' => 'Bermuda',
			'BT' => 'Bhoutan',
			'BO' => 'Bolivie',
			'BA' => 'Bosnie-Herzégovine',
			'BW' => 'Botswana',
			'BV' => 'Île Bouvet',
			'BR' => 'Brésil',
			'IO' => 'Territoire britannique de l\'océan Indien',
			'BN' => 'Brunei Darussalam',
			'BG' => 'Bulgarie',
			'BF' => 'Burkina Faso',
			'BI' => 'Burundi',
			'KH' => 'Cambodge',
			'CM' => 'Cameroun',
			'CA' => 'Canada',
			'CV' => 'Cap-Vert',
			'KY' => 'Îles Caïmans',
			'CF' => 'République centrafricaine',
			'TD' => 'Tchad',
			'CL' => 'Chili',
			'CN' => 'Chine',
			'CX' => 'Christmas Island',
			'CC' => 'Îles Cocos (Keeling)',
			'CO' => 'Colombie',
			'KM' => 'Comores',
			'CG' => 'Congo',
			'CD' => 'Congo, République démocratique',
			'CK' => 'Îles Cook',
			'CR' => 'Costa Rica',
			'CI' => 'Côte d\'Ivoire ',
			'HR' => 'Croatie',
			'CU' => 'Cuba',
			'CY' => 'Chypre',
			'CZ' => 'République tchèque',
			'DK' => 'Danemark',
			'DJ' => 'Djibouti',
			'DM' => 'Dominique',
			'DO' => 'République dominicaine',
			'CE' => 'Équateur',
			'EG' => 'Egypte',
			'SV' => 'El Salvador',
			'GQ' => 'Guinée équatoriale',
			'ER' => 'Érythrée',
			'EE' => 'Estonie',
			'ET' => 'Ethiopie',
			'FK' => 'Îles Falkland (Malvinas)',
			'FO' => 'Îles Féroé',
			'FJ' => 'Fidji',
			'FI' => 'Finlande',
			'FR' => 'France',
			'GF' => 'Guyane française',
			'PF' => 'Polynésie française',
			'TF' => 'Terres australes françaises',
			'GA' => 'Gabon',
			'GM' => 'Gambie',
			'GE' => 'Géorgie',
			'DE' => 'Allemagne',
			'GH' => 'Ghana',
			'GI' => 'Gibraltar',
			'GR' => 'Grèce',
			'GL' => 'Groenland',
			'GD' => 'Grenade',
			'GP' => 'Guadeloupe',
			'GU' => 'Guam',
			'GT' => 'Guatemala',
			'GG' => 'Guernesey',
			'GN' => 'Guinée',
			'GW' => 'Guinée-Bissau',
			'GY' => 'Guyane',
			'HT' => 'Haïti',
			'HM' => 'Heard Island & Mcdonald Islands',
			'VA' => 'Saint-Siège (État de la Cité du Vatican)',
			'HN' => 'Honduras',
			'HK' => 'Hong Kong',
			'HU' => 'Hongrie',
			'IS' => 'Islande',
			'IN' => 'Inde',
			'ID' => 'Indonésie',
			'IR' => 'Iran',
			'IQ' => 'Irak',
			'IE' => 'Irlande',
			'IM' => 'Ile de Man',
			'IL' => 'Israël',
			'IT' => 'Italie',
			'JM' => 'Jamaïque',
			'JP' => 'Japon',
			'JE' => 'Jersey',
			'JO' => 'Jordan',
			'KZ' => 'Kazakhstan',
			'KE' => 'Kenya',
			'KI' => 'Kiribati',
			'KR' => 'Corée',
			'KW' => 'Koweït',
			'KG' => 'Kirghizistan',
			'LA' => 'République démocratique populaire lao',
			'LV' => 'Lettonie',
			'LB' => 'Liban',
			'LS' => 'Lesotho',
			'LR' => 'Liberia',
			'LY' => 'Jamahiriya arabe libyenne',
			'LI' => 'Liechtenstein',
			'LT' => 'Lituanie',
			'LU' => 'Luxembourg',
			'MO' => 'Macao',
			'MK' => 'Macédoine',
			'MG' => 'Madagascar',
			'MW' => 'Malawi',
			'MY' => 'Malaisie',
			'MV' => 'Maldives',
			'ML' => 'Mali',
			'MT' => 'Malte',
			'MH' => 'Îles Marshall',
			'MQ' => 'Martinique',
			'MR' => 'Mauritanie',
			'MU' => 'Maurice',
			'YT' => 'Mayotte',
			'MX' => 'Mexique',
			'FM' => 'Micronésie',
			'MD' => 'Moldavie',
			'MC' => 'Monaco',
			'MN' => 'Mongolie',
			'ME' => 'Monténégro',
			'MS' => 'Montserrat',
			'MA' => 'Maroc',
			'MZ' => 'Mozambique',
			'MM' => 'Myanmar',
			'NA' => 'Namibie',
			'NR' => 'Nauru',
			'NP' => 'Népal',
			'NL' => 'Pays-Bas',
			'AN' => 'Antilles néerlandaises',
			'NC' => 'Nouvelle-Calédonie',
			'NZ' => 'Nouvelle-Zélande',
			'NI' => 'Nicaragua',
			'NE' => 'Niger',
			'NG' => 'Nigeria',
			'NU' => 'Niue',
			'NF' => 'Île Norfolk',
			'MP' => 'Îles Mariannes du Nord',
			'NO' => 'Norvège',
			'OM' => 'Oman',
			'PK' => 'Pakistan',
			'PW' => 'Palau',
			'PS' => 'Territoire palestinien occupé',
			'PA' => 'Panama',
			'PG' => 'Papouasie-Nouvelle-Guinée',
			'PY' => 'Paraguay',
			'PE' => 'Pérou',
			'PH' => 'Philippines',
			'PN' => 'Pitcairn',
			'PL' => 'Pologne',
			'PT' => 'Portugal',
			'PR' => 'Porto Rico',
			'QA' => 'Qatar',
			'RE' => 'Réunion',
			'RO' => 'Roumanie',
			'RU' => 'Fédération de Russie',
			'RW' => 'Rwanda',
			'BL' => 'Saint Barthelemy',
			'SH' => 'Sainte-Hélène',
			'KN' => 'Saint-Kitts-et-Nevis',
			'LC' => 'Sainte-Lucie',
			'MF' => 'Saint Martin',
			'PM' => 'Saint Pierre et Miquelon',
			'VC' => 'Saint-Vincent-et-Grenadines',
			'WS' => 'Samoa',
			'SM' => 'Saint-Marin',
			'ST' => 'Sao Tomé et Principe',
			'SA' => 'Arabie saoudite',
			'SN' => 'Sénégal',
			'RS' => 'Serbie',
			'SC' => 'Seychelles',
			'SL' => 'Sierra Leone',
			'SG' => 'Singapour',
			'SK' => 'Slovaquie',
			'SI' => 'Slovénie',
			'SB' => 'Îles Salomon',
			'SO' => 'Somalie',
			'ZA' => 'Afrique du Sud',
			'GS' => 'Géorgie du Sud et Îles Sandwich.',
			'ES' => 'Espagne',
			'LK' => 'Sri Lanka',
			'SD' => 'Soudan',
			'SR' => 'Suriname',
			'SJ' => 'Svalbard et Jan Mayen',
			'SZ' => 'Swaziland',
			'SE' => 'Suède',
			'CH' => 'Suisse',
			'SY' => 'République arabe syrienne',
			'TW' => 'Taiwan',
			'TJ' => 'Tadjikistan',
			'TZ' => 'Tanzanie',
			'TH' => 'Thaïlande',
			'TL' => 'Timor-Leste',
			'TG' => 'Togo',
			'TK' => 'Tokelau',
			'TO' => 'Tonga',
			'TT' => 'Trinidad et Tobago',
			'TN' => 'Tunisie',
			'TR' => 'Turquie',
			'TM' => 'Turkménistan',
			'TC' => 'Îles Turques et Caïques',
			'TV' => 'Tuvalu',
			'UG' => 'Ouganda',
			'UA' => 'Ukraine',
			'AE' => 'Emirats Arabes Unis',
			'GB' => 'Royaume-Uni',
			'US' => 'États-Unis',
			'UM' => 'Îles américaines éloignées',
			'UY' => 'Uruguay',
			'UZ' => 'Ouzbékistan',
			'VU' => 'Vanuatu',
			'VE' => 'Venezuela',
			'VN' => 'Viet Nam',
			'VG' => 'Îles Vierges britanniques',
			'VI' => 'Îles Vierges américaines',
			'WF' => 'Wallis et Futuna',
			'EH' => 'Sahara occidental',
			'YE' => 'Yémen',
			'ZM' => 'Zambie',
			'ZW' => 'Zimbabwe');
	}
	return array(
	        'AF' => 'Afghanistan',
	        'AX' => 'Aland Islands',
	        'AL' => 'Albania',
	        'DZ' => 'Algeria',
	        'AS' => 'American Samoa',
	        'AD' => 'Andorra',
	        'AO' => 'Angola',
	        'AI' => 'Anguilla',
	        'AQ' => 'Antarctica',
	        'AG' => 'Antigua And Barbuda',
	        'AR' => 'Argentina',
	        'AM' => 'Armenia',
	        'AW' => 'Aruba',
	        'AU' => 'Australia',
	        'AT' => 'Austria',
	        'AZ' => 'Azerbaijan',
	        'BS' => 'Bahamas',
	        'BH' => 'Bahrain',
	        'BD' => 'Bangladesh',
	        'BB' => 'Barbados',
	        'BY' => 'Belarus',
	        'BE' => 'Belgium',
	        'BZ' => 'Belize',
	        'BJ' => 'Benin',
	        'BM' => 'Bermuda',
	        'BT' => 'Bhutan',
	        'BO' => 'Bolivia',
	        'BA' => 'Bosnia And Herzegovina',
	        'BW' => 'Botswana',
	        'BV' => 'Bouvet Island',
	        'BR' => 'Brazil',
	        'IO' => 'British Indian Ocean Territory',
	        'BN' => 'Brunei Darussalam',
	        'BG' => 'Bulgaria',
	        'BF' => 'Burkina Faso',
	        'BI' => 'Burundi',
	        'KH' => 'Cambodia',
	        'CM' => 'Cameroon',
	        'CA' => 'Canada',
	        'CV' => 'Cape Verde',
	        'KY' => 'Cayman Islands',
	        'CF' => 'Central African Republic',
	        'TD' => 'Chad',
	        'CL' => 'Chile',
	        'CN' => 'China',
	        'CX' => 'Christmas Island',
	        'CC' => 'Cocos (Keeling) Islands',
	        'CO' => 'Colombia',
	        'KM' => 'Comoros',
	        'CG' => 'Congo',
	        'CD' => 'Congo, Democratic Republic',
	        'CK' => 'Cook Islands',
	        'CR' => 'Costa Rica',
	        'CI' => 'Cote D\'Ivoire',
	        'HR' => 'Croatia',
	        'CU' => 'Cuba',
	        'CY' => 'Cyprus',
	        'CZ' => 'Czech Republic',
	        'DK' => 'Denmark',
	        'DJ' => 'Djibouti',
	        'DM' => 'Dominica',
	        'DO' => 'Dominican Republic',
	        'EC' => 'Ecuador',
	        'EG' => 'Egypt',
	        'SV' => 'El Salvador',
	        'GQ' => 'Equatorial Guinea',
	        'ER' => 'Eritrea',
	        'EE' => 'Estonia',
	        'ET' => 'Ethiopia',
	        'FK' => 'Falkland Islands (Malvinas)',
	        'FO' => 'Faroe Islands',
	        'FJ' => 'Fiji',
	        'FI' => 'Finland',
	        'FR' => 'France',
	        'GF' => 'French Guiana',
	        'PF' => 'French Polynesia',
	        'TF' => 'French Southern Territories',
	        'GA' => 'Gabon',
	        'GM' => 'Gambia',
	        'GE' => 'Georgia',
	        'DE' => 'Germany',
	        'GH' => 'Ghana',
	        'GI' => 'Gibraltar',
	        'GR' => 'Greece',
	        'GL' => 'Greenland',
	        'GD' => 'Grenada',
	        'GP' => 'Guadeloupe',
	        'GU' => 'Guam',
	        'GT' => 'Guatemala',
	        'GG' => 'Guernsey',
	        'GN' => 'Guinea',
	        'GW' => 'Guinea-Bissau',
	        'GY' => 'Guyana',
	        'HT' => 'Haiti',
	        'HM' => 'Heard Island & Mcdonald Islands',
	        'VA' => 'Holy See (Vatican City State)',
	        'HN' => 'Honduras',
	        'HK' => 'Hong Kong',
	        'HU' => 'Hungary',
	        'IS' => 'Iceland',
	        'IN' => 'India',
	        'ID' => 'Indonesia',
	        'IR' => 'Iran, Islamic Republic Of',
	        'IQ' => 'Iraq',
	        'IE' => 'Ireland',
	        'IM' => 'Isle Of Man',
	        'IL' => 'Israel',
	        'IT' => 'Italy',
	        'JM' => 'Jamaica',
	        'JP' => 'Japan',
	        'JE' => 'Jersey',
	        'JO' => 'Jordan',
	        'KZ' => 'Kazakhstan',
	        'KE' => 'Kenya',
	        'KI' => 'Kiribati',
	        'KR' => 'Korea',
	        'KW' => 'Kuwait',
	        'KG' => 'Kyrgyzstan',
	        'LA' => 'Lao People\'s Democratic Republic',
	        'LV' => 'Latvia',
	        'LB' => 'Lebanon',
	        'LS' => 'Lesotho',
	        'LR' => 'Liberia',
	        'LY' => 'Libyan Arab Jamahiriya',
	        'LI' => 'Liechtenstein',
	        'LT' => 'Lithuania',
	        'LU' => 'Luxembourg',
	        'MO' => 'Macao',
	        'MK' => 'Macedonia',
	        'MG' => 'Madagascar',
	        'MW' => 'Malawi',
	        'MY' => 'Malaysia',
	        'MV' => 'Maldives',
	        'ML' => 'Mali',
	        'MT' => 'Malta',
	        'MH' => 'Marshall Islands',
	        'MQ' => 'Martinique',
	        'MR' => 'Mauritania',
	        'MU' => 'Mauritius',
	        'YT' => 'Mayotte',
	        'MX' => 'Mexico',
	        'FM' => 'Micronesia, Federated States Of',
	        'MD' => 'Moldova',
	        'MC' => 'Monaco',
	        'MN' => 'Mongolia',
	        'ME' => 'Montenegro',
	        'MS' => 'Montserrat',
	        'MA' => 'Morocco',
	        'MZ' => 'Mozambique',
	        'MM' => 'Myanmar',
	        'NA' => 'Namibia',
	        'NR' => 'Nauru',
	        'NP' => 'Nepal',
	        'NL' => 'Netherlands',
	        'AN' => 'Netherlands Antilles',
	        'NC' => 'New Caledonia',
	        'NZ' => 'New Zealand',
	        'NI' => 'Nicaragua',
	        'NE' => 'Niger',
	        'NG' => 'Nigeria',
	        'NU' => 'Niue',
	        'NF' => 'Norfolk Island',
	        'MP' => 'Northern Mariana Islands',
	        'NO' => 'Norway',
	        'OM' => 'Oman',
	        'PK' => 'Pakistan',
	        'PW' => 'Palau',
	        'PS' => 'Palestinian Territory, Occupied',
	        'PA' => 'Panama',
	        'PG' => 'Papua New Guinea',
	        'PY' => 'Paraguay',
	        'PE' => 'Peru',
	        'PH' => 'Philippines',
	        'PN' => 'Pitcairn',
	        'PL' => 'Poland',
	        'PT' => 'Portugal',
	        'PR' => 'Puerto Rico',
	        'QA' => 'Qatar',
	        'RE' => 'Reunion',
	        'RO' => 'Romania',
	        'RU' => 'Russian Federation',
	        'RW' => 'Rwanda',
	        'BL' => 'Saint Barthelemy',
	        'SH' => 'Saint Helena',
	        'KN' => 'Saint Kitts And Nevis',
	        'LC' => 'Saint Lucia',
	        'MF' => 'Saint Martin',
	        'PM' => 'Saint Pierre And Miquelon',
	        'VC' => 'Saint Vincent And Grenadines',
	        'WS' => 'Samoa',
	        'SM' => 'San Marino',
	        'ST' => 'Sao Tome And Principe',
	        'SA' => 'Saudi Arabia',
	        'SN' => 'Senegal',
	        'RS' => 'Serbia',
	        'SC' => 'Seychelles',
	        'SL' => 'Sierra Leone',
	        'SG' => 'Singapore',
	        'SK' => 'Slovakia',
	        'SI' => 'Slovenia',
	        'SB' => 'Solomon Islands',
	        'SO' => 'Somalia',
	        'ZA' => 'South Africa',
	        'GS' => 'South Georgia And Sandwich Isl.',
	        'ES' => 'Spain',
	        'LK' => 'Sri Lanka',
	        'SD' => 'Sudan',
	        'SR' => 'Suriname',
	        'SJ' => 'Svalbard And Jan Mayen',
	        'SZ' => 'Swaziland',
	        'SE' => 'Sweden',
	        'CH' => 'Switzerland',
	        'SY' => 'Syrian Arab Republic',
	        'TW' => 'Taiwan',
	        'TJ' => 'Tajikistan',
	        'TZ' => 'Tanzania',
	        'TH' => 'Thailand',
	        'TL' => 'Timor-Leste',
	        'TG' => 'Togo',
	        'TK' => 'Tokelau',
	        'TO' => 'Tonga',
	        'TT' => 'Trinidad And Tobago',
	        'TN' => 'Tunisia',
	        'TR' => 'Turkey',
	        'TM' => 'Turkmenistan',
	        'TC' => 'Turks And Caicos Islands',
	        'TV' => 'Tuvalu',
	        'UG' => 'Uganda',
	        'UA' => 'Ukraine',
	        'AE' => 'United Arab Emirates',
	        'GB' => 'United Kingdom',
	        'US' => 'United States',
	        'UM' => 'United States Outlying Islands',
	        'UY' => 'Uruguay',
	        'UZ' => 'Uzbekistan',
	        'VU' => 'Vanuatu',
	        'VE' => 'Venezuela',
	        'VN' => 'Viet Nam',
	        'VG' => 'Virgin Islands, British',
	        'VI' => 'Virgin Islands, U.S.',
	        'WF' => 'Wallis And Futuna',
	        'EH' => 'Western Sahara',
	        'YE' => 'Yemen',
	        'ZM' => 'Zambia',
	        'ZW' => 'Zimbabwe');
}

function getCountry($code_country,$locale="en"){
	return get_country_lists($locale)[$code_country];
}


function checkpermission($permission){
	
	if(Auth::user()){
		
		if(Auth::user()->type!='SuperAdmin'){
			return Auth::user()->hasPermissionTo($permission);
		}
	}

	return true;
}

function hasAnyPermission($permission){
	if(Auth::user()){	
		if(Auth::user()->type!='SuperAdmin'){
			return Auth::user()->hasAnyPermission($permission);
		}
	}
	return true;
}



function hasAllPermissions($permission){
	if(Auth::user()){	
		if(Auth::user()->type!='SuperAdmin'){
			return Auth::user()->hasAllPermissions($permission);
		}
	}
	return true;
}

function logd($text){
	echo $text."<br>";
}

function plural($key,$nbr){
	if($nbr>1)
		return $nbr." ".$key."s";	
	return $nbr." ".$key;
}






