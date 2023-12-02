<?php

namespace Database\Seeders;

use App\Models\Asdos;
use App\Models\User;
use Illuminate\Database\Seeder;

class AsdosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*

        */

        $asdos = [
            ["dosen_id" => 4, "status" => "mahasiswa", "nik" => "119939411521", "email" => "tarstingall0@symantec.com", "password" => bcrypt("12345678"), "phone" => "0885-9763-3446", "photoProfile" => null, "firstName" => "Tim", "lastName" => "Arstingall", "jns_kelamin" => "Laki-laki", "alamat" => "8998 Kedzie Junction"],
            ["dosen_id" => 42, "status" => "mahasiswa", "nik" => "510406837552", "email" => "rtrevains1@loc.gov", "password" => bcrypt("12345678"), "phone" => "0813-1374-1698", "photoProfile" => null, "firstName" => "Romeo", "lastName" => "Trevains", "jns_kelamin" => "Laki-laki", "alamat" => "4 Shopko Trail"],
            ["dosen_id" => 25, "status" => "non mahasiswa", "nik" => "288810247862", "email" => "hcorry2@taobao.com", "password" => bcrypt("12345678"), "phone" => "0841-2102-7340", "photoProfile" => null, "firstName" => "Herminia", "lastName" => "Corry", "jns_kelamin" => "Perempuan", "alamat" => "8581 Nobel Court"],
            ["dosen_id" => 65, "status" => "non mahasiswa", "nik" => "583695625216", "email" => "csymons3@buzzfeed.com", "password" => bcrypt("12345678"), "phone" => "0831-4133-4904", "photoProfile" => null, "firstName" => "Cirilo", "lastName" => "Symons", "jns_kelamin" => "Laki-laki", "alamat" => "25 Graceland Park"],
            ["dosen_id" => 47, "status" => "non mahasiswa", "nik" => "810096338649", "email" => "jsimoni4@miitbeian.gov.cn", "password" => bcrypt("12345678"), "phone" => "0897-9080-7032", "photoProfile" => null, "firstName" => "Jazmin", "lastName" => "Simoni", "jns_kelamin" => "Perempuan", "alamat" => "4 Oak Valley Pass"],
            ["dosen_id" => 8, "status" => "non mahasiswa", "nik" => "862108167073", "email" => "stinklin5@tuttocitta.it", "password" => bcrypt("12345678"), "phone" => "0800-9642-1217", "photoProfile" => null, "firstName" => "Shelden", "lastName" => "Tinklin", "jns_kelamin" => "Laki-laki", "alamat" => "102 Hoard Place"],
            ["dosen_id" => 10, "status" => "mahasiswa", "nik" => "831628450471", "email" => "rfrossell6@desdev.cn", "password" => bcrypt("12345678"), "phone" => "0818-4357-9702", "photoProfile" => null, "firstName" => "Rubie", "lastName" => "Frossell", "jns_kelamin" => "Perempuan", "alamat" => "795 Springview Point"],
            ["dosen_id" => 81, "status" => "mahasiswa", "nik" => "840903376869", "email" => "mholme7@vistaprint.com", "password" => bcrypt("12345678"), "phone" => "0862-4047-6989", "photoProfile" => null, "firstName" => "Matias", "lastName" => "Holme", "jns_kelamin" => "Laki-laki", "alamat" => "87214 Northview Center"],
            ["dosen_id" => 18, "status" => "mahasiswa", "nik" => "799785688414", "email" => "xcrann8@desdev.cn", "password" => bcrypt("12345678"), "phone" => "0840-8918-3102", "photoProfile" => null, "firstName" => "Ximenes", "lastName" => "Crann", "jns_kelamin" => "Laki-laki", "alamat" => "660 Summit Court"],
            ["dosen_id" => 30, "status" => "mahasiswa", "nik" => "086473888598", "email" => "bdrinkall9@nsw.gov.au", "password" => bcrypt("12345678"), "phone" => "0839-1825-3124", "photoProfile" => null, "firstName" => "Bridie", "lastName" => "Drinkall", "jns_kelamin" => "Perempuan", "alamat" => "81 Division Junction"],
            ["dosen_id" => 73, "status" => "non mahasiswa", "nik" => "983308180759", "email" => "gwoollarda@vinaora.com", "password" => bcrypt("12345678"), "phone" => "0816-6406-9222", "photoProfile" => null, "firstName" => "Garold", "lastName" => "Woollard", "jns_kelamin" => "Laki-laki", "alamat" => "07 Old Shore Crossing"],
            ["dosen_id" => 80, "status" => "non mahasiswa", "nik" => "571785546485", "email" => "sbadinib@virginia.edu", "password" => bcrypt("12345678"), "phone" => "0891-8215-5157", "photoProfile" => null, "firstName" => "Stewart", "lastName" => "Badini", "jns_kelamin" => "Laki-laki", "alamat" => "2815 Springs Street"],
            ["dosen_id" => 4, "status" => "non mahasiswa", "nik" => "151957731875", "email" => "amcphelimc@arstechnica.com", "password" => bcrypt("12345678"), "phone" => "0869-7447-7290", "photoProfile" => null, "firstName" => "Alwin", "lastName" => "McPhelim", "jns_kelamin" => "Laki-laki", "alamat" => "434 Sage Street"],
            ["dosen_id" => 40, "status" => "mahasiswa", "nik" => "884124386481", "email" => "acardenasd@arizona.edu", "password" => bcrypt("12345678"), "phone" => "0819-7921-3168", "photoProfile" => null, "firstName" => "Angel", "lastName" => "Cardenas", "jns_kelamin" => "Laki-laki", "alamat" => "867 Bowman Junction"],
            ["dosen_id" => 55, "status" => "non mahasiswa", "nik" => "240614047427", "email" => "satlinge@arizona.edu", "password" => bcrypt("12345678"), "phone" => "0883-8700-4011", "photoProfile" => null, "firstName" => "Sauncho", "lastName" => "Atling", "jns_kelamin" => "Laki-laki", "alamat" => "6916 Ruskin Lane"],
            ["dosen_id" => 86, "status" => "mahasiswa", "nik" => "177299532681", "email" => "nlibbef@google.ru", "password" => bcrypt("12345678"), "phone" => "0818-8156-5562", "photoProfile" => null, "firstName" => "Nico", "lastName" => "Libbe", "jns_kelamin" => "Laki-laki", "alamat" => "051 Anniversary Alley"],
            ["dosen_id" => 63, "status" => "mahasiswa", "nik" => "004999210356", "email" => "tdallenderg@canalblog.com", "password" => bcrypt("12345678"), "phone" => "0850-7505-5113", "photoProfile" => null, "firstName" => "Thaddus", "lastName" => "Dallender", "jns_kelamin" => "Laki-laki", "alamat" => "34 Cottonwood Way"],
            ["dosen_id" => 28, "status" => "non mahasiswa", "nik" => "440385232170", "email" => "tstaggsh@livejournal.com", "password" => bcrypt("12345678"), "phone" => "0870-3200-5389", "photoProfile" => null, "firstName" => "Tait", "lastName" => "Staggs", "jns_kelamin" => "Laki-laki", "alamat" => "86 Kropf Alley"],
            ["dosen_id" => 81, "status" => "mahasiswa", "nik" => "555613844291", "email" => "lcahani@stumbleupon.com", "password" => bcrypt("12345678"), "phone" => "0890-8014-9902", "photoProfile" => null, "firstName" => "Leanna", "lastName" => "Cahan", "jns_kelamin" => "Perempuan", "alamat" => "7 Almo Lane"],
            ["dosen_id" => 51, "status" => "mahasiswa", "nik" => "890804073285", "email" => "ngwinnj@dion.ne.jp", "password" => bcrypt("12345678"), "phone" => "0897-9327-4775", "photoProfile" => null, "firstName" => "Nicolais", "lastName" => "Gwinn", "jns_kelamin" => "Laki-laki", "alamat" => "8123 Lakeland Trail"],
            ["dosen_id" => 33, "status" => "mahasiswa", "nik" => "822996138782", "email" => "jbruckshawk@miitbeian.gov.cn", "password" => bcrypt("12345678"), "phone" => "0871-6489-8169", "photoProfile" => null, "firstName" => "Jenn", "lastName" => "Bruckshaw", "jns_kelamin" => "Perempuan", "alamat" => "0 Thierer Avenue"],
            ["dosen_id" => 90, "status" => "mahasiswa", "nik" => "660599202128", "email" => "apenbarthyl@europa.eu", "password" => bcrypt("12345678"), "phone" => "0882-3956-6816", "photoProfile" => null, "firstName" => "Andria", "lastName" => "Penbarthy", "jns_kelamin" => "Perempuan", "alamat" => "01569 Riverside Avenue"],
            ["dosen_id" => 2, "status" => "non mahasiswa", "nik" => "780429873085", "email" => "tgribbonm@walmart.com", "password" => bcrypt("12345678"), "phone" => "0801-7935-2083", "photoProfile" => null, "firstName" => "Thorny", "lastName" => "Gribbon", "jns_kelamin" => "Laki-laki", "alamat" => "98 Roth Point"],
            ["dosen_id" => 22, "status" => "mahasiswa", "nik" => "851378614077", "email" => "itallquistn@tripadvisor.com", "password" => bcrypt("12345678"), "phone" => "0838-5197-5815", "photoProfile" => null, "firstName" => "Irita", "lastName" => "Tallquist", "jns_kelamin" => "Perempuan", "alamat" => "2 Michigan Trail"],
            ["dosen_id" => 82, "status" => "mahasiswa", "nik" => "406381994699", "email" => "tswinburneo@hostgator.com", "password" => bcrypt("12345678"), "phone" => "0833-7685-4632", "photoProfile" => null, "firstName" => "Trent", "lastName" => "Swinburne", "jns_kelamin" => "Laki-laki", "alamat" => "73228 Canary Trail"],
            ["dosen_id" => 95, "status" => "mahasiswa", "nik" => "026867598117", "email" => "edarcyp@parallels.com", "password" => bcrypt("12345678"), "phone" => "0801-6854-3274", "photoProfile" => null, "firstName" => "Ellyn", "lastName" => "Darcy", "jns_kelamin" => "Perempuan", "alamat" => "3801 Acker Point"],
            ["dosen_id" => 38, "status" => "mahasiswa", "nik" => "273633131006", "email" => "cbrikq@blogs.com", "password" => bcrypt("12345678"), "phone" => "0867-8814-8804", "photoProfile" => null, "firstName" => "Culver", "lastName" => "Brik", "jns_kelamin" => "Laki-laki", "alamat" => "45 Jana Hill"],
            ["dosen_id" => 79, "status" => "non mahasiswa", "nik" => "795430098446", "email" => "jshorer@symantec.com", "password" => bcrypt("12345678"), "phone" => "0859-3334-5215", "photoProfile" => null, "firstName" => "Jarad", "lastName" => "Shore", "jns_kelamin" => "Laki-laki", "alamat" => "24232 Longview Parkway"],
            ["dosen_id" => 34, "status" => "non mahasiswa", "nik" => "608634852102", "email" => "usirmans@storify.com", "password" => bcrypt("12345678"), "phone" => "0830-9695-0798", "photoProfile" => null, "firstName" => "Upton", "lastName" => "Sirman", "jns_kelamin" => "Laki-laki", "alamat" => "0521 Commercial Place"],
            ["dosen_id" => 72, "status" => "non mahasiswa", "nik" => "918738079477", "email" => "ahollowst@intel.com", "password" => bcrypt("12345678"), "phone" => "0815-1771-0393", "photoProfile" => null, "firstName" => "Arlen", "lastName" => "Hollows", "jns_kelamin" => "Perempuan", "alamat" => "3756 Golf View Circle"],
            ["dosen_id" => 29, "status" => "mahasiswa", "nik" => "448079909504", "email" => "ttownsendu@theglobeandmail.com", "password" => bcrypt("12345678"), "phone" => "0819-5395-7054", "photoProfile" => null, "firstName" => "Tera", "lastName" => "Townsend", "jns_kelamin" => "Perempuan", "alamat" => "02463 Orin Plaza"],
            ["dosen_id" => 44, "status" => "non mahasiswa", "nik" => "857833993884", "email" => "gvischiv@delicious.com", "password" => bcrypt("12345678"), "phone" => "0810-8035-1615", "photoProfile" => null, "firstName" => "Gena", "lastName" => "Vischi", "jns_kelamin" => "Perempuan", "alamat" => "0 Oak Valley Lane"],
            ["dosen_id" => 46, "status" => "mahasiswa", "nik" => "477012033857", "email" => "gdeddumw@imgur.com", "password" => bcrypt("12345678"), "phone" => "0884-6994-0554", "photoProfile" => null, "firstName" => "Goober", "lastName" => "Deddum", "jns_kelamin" => "Laki-laki", "alamat" => "87 Charing Cross Place"],
            ["dosen_id" => 18, "status" => "non mahasiswa", "nik" => "303773558322", "email" => "mmacallasterx@cisco.com", "password" => bcrypt("12345678"), "phone" => "0818-6349-6549", "photoProfile" => null, "firstName" => "Maurizio", "lastName" => "MacAllaster", "jns_kelamin" => "Laki-laki", "alamat" => "77 Packers Parkway"],
            ["dosen_id" => 71, "status" => "mahasiswa", "nik" => "095096419956", "email" => "jthaly@photobucket.com", "password" => bcrypt("12345678"), "phone" => "0845-4176-5213", "photoProfile" => null, "firstName" => "Josias", "lastName" => "Thal", "jns_kelamin" => "Laki-laki", "alamat" => "9 Atwood Way"],
            ["dosen_id" => 32, "status" => "non mahasiswa", "nik" => "001536622896", "email" => "vcasariz@sohu.com", "password" => bcrypt("12345678"), "phone" => "0846-3836-1407", "photoProfile" => null, "firstName" => "Vicky", "lastName" => "Casari", "jns_kelamin" => "Perempuan", "alamat" => "67907 Cottonwood Place"],
            ["dosen_id" => 1, "status" => "mahasiswa", "nik" => "681570257142", "email" => "klevay10@cnn.com", "password" => bcrypt("12345678"), "phone" => "0825-7967-6010", "photoProfile" => null, "firstName" => "Koenraad", "lastName" => "Levay", "jns_kelamin" => "Laki-laki", "alamat" => "1918 Pierstorff Court"],
            ["dosen_id" => 58, "status" => "mahasiswa", "nik" => "050450415757", "email" => "tarckoll11@vimeo.com", "password" => bcrypt("12345678"), "phone" => "0846-3758-4462", "photoProfile" => null, "firstName" => "Torey", "lastName" => "Arckoll", "jns_kelamin" => "Laki-laki", "alamat" => "76 Granby Road"],
            ["dosen_id" => 44, "status" => "non mahasiswa", "nik" => "184783730669", "email" => "lclingan12@ox.ac.uk", "password" => bcrypt("12345678"), "phone" => "0810-1145-0748", "photoProfile" => null, "firstName" => "Lodovico", "lastName" => "Clingan", "jns_kelamin" => "Laki-laki", "alamat" => "089 Oneill Lane"],
            ["dosen_id" => 75, "status" => "mahasiswa", "nik" => "018629339081", "email" => "ctemplman13@admin.ch", "password" => bcrypt("12345678"), "phone" => "0849-8435-0799", "photoProfile" => null, "firstName" => "Conchita", "lastName" => "Templman", "jns_kelamin" => "Perempuan", "alamat" => "9 Vera Hill"],
            ["dosen_id" => 36, "status" => "mahasiswa", "nik" => "703745134037", "email" => "mbrun14@bluehost.com", "password" => bcrypt("12345678"), "phone" => "0899-0195-9988", "photoProfile" => null, "firstName" => "Marsiella", "lastName" => "Brun", "jns_kelamin" => "Perempuan", "alamat" => "65 Lotheville Lane"],
            ["dosen_id" => 33, "status" => "non mahasiswa", "nik" => "213014298034", "email" => "mcouzens15@indiegogo.com", "password" => bcrypt("12345678"), "phone" => "0898-0102-2574", "photoProfile" => null, "firstName" => "Meghann", "lastName" => "Couzens", "jns_kelamin" => "Perempuan", "alamat" => "3 Badeau Lane"],
            ["dosen_id" => 71, "status" => "non mahasiswa", "nik" => "398041964899", "email" => "mmacaskill16@java.com", "password" => bcrypt("12345678"), "phone" => "0812-5083-4905", "photoProfile" => null, "firstName" => "Madelene", "lastName" => "MacAskill", "jns_kelamin" => "Perempuan", "alamat" => "7 Johnson Avenue"],
            ["dosen_id" => 49, "status" => "mahasiswa", "nik" => "813565521392", "email" => "hdoonican17@jugem.jp", "password" => bcrypt("12345678"), "phone" => "0806-6574-4501", "photoProfile" => null, "firstName" => "Hermie", "lastName" => "Doonican", "jns_kelamin" => "Laki-laki", "alamat" => "6 Hansons Parkway"],
            ["dosen_id" => 57, "status" => "non mahasiswa", "nik" => "531820506854", "email" => "ceddowis18@youku.com", "password" => bcrypt("12345678"), "phone" => "0827-1041-2369", "photoProfile" => null, "firstName" => "Celinka", "lastName" => "Eddowis", "jns_kelamin" => "Perempuan", "alamat" => "9830 Cottonwood Drive"],
            ["dosen_id" => 50, "status" => "non mahasiswa", "nik" => "023217426287", "email" => "nruske19@blogger.com", "password" => bcrypt("12345678"), "phone" => "0884-9168-2454", "photoProfile" => null, "firstName" => "Nerissa", "lastName" => "Ruske", "jns_kelamin" => "Perempuan", "alamat" => "91 Mitchell Road"],
            ["dosen_id" => 100, "status" => "mahasiswa", "nik" => "281601376112", "email" => "gmapledorum1a@storify.com", "password" => bcrypt("12345678"), "phone" => "0853-7484-4510", "photoProfile" => null, "firstName" => "Garwood", "lastName" => "Mapledorum", "jns_kelamin" => "Laki-laki", "alamat" => "68676 Doe Crossing Road"],
            ["dosen_id" => 29, "status" => "mahasiswa", "nik" => "680549248681", "email" => "kmccomas1b@lycos.com", "password" => bcrypt("12345678"), "phone" => "0834-2983-0298", "photoProfile" => null, "firstName" => "Klemens", "lastName" => "McComas", "jns_kelamin" => "Laki-laki", "alamat" => "815 Merrick Drive"],
            ["dosen_id" => 28, "status" => "non mahasiswa", "nik" => "533945829997", "email" => "gbenam1c@gov.uk", "password" => bcrypt("12345678"), "phone" => "0879-1177-0197", "photoProfile" => null, "firstName" => "Gui", "lastName" => "Benam", "jns_kelamin" => "Perempuan", "alamat" => "4 Prentice Lane"],
            ["dosen_id" => 19, "status" => "non mahasiswa", "nik" => "569905445033", "email" => "jmccart1d@typepad.com", "password" => bcrypt("12345678"), "phone" => "0868-2061-6219", "photoProfile" => null, "firstName" => "Jessie", "lastName" => "McCart", "jns_kelamin" => "Laki-laki", "alamat" => "99810 Elgar Place"],
            ["dosen_id" => 34, "status" => "mahasiswa", "nik" => "489230291157", "email" => "bdarragon1e@simplemachines.org", "password" => bcrypt("12345678"), "phone" => "0860-9552-9907", "photoProfile" => null, "firstName" => "Benjy", "lastName" => "Darragon", "jns_kelamin" => "Laki-laki", "alamat" => "1 6th Parkway"],
            ["dosen_id" => 56, "status" => "mahasiswa", "nik" => "563555892815", "email" => "pevins1f@prnewswire.com", "password" => bcrypt("12345678"), "phone" => "0817-0572-8614", "photoProfile" => null, "firstName" => "Penni", "lastName" => "Evins", "jns_kelamin" => "Perempuan", "alamat" => "960 Sunbrook Alley"],
            ["dosen_id" => 83, "status" => "mahasiswa", "nik" => "690202884615", "email" => "bbagnold1g@posterous.com", "password" => bcrypt("12345678"), "phone" => "0895-5492-1554", "photoProfile" => null, "firstName" => "Brigg", "lastName" => "Bagnold", "jns_kelamin" => "Laki-laki", "alamat" => "22437 Carey Drive"],
            ["dosen_id" => 51, "status" => "non mahasiswa", "nik" => "016337745752", "email" => "tburberow1h@ehow.com", "password" => bcrypt("12345678"), "phone" => "0846-3880-0109", "photoProfile" => null, "firstName" => "Tomasine", "lastName" => "Burberow", "jns_kelamin" => "Perempuan", "alamat" => "01090 Ohio Point"],
            ["dosen_id" => 10, "status" => "non mahasiswa", "nik" => "427226821174", "email" => "dgiocannoni1i@ycombinator.com", "password" => bcrypt("12345678"), "phone" => "0859-7786-5125", "photoProfile" => null, "firstName" => "Dyanne", "lastName" => "Giocannoni", "jns_kelamin" => "Perempuan", "alamat" => "39 Mallard Lane"],
            ["dosen_id" => 5, "status" => "mahasiswa", "nik" => "550080564618", "email" => "bkupec1j@whitehouse.gov", "password" => bcrypt("12345678"), "phone" => "0839-6176-8012", "photoProfile" => null, "firstName" => "Bee", "lastName" => "Kupec", "jns_kelamin" => "Perempuan", "alamat" => "853 Starling Pass"],
            ["dosen_id" => 54, "status" => "mahasiswa", "nik" => "591782207207", "email" => "ssayward1k@nps.gov", "password" => bcrypt("12345678"), "phone" => "0879-7301-9304", "photoProfile" => null, "firstName" => "Sibilla", "lastName" => "Sayward", "jns_kelamin" => "Perempuan", "alamat" => "208 Delladonna Alley"],
            ["dosen_id" => 35, "status" => "mahasiswa", "nik" => "969540853148", "email" => "rswigger1l@yandex.ru", "password" => bcrypt("12345678"), "phone" => "0868-5818-1635", "photoProfile" => null, "firstName" => "Rosabelle", "lastName" => "Swigger", "jns_kelamin" => "Perempuan", "alamat" => "5 Killdeer Plaza"],
            ["dosen_id" => 57, "status" => "non mahasiswa", "nik" => "697579471967", "email" => "frobjant1m@aol.com", "password" => bcrypt("12345678"), "phone" => "0804-2393-5581", "photoProfile" => null, "firstName" => "Faina", "lastName" => "Robjant", "jns_kelamin" => "Perempuan", "alamat" => "2 Mendota Center"],
            ["dosen_id" => 7, "status" => "mahasiswa", "nik" => "679928226654", "email" => "astlouis1n@slideshare.net", "password" => bcrypt("12345678"), "phone" => "0837-7933-3082", "photoProfile" => null, "firstName" => "Amandi", "lastName" => "St Louis", "jns_kelamin" => "Perempuan", "alamat" => "48890 Daystar Avenue"],
            ["dosen_id" => 12, "status" => "mahasiswa", "nik" => "441468922471", "email" => "jpotte1o@imgur.com", "password" => bcrypt("12345678"), "phone" => "0874-3242-6808", "photoProfile" => null, "firstName" => "Josepha", "lastName" => "Potte", "jns_kelamin" => "Perempuan", "alamat" => "4 Schmedeman Place"],
            ["dosen_id" => 49, "status" => "non mahasiswa", "nik" => "910489626707", "email" => "psline1p@blogspot.com", "password" => bcrypt("12345678"), "phone" => "0866-6260-8317", "photoProfile" => null, "firstName" => "Poppy", "lastName" => "Sline", "jns_kelamin" => "Perempuan", "alamat" => "326 Westerfield Drive"],
            ["dosen_id" => 9, "status" => "non mahasiswa", "nik" => "471764364867", "email" => "sginnety1q@ebay.co.uk", "password" => bcrypt("12345678"), "phone" => "0839-4874-0510", "photoProfile" => null, "firstName" => "Sloan", "lastName" => "Ginnety", "jns_kelamin" => "Laki-laki", "alamat" => "510 Maple Center"],
            ["dosen_id" => 47, "status" => "mahasiswa", "nik" => "041125433684", "email" => "gcicconettii1r@google.es", "password" => bcrypt("12345678"), "phone" => "0821-9275-7150", "photoProfile" => null, "firstName" => "Georgia", "lastName" => "Cicconettii", "jns_kelamin" => "Perempuan", "alamat" => "32 Hazelcrest Junction"],
            ["dosen_id" => 73, "status" => "non mahasiswa", "nik" => "358897112122", "email" => "sfolds1s@webeden.co.uk", "password" => bcrypt("12345678"), "phone" => "0819-6040-6858", "photoProfile" => null, "firstName" => "Sharleen", "lastName" => "Folds", "jns_kelamin" => "Perempuan", "alamat" => "1 Bartelt Crossing"],
            ["dosen_id" => 20, "status" => "non mahasiswa", "nik" => "858240810406", "email" => "wstrutley1t@so-net.ne.jp", "password" => bcrypt("12345678"), "phone" => "0806-4738-9726", "photoProfile" => null, "firstName" => "Willow", "lastName" => "Strutley", "jns_kelamin" => "Perempuan", "alamat" => "908 Sherman Lane"],
            ["dosen_id" => 55, "status" => "mahasiswa", "nik" => "928936904207", "email" => "gstratford1u@jigsy.com", "password" => bcrypt("12345678"), "phone" => "0847-0419-7030", "photoProfile" => null, "firstName" => "Gerty", "lastName" => "Stratford", "jns_kelamin" => "Perempuan", "alamat" => "26160 Carioca Hill"],
            ["dosen_id" => 100, "status" => "mahasiswa", "nik" => "327660696755", "email" => "troller1v@list-manage.com", "password" => bcrypt("12345678"), "phone" => "0898-9839-2287", "photoProfile" => null, "firstName" => "Talbert", "lastName" => "Roller", "jns_kelamin" => "Laki-laki", "alamat" => "5776 Portage Street"],
            ["dosen_id" => 96, "status" => "mahasiswa", "nik" => "073046258965", "email" => "mgarbar1w@wikia.com", "password" => bcrypt("12345678"), "phone" => "0894-8256-3100", "photoProfile" => null, "firstName" => "Micheil", "lastName" => "Garbar", "jns_kelamin" => "Laki-laki", "alamat" => "3275 Prairie Rose Circle"],
            ["dosen_id" => 69, "status" => "mahasiswa", "nik" => "009515306292", "email" => "talelsandrovich1x@cnet.com", "password" => bcrypt("12345678"), "phone" => "0818-7736-3683", "photoProfile" => null, "firstName" => "Tremayne", "lastName" => "Alelsandrovich", "jns_kelamin" => "Laki-laki", "alamat" => "88 Shasta Crossing"],
            ["dosen_id" => 79, "status" => "mahasiswa", "nik" => "771652050543", "email" => "mpascall1y@simplemachines.org", "password" => bcrypt("12345678"), "phone" => "0855-2326-1132", "photoProfile" => null, "firstName" => "Mace", "lastName" => "Pascall", "jns_kelamin" => "Laki-laki", "alamat" => "6 Dennis Crossing"],
            ["dosen_id" => 17, "status" => "mahasiswa", "nik" => "189814116682", "email" => "jmaffeo1z@reddit.com", "password" => bcrypt("12345678"), "phone" => "0868-5226-8113", "photoProfile" => null, "firstName" => "Joanie", "lastName" => "Maffeo", "jns_kelamin" => "Perempuan", "alamat" => "56152 Norway Maple Parkway"],
            ["dosen_id" => 76, "status" => "non mahasiswa", "nik" => "089633835986", "email" => "kmohan20@psu.edu", "password" => bcrypt("12345678"), "phone" => "0886-4868-4019", "photoProfile" => null, "firstName" => "Kyle", "lastName" => "Mohan", "jns_kelamin" => "Perempuan", "alamat" => "6850 Westridge Trail"],
            ["dosen_id" => 84, "status" => "non mahasiswa", "nik" => "419791366729", "email" => "lklisch21@digg.com", "password" => bcrypt("12345678"), "phone" => "0836-2859-8891", "photoProfile" => null, "firstName" => "Lisette", "lastName" => "Klisch", "jns_kelamin" => "Perempuan", "alamat" => "47979 Harper Pass"],
            ["dosen_id" => 30, "status" => "mahasiswa", "nik" => "567209951922", "email" => "mveal22@howstuffworks.com", "password" => bcrypt("12345678"), "phone" => "0830-2984-0320", "photoProfile" => null, "firstName" => "Martguerita", "lastName" => "Veal", "jns_kelamin" => "Perempuan", "alamat" => "12389 Cambridge Pass"],
            ["dosen_id" => 42, "status" => "mahasiswa", "nik" => "017711811182", "email" => "mthridgould23@sohu.com", "password" => bcrypt("12345678"), "phone" => "0843-3529-1199", "photoProfile" => null, "firstName" => "Madelaine", "lastName" => "Thridgould", "jns_kelamin" => "Perempuan", "alamat" => "85 Swallow Park"],
            ["dosen_id" => 50, "status" => "mahasiswa", "nik" => "929754684124", "email" => "acrumpe24@cdbaby.com", "password" => bcrypt("12345678"), "phone" => "0831-7727-7103", "photoProfile" => null, "firstName" => "Amberly", "lastName" => "Crumpe", "jns_kelamin" => "Perempuan", "alamat" => "7976 Evergreen Trail"],
            ["dosen_id" => 100, "status" => "mahasiswa", "nik" => "103647508084", "email" => "lpol25@washington.edu", "password" => bcrypt("12345678"), "phone" => "0836-2391-6282", "photoProfile" => null, "firstName" => "Lark", "lastName" => "Pol", "jns_kelamin" => "Perempuan", "alamat" => "39 Ryan Way"],
            ["dosen_id" => 91, "status" => "non mahasiswa", "nik" => "118613306408", "email" => "jlowdes26@php.net", "password" => bcrypt("12345678"), "phone" => "0897-6961-8725", "photoProfile" => null, "firstName" => "Joya", "lastName" => "Lowdes", "jns_kelamin" => "Perempuan", "alamat" => "2 Clove Avenue"],
            ["dosen_id" => 4, "status" => "mahasiswa", "nik" => "156312396271", "email" => "awatkinson27@rediff.com", "password" => bcrypt("12345678"), "phone" => "0884-0314-9687", "photoProfile" => null, "firstName" => "Agosto", "lastName" => "Watkinson", "jns_kelamin" => "Laki-laki", "alamat" => "8290 Dennis Circle"],
            ["dosen_id" => 6, "status" => "non mahasiswa", "nik" => "546998464119", "email" => "erableau28@wsj.com", "password" => bcrypt("12345678"), "phone" => "0835-2906-4917", "photoProfile" => null, "firstName" => "Eberto", "lastName" => "Rableau", "jns_kelamin" => "Laki-laki", "alamat" => "7 Banding Lane"],
            ["dosen_id" => 69, "status" => "mahasiswa", "nik" => "823880902551", "email" => "boloughran29@imageshack.us", "password" => bcrypt("12345678"), "phone" => "0835-1430-1880", "photoProfile" => null, "firstName" => "Bobbi", "lastName" => "O' Loughran", "jns_kelamin" => "Perempuan", "alamat" => "1 Lien Place"],
            ["dosen_id" => 32, "status" => "non mahasiswa", "nik" => "623976116722", "email" => "cdunstone2a@house.gov", "password" => bcrypt("12345678"), "phone" => "0829-4332-9395", "photoProfile" => null, "firstName" => "Cal", "lastName" => "Dunstone", "jns_kelamin" => "Perempuan", "alamat" => "46 Fremont Place"],
            ["dosen_id" => 64, "status" => "mahasiswa", "nik" => "883340666789", "email" => "obrunke2b@google.com", "password" => bcrypt("12345678"), "phone" => "0868-2877-5377", "photoProfile" => null, "firstName" => "Ozzy", "lastName" => "Brunke", "jns_kelamin" => "Laki-laki", "alamat" => "8499 Sutteridge Terrace"],
            ["dosen_id" => 9, "status" => "non mahasiswa", "nik" => "422305735983", "email" => "ebirdall2c@rediff.com", "password" => bcrypt("12345678"), "phone" => "0865-7109-4498", "photoProfile" => null, "firstName" => "Earvin", "lastName" => "Birdall", "jns_kelamin" => "Laki-laki", "alamat" => "83942 Warrior Road"],
            ["dosen_id" => 81, "status" => "non mahasiswa", "nik" => "725163514886", "email" => "dsamsonsen2d@vimeo.com", "password" => bcrypt("12345678"), "phone" => "0872-4934-6979", "photoProfile" => null, "firstName" => "Dietrich", "lastName" => "Samsonsen", "jns_kelamin" => "Laki-laki", "alamat" => "4 Reindahl Parkway"],
            ["dosen_id" => 94, "status" => "non mahasiswa", "nik" => "337908220180", "email" => "gpresshaugh2e@indiegogo.com", "password" => bcrypt("12345678"), "phone" => "0888-4766-7288", "photoProfile" => null, "firstName" => "Grenville", "lastName" => "Presshaugh", "jns_kelamin" => "Laki-laki", "alamat" => "9293 Ramsey Terrace"],
            ["dosen_id" => 30, "status" => "mahasiswa", "nik" => "743148934736", "email" => "glagneaux2f@blinklist.com", "password" => bcrypt("12345678"), "phone" => "0813-5389-0819", "photoProfile" => null, "firstName" => "Geoffry", "lastName" => "Lagneaux", "jns_kelamin" => "Laki-laki", "alamat" => "7169 Bobwhite Point"],
            ["dosen_id" => 16, "status" => "non mahasiswa", "nik" => "115938031133", "email" => "gdainton2g@virginia.edu", "password" => bcrypt("12345678"), "phone" => "0829-0278-7548", "photoProfile" => null, "firstName" => "Gregoire", "lastName" => "Dainton", "jns_kelamin" => "Laki-laki", "alamat" => "50 Carioca Plaza"],
            ["dosen_id" => 6, "status" => "mahasiswa", "nik" => "263585393178", "email" => "mchappel2h@theatlantic.com", "password" => bcrypt("12345678"), "phone" => "0842-7499-0260", "photoProfile" => null, "firstName" => "Mary", "lastName" => "Chappel", "jns_kelamin" => "Perempuan", "alamat" => "336 Florence Point"],
            ["dosen_id" => 5, "status" => "non mahasiswa", "nik" => "385741334742", "email" => "ehaycraft2i@google.cn", "password" => bcrypt("12345678"), "phone" => "0853-8730-3916", "photoProfile" => null, "firstName" => "Ellsworth", "lastName" => "Haycraft", "jns_kelamin" => "Laki-laki", "alamat" => "0984 Anzinger Drive"],
            ["dosen_id" => 90, "status" => "mahasiswa", "nik" => "256351203206", "email" => "abolstridge2j@friendfeed.com", "password" => bcrypt("12345678"), "phone" => "0845-6175-5994", "photoProfile" => null, "firstName" => "Annelise", "lastName" => "Bolstridge", "jns_kelamin" => "Perempuan", "alamat" => "924 Troy Road"],
            ["dosen_id" => 29, "status" => "mahasiswa", "nik" => "621908718258", "email" => "sespina2k@tiny.cc", "password" => bcrypt("12345678"), "phone" => "0848-7407-5434", "photoProfile" => null, "firstName" => "Seymour", "lastName" => "Espina", "jns_kelamin" => "Laki-laki", "alamat" => "1 Graedel Alley"],
            ["dosen_id" => 83, "status" => "mahasiswa", "nik" => "736778733129", "email" => "tmarusik2l@hostgator.com", "password" => bcrypt("12345678"), "phone" => "0818-9486-6152", "photoProfile" => null, "firstName" => "Tallou", "lastName" => "Marusik", "jns_kelamin" => "Perempuan", "alamat" => "0 Forest Run Place"],
            ["dosen_id" => 74, "status" => "non mahasiswa", "nik" => "807136474406", "email" => "ciacapucci2m@51.la", "password" => bcrypt("12345678"), "phone" => "0899-7710-8348", "photoProfile" => null, "firstName" => "Ciel", "lastName" => "Iacapucci", "jns_kelamin" => "Perempuan", "alamat" => "7471 Leroy Avenue"],
            ["dosen_id" => 94, "status" => "mahasiswa", "nik" => "422366440079", "email" => "vmcclaughlin2n@bloglines.com", "password" => bcrypt("12345678"), "phone" => "0878-7444-8272", "photoProfile" => null, "firstName" => "Valentia", "lastName" => "McClaughlin", "jns_kelamin" => "Perempuan", "alamat" => "39931 Judy Street"],
            ["dosen_id" => 35, "status" => "non mahasiswa", "nik" => "905012008110", "email" => "fdawley2o@rakuten.co.jp", "password" => bcrypt("12345678"), "phone" => "0846-5119-0335", "photoProfile" => null, "firstName" => "Fawne", "lastName" => "Dawley", "jns_kelamin" => "Perempuan", "alamat" => "8 Cordelia Crossing"],
            ["dosen_id" => 79, "status" => "mahasiswa", "nik" => "100114209508", "email" => "jpadginton2p@java.com", "password" => bcrypt("12345678"), "phone" => "0863-9354-8937", "photoProfile" => null, "firstName" => "Jan", "lastName" => "Padginton", "jns_kelamin" => "Laki-laki", "alamat" => "4690 Parkside Center"],
            ["dosen_id" => 73, "status" => "mahasiswa", "nik" => "481181828513", "email" => "mgartenfeld2q@qq.com", "password" => bcrypt("12345678"), "phone" => "0808-7310-0951", "photoProfile" => null, "firstName" => "Maris", "lastName" => "Gartenfeld", "jns_kelamin" => "Perempuan", "alamat" => "38345 4th Terrace"],
            ["dosen_id" => 94, "status" => "Female", "nik" => "905136468127", "email" => "tscotcher2r@opera.com", "password" => bcrypt("12345678"), "phone" => "0885-2532-8900", "photoProfile" => null, "firstName" => "Tommy", "lastName" => "Scotcher", "jns_kelamin" => "Male", "alamat" => "992 Del Mar Center"]
        ];

        foreach ($asdos as $data) {
            $user = User::create([
                'email' => $data['email'],
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'password' => $data['password'],
                "email_verified_at" => now(),
                "role" => 3,
            ]);

            Asdos::create([
                "user_id" => $user->id,
                "dosen_id" => $data["dosen_id"],
                "status" => $data["status"],
                "nik" => $data["nik"],
                "email" => $data["email"],
                "phone" => $data["phone"],
                "photoProfile" => $data["photoProfile"],
                "firstName" => $data["firstName"],
                "lastName" => $data["lastName"],
                "jns_kelamin" => $data["jns_kelamin"],
                "alamat" => $data["alamat"],
            ]);
        }
    }
}