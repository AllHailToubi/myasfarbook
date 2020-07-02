<?php

namespace Modules\Hotel\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Hotel\Entities\Hotel;

class SeedCreateHotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $this->addHotel();
        //$this->SoftdeleteHotel(3,true);
        //$this->restoreHotel(3);
        //Hotel::deleteID(6);
        //Hotel::forcedeleteID(6);
         
        
    }

    public function addHotel(){
        Hotel::create([
            'name' => 'HOTEL LE CHAMONIX',
            'agency_id' => "1",
            'shortdesc' => "climatisation, WiFi, téléphone, cuisine, machine à laver ",
            'fulldesc'=> "Cet hôtel 3 étoiles offre 64 spacieuses chambres dotées de climatisation, accès à Internet WiFi, téléphone, cuisine, machine à laver et télévision satellite ou câble. En plus, l'hôtel dispose de bar, cafétéria, piscine extérieure et une salle de jeux et de TV.",
            'address'=>"Avenue de la marche vert hay riad",
            'city'=>"IFRANE",
            'country'=>"MAROC",
            'map_lat'=>"33.528698",
            'map_lng'=>"-5.106402",
            'map_zoom'=>"15",
            'star_rate'=>"3",
            'reviews_rate'=>"0",
            'reviews_number'=>"0",
        ]);

        // Hotel::create([
        //     'name' => 'BARCELO FES MEDINA',
        //     'shortdesc' => "Il est situé dans les limites de la cité impériale de Fès...",
        //     'fulldesc'=> "L'hôtel Barceló Fès Medina **** est un havre de paix au coeur de la médina. Il est situé dans les limites de la cité impériale de Fès, première ville impériale marocaine déclarée patrimoine mondial de l'humanité par l'UNESCO. Cet hôtel récent allie confort et fonctionnalité, comme en témoignent ses chambres décorées dans un style contemporain et son mobilier au design moderne. L'hôtel Barceló Fès Medina dispose d'un centre d'affaires de 300 m², d'un centre de remise en forme et de bien-être, d'un spa, d'un magnifique hammam (bain turc), d'une piscine, d'une connexion Wi-Fi gratuite et d'un remarquable restaurant international (l'Azahar), où vous pourrez savourer un dîner marocain traditionnel.",
        //     'address'=>"53 AVENUE HASSAN 2",
        //     'city'=>"FES",
        //     'country'=>"MAROC",
        //     'map_lat'=>"34.043591",
        //     'map_lng'=>"-4.997289",
        //     'map_zoom'=>"15",
        //     'star_rate'=>"5",
        //     'reviews_rate'=>"0",
        //     'reviews_number'=>"0",
        // ]);

        // Hotel::create([
        //     'name' => 'IBEROSTAR SAIDIA',
        //     'shortdesc' => "Spa, golf, détente, gastronomie, plages à perte de vue...",
        //     'fulldesc'=> "Spa, golf, détente, gastronomie, plages à perte de vue... tous ces ingrédients sont au menu de l'hôtel de luxe Iberostar Saïdia, un paradis où vos rêves deviendront réalité L'hôtel Iberostar Saïdia se trouve dans un paradis entouré de cordillères majestueuses, de villes charmantes et d'une oasis de palmiers au coeur du Sahara. Un véritable paradis digne d'un 5 étoiles vous attend : un spa où vous pourrez vous détendre, des piscines aux formes interminables, des circuits dans les montagnes de Beni Snassen, la meilleure gastronomie nationale et internationale, et probablement les chambres les plus luxueuses du Maroc. Vous aurez, à vos pieds, une superbe plage longue de 14 kilomètres. Un vrai plaisir pour les sens vous attend à l'hôtel Iberostar Saïdia.   Les Tarifs Affichés sont Minimum Stay 4 Nuits.",
        //     'address'=>"SAIDIA BERKANE",
        //     'city'=>"SAIDIA",
        //     'country'=>"MAROC",
        //     'map_lat'=>"35.103095",
        //     'map_lng'=>"-2.282023",
        //     'map_zoom'=>"15",
        //     'star_rate'=>"5",
        //     'reviews_rate'=>"0",
        //     'reviews_number'=>"0",
        // ]);




    }

    

    
}
