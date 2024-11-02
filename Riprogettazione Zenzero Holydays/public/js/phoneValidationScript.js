
console.log(lang);
$(document).ready(function(){
        // 253 countries
    const states = [
        { name: "Afghanistan", code: "AF", phone: 93 },
        { name: "Aland Islands", code: "AX", phone: 358 },
        { name: "Albania", code: "AL", phone: 355 },
        { name: "Algeria", code: "DZ", phone: 213 },
        { name: "American Samoa", code: "AS", phone: 1684 },
        { name: "Andorra", code: "AD", phone: 376 },
        { name: "Angola", code: "AO", phone: 244 },
        { name: "Anguilla", code: "AI", phone: 1264 },
        { name: "Antarctica", code: "AQ", phone: 672 },
        { name: "Antigua and Barbuda", code: "AG", phone: 1268 },
        { name: "Argentina", code: "AR", phone: 54 },
        { name: "Armenia", code: "AM", phone: 374 },
        { name: "Aruba", code: "AW", phone: 297 },
        { name: "Australia", code: "AU", phone: 61 },
        { name: "Austria", code: "AT", phone: 43 },
        { name: "Azerbaijan", code: "AZ", phone: 994 },
        { name: "Bahamas", code: "BS", phone: 1242 },
        { name: "Bahrain", code: "BH", phone: 973 },
        { name: "Bangladesh", code: "BD", phone: 880 },
        { name: "Barbados", code: "BB", phone: 1246 },
        { name: "Belarus", code: "BY", phone: 375 },
        { name: "Belgium", code: "BE", phone: 32 },
        { name: "Belize", code: "BZ", phone: 501 },
        { name: "Benin", code: "BJ", phone: 229 },
        { name: "Bermuda", code: "BM", phone: 1441 },
        { name: "Bhutan", code: "BT", phone: 975 },
        { name: "Bolivia", code: "BO", phone: 591 },
        { name: "Bonaire, Sint Eustatius and Saba", code: "BQ", phone: 599 },
        { name: "Bosnia and Herzegovina", code: "BA", phone: 387 },
        { name: "Botswana", code: "BW", phone: 267 },
        { name: "Bouvet Island", code: "BV", phone: 55 },
        { name: "Brazil", code: "BR", phone: 55 },
        { name: "British Indian Ocean Territory", code: "IO", phone: 246 },
        { name: "Brunei Darussalam", code: "BN", phone: 673 },
        { name: "Bulgaria", code: "BG", phone: 359 },
        { name: "Burkina Faso", code: "BF", phone: 226 },
        { name: "Burundi", code: "BI", phone: 257 },
        { name: "Cambodia", code: "KH", phone: 855 },
        { name: "Cameroon", code: "CM", phone: 237 },
        { name: "Canada", code: "CA", phone: 1 },
        { name: "Cape Verde", code: "CV", phone: 238 },
        { name: "Cayman Islands", code: "KY", phone: 1345 },
        { name: "Central African Republic", code: "CF", phone: 236 },
        { name: "Chad", code: "TD", phone: 235 },
        { name: "Chile", code: "CL", phone: 56 },
        { name: "China", code: "CN", phone: 86 },
        { name: "Christmas Island", code: "CX", phone: 61 },
        { name: "Cocos (Keeling) Islands", code: "CC", phone: 672 },
        { name: "Colombia", code: "CO", phone: 57 },
        { name: "Comoros", code: "KM", phone: 269 },
        { name: "Congo", code: "CG", phone: 242 },
        { name: "Congo, Democratic Republic of the Congo", code: "CD", phone: 242 },
        { name: "Cook Islands", code: "CK", phone: 682 },
        { name: "Costa Rica", code: "CR", phone: 506 },
        { name: "Cote D'Ivoire", code: "CI", phone: 225 },
        { name: "Croatia", code: "HR", phone: 385 },
        { name: "Cuba", code: "CU", phone: 53 },
        { name: "Curacao", code: "CW", phone: 599 },
        { name: "Cyprus", code: "CY", phone: 357 },
        { name: "Czech Republic", code: "CZ", phone: 420 },
        { name: "Denmark", code: "DK", phone: 45 },
        { name: "Djibouti", code: "DJ", phone: 253 },
        { name: "Dominica", code: "DM", phone: 1767 },
        { name: "Dominican Republic", code: "DO", phone: 1809 },
        { name: "Ecuador", code: "EC", phone: 593 },
        { name: "Egypt", code: "EG", phone: 20 },
        { name: "El Salvador", code: "SV", phone: 503 },
        { name: "Equatorial Guinea", code: "GQ", phone: 240 },
        { name: "Eritrea", code: "ER", phone: 291 },
        { name: "Estonia", code: "EE", phone: 372 },
        { name: "Ethiopia", code: "ET", phone: 251 },
        { name: "Falkland Islands (Malvinas)", code: "FK", phone: 500 },
        { name: "Faroe Islands", code: "FO", phone: 298 },
        { name: "Fiji", code: "FJ", phone: 679 },
        { name: "Finland", code: "FI", phone: 358 },
        { name: "France", code: "FR", phone: 33 },
        { name: "French Guiana", code: "GF", phone: 594 },
        { name: "French Polynesia", code: "PF", phone: 689 },
        { name: "French Southern Territories", code: "TF", phone: 262 },
        { name: "Gabon", code: "GA", phone: 241 },
        { name: "Gambia", code: "GM", phone: 220 },
        { name: "Georgia", code: "GE", phone: 995 },
        { name: "Germany", code: "DE", phone: 49 },
        { name: "Ghana", code: "GH", phone: 233 },
        { name: "Gibraltar", code: "GI", phone: 350 },
        { name: "Greece", code: "GR", phone: 30 },
        { name: "Greenland", code: "GL", phone: 299 },
        { name: "Grenada", code: "GD", phone: 1473 },
        { name: "Guadeloupe", code: "GP", phone: 590 },
        { name: "Guam", code: "GU", phone: 1671 },
        { name: "Guatemala", code: "GT", phone: 502 },
        { name: "Guernsey", code: "GG", phone: 44 },
        { name: "Guinea", code: "GN", phone: 224 },
        { name: "Guinea-Bissau", code: "GW", phone: 245 },
        { name: "Guyana", code: "GY", phone: 592 },
        { name: "Haiti", code: "HT", phone: 509 },
        { name: "Heard Island and McDonald Islands", code: "HM", phone: 0 },
        { name: "Holy See (Vatican City State)", code: "VA", phone: 39 },
        { name: "Honduras", code: "HN", phone: 504 },
        { name: "Hong Kong", code: "HK", phone: 852 },
        { name: "Hungary", code: "HU", phone: 36 },
        { name: "Iceland", code: "IS", phone: 354 },
        { name: "India", code: "IN", phone: 91 },
        { name: "Indonesia", code: "ID", phone: 62 },
        { name: "Iran, Islamic Republic of", code: "IR", phone: 98 },
        { name: "Iraq", code: "IQ", phone: 964 },
        { name: "Ireland", code: "IE", phone: 353 },
        { name: "Isle of Man", code: "IM", phone: 44 },
        { name: "Israel", code: "IL", phone: 972 },
        { name: "Italy", code: "IT", phone: 39 },
        { name: "Jamaica", code: "JM", phone: 1876 },
        { name: "Japan", code: "JP", phone: 81 },
        { name: "Jersey", code: "JE", phone: 44 },
        { name: "Jordan", code: "JO", phone: 962 },
        { name: "Kazakhstan", code: "KZ", phone: 7 },
        { name: "Kenya", code: "KE", phone: 254 },
        { name: "Kiribati", code: "KI", phone: 686 },
        { name: "Korea, Democratic People's Republic of", code: "KP", phone: 850 },
        { name: "Korea, Republic of", code: "KR", phone: 82 },
        { name: "Kosovo", code: "XK", phone: 383 },
        { name: "Kuwait", code: "KW", phone: 965 },
        { name: "Kyrgyzstan", code: "KG", phone: 996 },
        { name: "Lao People's Democratic Republic", code: "LA", phone: 856 },
        { name: "Latvia", code: "LV", phone: 371 },
        { name: "Lebanon", code: "LB", phone: 961 },
        { name: "Lesotho", code: "LS", phone: 266 },
        { name: "Liberia", code: "LR", phone: 231 },
        { name: "Libyan Arab Jamahiriya", code: "LY", phone: 218 },
        { name: "Liechtenstein", code: "LI", phone: 423 },
        { name: "Lithuania", code: "LT", phone: 370 },
        { name: "Luxembourg", code: "LU", phone: 352 },
        { name: "Macao", code: "MO", phone: 853 },
        { name: "Macedonia, the Former Yugoslav Republic of", code: "MK", phone: 389 },
        { name: "Madagascar", code: "MG", phone: 261 },
        { name: "Malawi", code: "MW", phone: 265 },
        { name: "Malaysia", code: "MY", phone: 60 },
        { name: "Maldives", code: "MV", phone: 960 },
        { name: "Mali", code: "ML", phone: 223 },
        { name: "Malta", code: "MT", phone: 356 },
        { name: "Marshall Islands", code: "MH", phone: 692 },
        { name: "Martinique", code: "MQ", phone: 596 },
        { name: "Mauritania", code: "MR", phone: 222 },
        { name: "Mauritius", code: "MU", phone: 230 },
        { name: "Mayotte", code: "YT", phone: 262 },
        { name: "Mexico", code: "MX", phone: 52 },
        { name: "Micronesia, Federated States of", code: "FM", phone: 691 },
        { name: "Moldova, Republic of", code: "MD", phone: 373 },
        { name: "Monaco", code: "MC", phone: 377 },
        { name: "Mongolia", code: "MN", phone: 976 },
        { name: "Montenegro", code: "ME", phone: 382 },
        { name: "Montserrat", code: "MS", phone: 1664 },
        { name: "Morocco", code: "MA", phone: 212 },
        { name: "Mozambique", code: "MZ", phone: 258 },
        { name: "Myanmar", code: "MM", phone: 95 },
        { name: "Namibia", code: "NA", phone: 264 },
        { name: "Nauru", code: "NR", phone: 674 },
        { name: "Nepal", code: "NP", phone: 977 },
        { name: "Netherlands", code: "NL", phone: 31 },
        { name: "Netherlands Antilles", code: "AN", phone: 599 },
        { name: "New Caledonia", code: "NC", phone: 687 },
        { name: "New Zealand", code: "NZ", phone: 64 },
        { name: "Nicaragua", code: "NI", phone: 505 },
        { name: "Niger", code: "NE", phone: 227 },
        { name: "Nigeria", code: "NG", phone: 234 },
        { name: "Niue", code: "NU", phone: 683 },
        { name: "Norfolk Island", code: "NF", phone: 672 },
        { name: "Northern Mariana Islands", code: "MP", phone: 1670 },
        { name: "Norway", code: "NO", phone: 47 },
        { name: "Oman", code: "OM", phone: 968 },
        { name: "Pakistan", code: "PK", phone: 92 },
        { name: "Palau", code: "PW", phone: 680 },
        { name: "Palestinian Territory, Occupied", code: "PS", phone: 970 },
        { name: "Panama", code: "PA", phone: 507 },
        { name: "Papua New Guinea", code: "PG", phone: 675 },
        { name: "Paraguay", code: "PY", phone: 595 },
        { name: "Peru", code: "PE", phone: 51 },
        { name: "Philippines", code: "PH", phone: 63 },
        { name: "Pitcairn", code: "PN", phone: 64 },
        { name: "Poland", code: "PL", phone: 48 },
        { name: "Portugal", code: "PT", phone: 351 },
        { name: "Puerto Rico", code: "PR", phone: 1787 },
        { name: "Qatar", code: "QA", phone: 974 },
        { name: "Reunion", code: "RE", phone: 262 },
        { name: "Romania", code: "RO", phone: 40 },
        { name: "Russian Federation", code: "RU", phone: 7 },
        { name: "Rwanda", code: "RW", phone: 250 },
        { name: "Saint Barthelemy", code: "BL", phone: 590 },
        { name: "Saint Helena", code: "SH", phone: 290 },
        { name: "Saint Kitts and Nevis", code: "KN", phone: 1869 },
        { name: "Saint Lucia", code: "LC", phone: 1758 },
        { name: "Saint Martin", code: "MF", phone: 590 },
        { name: "Saint Pierre and Miquelon", code: "PM", phone: 508 },
        { name: "Saint Vincent and the Grenadines", code: "VC", phone: 1784 },
        { name: "Samoa", code: "WS", phone: 684 },
        { name: "San Marino", code: "SM", phone: 378 },
        { name: "Sao Tome and Principe", code: "ST", phone: 239 },
        { name: "Saudi Arabia", code: "SA", phone: 966 },
        { name: "Senegal", code: "SN", phone: 221 },
        { name: "Serbia", code: "RS", phone: 381 },
        { name: "Serbia and Montenegro", code: "CS", phone: 381 },
        { name: "Seychelles", code: "SC", phone: 248 },
        { name: "Sierra Leone", code: "SL", phone: 232 },
        { name: "Singapore", code: "SG", phone: 65 },
        { name: "St Martin", code: "SX", phone: 721 },
        { name: "Slovakia", code: "SK", phone: 421 },
        { name: "Slovenia", code: "SI", phone: 386 },
        { name: "Solomon Islands", code: "SB", phone: 677 },
        { name: "Somalia", code: "SO", phone: 252 },
        { name: "South Africa", code: "ZA", phone: 27 },
        { name: "South Georgia and the South Sandwich Islands", code: "GS", phone: 500 },
        { name: "South Sudan", code: "SS", phone: 211 },
        { name: "Spain", code: "ES", phone: 34 },
        { name: "Sri Lanka", code: "LK", phone: 94 },
        { name: "Sudan", code: "SD", phone: 249 },
        { name: "Suriname", code: "SR", phone: 597 },
        { name: "Svalbard and Jan Mayen", code: "SJ", phone: 47 },
        { name: "Swaziland", code: "SZ", phone: 268 },
        { name: "Sweden", code: "SE", phone: 46 },
        { name: "Switzerland", code: "CH", phone: 41 },
        { name: "Syrian Arab Republic", code: "SY", phone: 963 },
        { name: "Taiwan, Province of China", code: "TW", phone: 886 },
        { name: "Tajikistan", code: "TJ", phone: 992 },
        { name: "Tanzania, United Republic of", code: "TZ", phone: 255 },
        { name: "Thailand", code: "TH", phone: 66 },
        { name: "Timor-Leste", code: "TL", phone: 670 },
        { name: "Togo", code: "TG", phone: 228 },
        { name: "Tokelau", code: "TK", phone: 690 },
        { name: "Tonga", code: "TO", phone: 676 },
        { name: "Trinidad and Tobago", code: "TT", phone: 1868 },
        { name: "Tunisia", code: "TN", phone: 216 },
        { name: "Turkey", code: "TR", phone: 90 },
        { name: "Turkmenistan", code: "TM", phone: 7370 },
        { name: "Turks and Caicos Islands", code: "TC", phone: 1649 },
        { name: "Tuvalu", code: "TV", phone: 688 },
        { name: "Uganda", code: "UG", phone: 256 },
        { name: "Ukraine", code: "UA", phone: 380 },
        { name: "United Arab Emirates", code: "AE", phone: 971 },
        { name: "United Kingdom", code: "GB", phone: 44 },
        { name: "United States", code: "US", phone: 1 },
        { name: "United States Minor Outlying Islands", code: "UM", phone: 1 },
        { name: "Uruguay", code: "UY", phone: 598 },
        { name: "Uzbekistan", code: "UZ", phone: 998 },
        { name: "Vanuatu", code: "VU", phone: 678 },
        { name: "Venezuela", code: "VE", phone: 58 },
        { name: "Viet Nam", code: "VN", phone: 84 },
        { name: "Virgin Islands, British", code: "VG", phone: 1284 },
        { name: "Virgin Islands, U.s.", code: "VI", phone: 1340 },
        { name: "Wallis and Futuna", code: "WF", phone: 681 },
        { name: "Western Sahara", code: "EH", phone: 212 },
        { name: "Yemen", code: "YE", phone: 967 },
        { name: "Zambia", code: "ZM", phone: 260 },
        { name: "Zimbabwe", code: "ZW", phone: 263 }
    ];

    // 253 paesi
    const stati = [
        { name: "Afghanistan", code: "AF", phone: 93 },
        { name: "Isole Aland", code: "AX", phone: 358 },
        { name: "Albania", code: "AL", phone: 355 },
        { name: "Algeria", code: "DZ", phone: 213 },
        { name: "Samoa Americane", code: "AS", phone: 1684 },
        { name: "Andorra", code: "AD", phone: 376 },
        { name: "Angola", code: "AO", phone: 244 },
        { name: "Anguilla", code: "AI", phone: 1264 },
        { name: "Antartide", code: "AQ", phone: 672 },
        { name: "Antigua e Barbuda", code: "AG", phone: 1268 },
        { name: "Argentina", code: "AR", phone: 54 },
        { name: "Armenia", code: "AM", phone: 374 },
        { name: "Aruba", code: "AW", phone: 297 },
        { name: "Australia", code: "AU", phone: 61 },
        { name: "Austria", code: "AT", phone: 43 },
        { name: "Azerbaigian", code: "AZ", phone: 994 },
        { name: "Bahamas", code: "BS", phone: 1242 },
        { name: "Bahrein", code: "BH", phone: 973 },
        { name: "Bangladesh", code: "BD", phone: 880 },
        { name: "Barbados", code: "BB", phone: 1246 },
        { name: "Bielorussia", code: "BY", phone: 375 },
        { name: "Belgio", code: "BE", phone: 32 },
        { name: "Belize", code: "BZ", phone: 501 },
        { name: "Benin", code: "BJ", phone: 229 },
        { name: "Bermuda", code: "BM", phone: 1441 },
        { name: "Bhutan", code: "BT", phone: 975 },
        { name: "Bolivia", code: "BO", phone: 591 },
        { name: "Bonaire, Saint Eustatius e Saba", code: "BQ", phone: 599 },
        { name: "Bosnia ed Erzegovina", code: "BA", phone: 387 },
        { name: "Botswana", code: "BW", phone: 267 },
        { name: "Isola Bouvet", code: "BV", phone: 55 },
        { name: "Brasile", code: "BR", phone: 55 },
        { name: "Territorio Britannico dell'Oceano Indiano", code: "IO", phone: 246 },
        { name: "Brunei Darussalam", code: "BN", phone: 673 },
        { name: "Bulgaria", code: "BG", phone: 359 },
        { name: "Burkina Faso", code: "BF", phone: 226 },
        { name: "Burundi", code: "BI", phone: 257 },
        { name: "Cambogia", code: "KH", phone: 855 },
        { name: "Camerun", code: "CM", phone: 237 },
        { name: "Canada", code: "CA", phone: 1 },
        { name: "Capo Verde", code: "CV", phone: 238 },
        { name: "Isole Cayman", code: "KY", phone: 1345 },
        { name: "Repubblica Centrafricana", code: "CF", phone: 236 },
        { name: "Ciad", code: "TD", phone: 235 },
        { name: "Cile", code: "CL", phone: 56 },
        { name: "Cina", code: "CN", phone: 86 },
        { name: "Isola di Natale", code: "CX", phone: 61 },
        { name: "Isole Cocos (Keeling)", code: "CC", phone: 672 },
        { name: "Colombia", code: "CO", phone: 57 },
        { name: "Comore", code: "KM", phone: 269 },
        { name: "Congo", code: "CG", phone: 242 },
        { name: "Congo, Repubblica Democratica del Congo", code: "CD", phone: 242 },
        { name: "Isole Cook", code: "CK", phone: 682 },
        { name: "Costa Rica", code: "CR", phone: 506 },
        { name: "Costa d'Avorio", code: "CI", phone: 225 },
        { name: "Croazia", code: "HR", phone: 385 },
        { name: "Cuba", code: "CU", phone: 53 },
        { name: "Curacao", code: "CW", phone: 599 },
        { name: "Cipro", code: "CY", phone: 357 },
        { name: "Repubblica Ceca", code: "CZ", phone: 420 },
        { name: "Danimarca", code: "DK", phone: 45 },
        { name: "Gibuti", code: "DJ", phone: 253 },
        { name: "Dominica", code: "DM", phone: 1767 },
        { name: "Repubblica Dominicana", code: "DO", phone: 1809 },
        { name: "Ecuador", code: "EC", phone: 593 },
        { name: "Egitto", code: "EG", phone: 20 },
        { name: "El Salvador", code: "SV", phone: 503 },
        { name: "Guinea Equatoriale", code: "GQ", phone: 240 },
        { name: "Eritrea", code: "ER", phone: 291 },
        { name: "Estonia", code: "EE", phone: 372 },
        { name: "Etiopia", code: "ET", phone: 251 },
        { name: "Isole Falkland (Malvinas)", code: "FK", phone: 500 },
        { name: "Isole Faroe", code: "FO", phone: 298 },
        { name: "Figi", code: "FJ", phone: 679 },
        { name: "Finlandia", code: "FI", phone: 358 },
        { name: "Francia", code: "FR", phone: 33 },
        { name: "Guyana Francese", code: "GF", phone: 594 },
        { name: "Polinesia Francese", code: "PF", phone: 689 },
        { name: "Territori Francesi del Sud", code: "TF", phone: 262 },
        { name: "Gabon", code: "GA", phone: 241 },
        { name: "Gambia", code: "GM", phone: 220 },
        { name: "Georgia", code: "GE", phone: 995 },
        { name: "Germania", code: "DE", phone: 49 },
        { name: "Ghana", code: "GH", phone: 233 },
        { name: "Gibilterra", code: "GI", phone: 350 },
        { name: "Grecia", code: "GR", phone: 30 },
        { name: "Groenlandia", code: "GL", phone: 299 },
        { name: "Grenada", code: "GD", phone: 1473 },
        { name: "Guadalupa", code: "GP", phone: 590 },
        { name: "Guam", code: "GU", phone: 1671 },
        { name: "Guatemala", code: "GT", phone: 502 },
        { name: "Guernsey", code: "GG", phone: 44 },
        { name: "Guinea", code: "GN", phone: 224 },
        { name: "Guinea-Bissau", code: "GW", phone: 245 },
        { name: "Guyana", code: "GY", phone: 592 },
        { name: "Haiti", code: "HT", phone: 509 },
        { name: "Isole Heard e Isole McDonald", code: "HM", phone: 0 },
        { name: "Santa Sede (Stato della Città del Vaticano)", code: "VA", phone: 39 },
        { name: "Honduras", code: "HN", phone: 504 },
        { name: "Hong Kong", code: "HK", phone: 852 },
        { name: "Ungheria", code: "HU", phone: 36 },
        { name: "Islanda", code: "IS", phone: 354 },
        { name: "India", code: "IN", phone: 91 },
        { name: "Indonesia", code: "ID", phone: 62 },
        { name: "Iran, Repubblica Islamica dell'Iran", code: "IR", phone: 98 },
        { name: "Iraq", code: "IQ", phone: 964 },
        { name: "Irlanda", code: "IE", phone: 353 },
        { name: "Isola di Man", code: "IM", phone: 44 },
        { name: "Israele", code: "IL", phone: 972 },
        { name: "Italia", code: "IT", phone: 39 },
        { name: "Giamaica", code: "JM", phone: 1876 },
        { name: "Giappone", code: "JP", phone: 81 },
        { name: "Jersey", code: "JE", phone: 44 },
        { name: "Giordania", code: "JO", phone: 962 },
        { name: "Kazakistan", code: "KZ", phone: 7 },
        { name: "Kenya", code: "KE", phone: 254 },
        { name: "Kiribati", code: "KI", phone: 686 },
        { name: "Corea del Nord", code: "KP", phone: 850 },
        { name: "Corea del Sud", code: "KR", phone: 82 },
        { name: "Kosovo", code: "XK", phone: 383 },
        { name: "Kuwait", code: "KW", phone: 965 },
        { name: "Kirghizistan", code: "KG", phone: 996 },
        { name: "Laos", code: "LA", phone: 856 },
        { name: "Lettonia", code: "LV", phone: 371 },
        { name: "Libano", code: "LB", phone: 961 },
        { name: "Lesotho", code: "LS", phone: 266 },
        { name: "Liberia", code: "LR", phone: 231 },
        { name: "Libia", code: "LY", phone: 218 },
        { name: "Liechtenstein", code: "LI", phone: 423 },
        { name: "Lituania", code: "LT", phone: 370 },
        { name: "Lussemburgo", code: "LU", phone: 352 },
        { name: "Macao", code: "MO", phone: 853 },
        { name: "Macedonia del Nord", code: "MK", phone: 389 },
        { name: "Madagascar", code: "MG", phone: 261 },
        { name: "Malawi", code: "MW", phone: 265 },
        { name: "Malesia", code: "MY", phone: 60 },
        { name: "Maldive", code: "MV", phone: 960 },
        { name: "Mali", code: "ML", phone: 223 },
        { name: "Malta", code: "MT", phone: 356 },
        { name: "Isole Marshall", code: "MH", phone: 692 },
        { name: "Martinica", code: "MQ", phone: 596 },
        { name: "Mauritania", code: "MR", phone: 222 },
        { name: "Mauritius", code: "MU", phone: 230 },
        { name: "Mayotte", code: "YT", phone: 262 },
        { name: "Messico", code: "MX", phone: 52 },
        { name: "Micronesia", code: "FM", phone: 691 },
        { name: "Moldavia", code: "MD", phone: 373 },
        { name: "Monaco", code: "MC", phone: 377 },
        { name: "Mongolia", code: "MN", phone: 976 },
        { name: "Montenegro", code: "ME", phone: 382 },
        { name: "Montserrat", code: "MS", phone: 1664 },
        { name: "Marocco", code: "MA", phone: 212 },
        { name: "Mozambico", code: "MZ", phone: 258 },
        { name: "Myanmar", code: "MM", phone: 95 },
        { name: "Namibia", code: "NA", phone: 264 },
        { name: "Nauru", code: "NR", phone: 674 },
        { name: "Nepal", code: "NP", phone: 977 },
        { name: "Paesi Bassi", code: "NL", phone: 31 },
        { name: "Antille Olandesi", code: "AN", phone: 599 },
        { name: "Nuova Caledonia", code: "NC", phone: 687 },
        { name: "Nuova Zelanda", code: "NZ", phone: 64 },
        { name: "Nicaragua", code: "NI", phone: 505 },
        { name: "Niger", code: "NE", phone: 227 },
        { name: "Nigeria", code: "NG", phone: 234 },
        { name: "Niue", code: "NU", phone: 683 },
        { name: "Isola Norfolk", code: "NF", phone: 672 },
        { name: "Isole Marianne Settentrionali", code: "MP", phone: 1670 },
        { name: "Norvegia", code: "NO", phone: 47 },
        { name: "Oman", code: "OM", phone: 968 },
        { name: "Pakistan", code: "PK", phone: 92 },
        { name: "Palau", code: "PW", phone: 680 },
        { name: "Territori palestinesi", code: "PS", phone: 970 },
        { name: "Panama", code: "PA", phone: 507 },
        { name: "Papua Nuova Guinea", code: "PG", phone: 675 },
        { name: "Paraguay", code: "PY", phone: 595 },
        { name: "Perù", code: "PE", phone: 51 },
        { name: "Filippine", code: "PH", phone: 63 },
        { name: "Pitcairn", code: "PN", phone: 64 },
        { name: "Polonia", code: "PL", phone: 48 },
        { name: "Portogallo", code: "PT", phone: 351 },
        { name: "Porto Rico", code: "PR", phone: 1787 },
        { name: "Qatar", code: "QA", phone: 974 },
        { name: "Riunione", code: "RE", phone: 262 },
        { name: "Romania", code: "RO", phone: 40 },
        { name: "Federazione Russa", code: "RU", phone: 7 },
        { name: "Ruanda", code: "RW", phone: 250 },
        { name: "Saint-Barthélemy", code: "BL", phone: 590 },
        { name: "Sant'Elena", code: "SH", phone: 290 },
        { name: "Saint Kitts e Nevis", code: "KN", phone: 1869 },
        { name: "Saint Lucia", code: "LC", phone: 1758 },
        { name: "Saint Martin", code: "MF", phone: 590 },
        { name: "Saint-Pierre e Miquelon", code: "PM", phone: 508 },
        { name: "Saint Vincent e Grenadine", code: "VC", phone: 1784 },
        { name: "Samoa", code: "WS", phone: 684 },
        { name: "San Marino", code: "SM", phone: 378 },
        { name: "Sao Tomé e Príncipe", code: "ST", phone: 239 },
        { name: "Arabia Saudita", code: "SA", phone: 966 },
        { name: "Senegal", code: "SN", phone: 221 },
        { name: "Serbia", code: "RS", phone: 381 },
        { name: "Serbia e Montenegro", code: "CS", phone: 381 },
        { name: "Seychelles", code: "SC", phone: 248 },
        { name: "Sierra Leone", code: "SL", phone: 232 },
        { name: "Singapore", code: "SG", phone: 65 },
        { name: "Sint Maarten", code: "SX", phone: 721 },
        { name: "Slovacchia", code: "SK", phone: 421 },
        { name: "Slovenia", code: "SI", phone: 386 },
        { name: "Isole Salomone", code: "SB", phone: 677 },
        { name: "Somalia", code: "SO", phone: 252 },
        { name: "Sudafrica", code: "ZA", phone: 27 },
        { name: "Georgia del Sud e Sandwich australi", code: "GS", phone: 500 },
        { name: "Sud Sudan", code: "SS", phone: 211 },
        { name: "Spagna", code: "ES", phone: 34 },
        { name: "Sri Lanka", code: "LK", phone: 94 },
        { name: "Sudan", code: "SD", phone: 249 },
        { name: "Suriname", code: "SR", phone: 597 },
        { name: "Svalbard e Jan Mayen", code: "SJ", phone: 47 },
        { name: "Eswatini", code: "SZ", phone: 268 },
        { name: "Svezia", code: "SE", phone: 46 },
        { name: "Svizzera", code: "CH", phone: 41 },
        { name: "Siria", code: "SY", phone: 963 },
        { name: "Taiwan", code: "TW", phone: 886 },
        { name: "Tagikistan", code: "TJ", phone: 992 },
        { name: "Tanzania", code: "TZ", phone: 255 },
        { name: "Thailandia", code: "TH", phone: 66 },
        { name: "Timor Est", code: "TL", phone: 670 },
        { name: "Togo", code: "TG", phone: 228 },
        { name: "Tokelau", code: "TK", phone: 690 },
        { name: "Tonga", code: "TO", phone: 676 },
        { name: "Trinidad e Tobago", code: "TT", phone: 1868 },
        { name: "Tunisia", code: "TN", phone: 216 },
        { name: "Turchia", code: "TR", phone: 90 },
        { name: "Turkmenistan", code: "TM", phone: 993 }, // Corretto il telefono
        { name: "Isole Turks e Caicos", code: "TC", phone: 1649 },
        { name: "Tuvalu", code: "TV", phone: 688 },
        { name: "Uganda", code: "UG", phone: 256 },
        { name: "Ucraina", code: "UA", phone: 380 },
        { name: "Emirati Arabi Uniti", code: "AE", phone: 971 },
        { name: "Regno Unito", code: "GB", phone: 44 },
        { name: "Stati Uniti", code: "US", phone: 1 },
        { name: "Isole Minori Esterne degli Stati Uniti", code: "UM", phone: 1 },
        { name: "Uruguay", code: "UY", phone: 598 },
        { name: "Uzbekistan", code: "UZ", phone: 998 },
        { name: "Vanuatu", code: "VU", phone: 678 },
        { name: "Venezuela", code: "VE", phone: 58 },
        { name: "Vietnam", code: "VN", phone: 84 },
        { name: "Isole Vergini Britanniche", code: "VG", phone: 1284 },
        { name: "Isole Vergini Americane", code: "VI", phone: 1340 },
        { name: "Wallis e Futuna", code: "WF", phone: 681 },
        { name: "Sahara Occidentale", code: "EH", phone: 212 },
        { name: "Yemen", code: "YE", phone: 967 },
        { name: "Zambia", code: "ZM", phone: 260 },
        { name: "Zimbabwe", code: "ZW", phone: 263 }
    ];

    stati.sort((a, b) => {
        if (a.name < b.name) return -1; // A precede B
        if (a.name > b.name) return 1;  // A segue B
        return 0; // A e B sono uguali
    });
    
    
    console.log(lang);

    select_box = document.querySelector('.options'),
    search_box = document.querySelector('.search-box'),
    input_box = document.getElementById('telefono'),
    telefono_input = document.getElementById('num-telefono'), // Campo numero di telefono visibile
    selected_option = document.querySelector('.selected-option div');
    stato_select = document.getElementById('stato');

    let options = null;
    let selected_phone_code = ''; // Variabile per memorizzare il prefisso selezionato

    let countries = lang === 'it' ? stati : states; // Scegli l'array corretto
    console.log(countries);

    
    countries.forEach(country => {
        const option = document.createElement('option');
        option.value = country.name;
        option.setAttribute('data-code', country.code);
        option.textContent = country.name;
        stato_select.appendChild(option);
    });
   

    
    for (country of countries) {
        const option = `
        <li class="option">
            <div>
                <span class="iconify" data-icon="flag:${country.code.toLowerCase()}-4x3"></span>
                <span class="country-name">${country.name}</span>
            </div>
            <strong>+${country.phone}</strong>
        </li> `;

        select_box.querySelector('ol').insertAdjacentHTML('beforeend', option);
        options = document.querySelectorAll('.option');
    }

    function selectOption() {
        console.log(this);
        const icon = this.querySelector('.iconify').cloneNode(true),
            phone_code = this.querySelector('strong').cloneNode(true);

        selected_option.innerHTML = '';
        selected_option.append(icon, phone_code);

        // Memorizza il prefisso selezionato
        selected_phone_code = phone_code.innerText;

        // Aggiorna il campo hidden con il prefisso e il numero di telefono attuale
        updateHiddenPhoneNumber();

        select_box.classList.remove('active');
        selected_option.classList.remove('active');

        search_box.value = '';
        select_box.querySelectorAll('.hide').forEach(el => el.classList.remove('hide'));
    }

    function searchCountry() {
        let search_query = search_box.value.toLowerCase();
        for (option of options) {
            let is_matched = option.querySelector('.country-name').innerText.toLowerCase().includes(search_query);
            option.classList.toggle('hide', !is_matched)
        }
    }

    // Funzione per aggiornare il valore del campo hidden con il prefisso e il numero di telefono
    function updateHiddenPhoneNumber() {
        const phone_number = telefono_input.value; // Ottiene il numero di telefono inserito
        input_box.value = `${selected_phone_code} ${phone_number}`; // Unisce prefisso e numero di telefono
    }

    
     // Evento per la selezione dello stato 
     stato_select.addEventListener('change', function () {
        const selectedState = this.value;
        const selectedCountry = countries.find(country => country.name === selectedState);
        if (selectedCountry) {
            // Imposta automaticamente il prefisso telefonico
            selected_phone_code = `+${selectedCountry.phone}`;
            updateHiddenPhoneNumber();
            // Aggiorna la visualizzazione del prefisso selezionato
            selected_option.innerHTML = `
                
                    <span class="iconify" data-icon="flag:${selectedCountry.code.toLowerCase()}-4x3"></span>
                    <strong>${selected_phone_code}</strong>
                
                    `;
        }
    });


    document.addEventListener('click', function(event) {
        const isClickInside = select_box.contains(event.target) || selected_option.contains(event.target);
        if (!isClickInside) {
            select_box.classList.remove('active');
            selected_option.classList.remove('active');
        }
    });

    selected_option.addEventListener('click', (event) => {
        event.stopPropagation();  // Evita che il clic su selected_option chiuda la select-box
        select_box.classList.toggle('active');
        selected_option.classList.toggle('active');
    })

    options.forEach(option => option.addEventListener('click', selectOption));
    search_box.addEventListener('input', searchCountry);

    // Aggiorna il campo hidden quando l'utente cambia il numero di telefono
    telefono_input.addEventListener('input', updateHiddenPhoneNumber);
});