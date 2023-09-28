<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Makes;
use App\Models\Models;
use App\Models\Option;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::insertGetId([
            'name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        $user = User::factory()->create([
            'name' => 'Marsad Akbar',
            'email' => 'marsadakbar1@gmail.com',
            'role_id' => $role,
            'status' => 1,
            'password' => Hash::make("secret"),
        ]);
        $user->syncRoles([$role]);

        Service::factory(2)->create();
        Option::factory(2)->create();

        $names = [
            'Alfa',
            'Audi',
            'Bentley',
            'BMW',
            'Buick',
            'Cadillac',
            'Chevrolet ',
            'Chrysler ',
            'Dodge ',
            'Eagle',
            'Ferrari',
            'Fiat',
            'Ford',
            'Freightliner',
            'GMC',
            'Honda',
            'Hummer',
            'Hyundai ',
            'Infiniti ',
            'Isuzu',
            'Jaguar',
            'Jeep',
            'Kawasaki',
            'Kia',
            'Land Rover',
            'Lexus',
            'Lincoln ',
            'Maserati',
            'Mazda',
            'Mercedes',
            'Mercury ',
            'Mini',
            'Mitsubishi',
            'Nissan',
            'Oldsmobile ',
            'Plymouth',
            'Pontiac ',
            'Porsche',
            'Ram',
            'Saab',
            'Saturn',
            'Scion',
            'Smart',
            'Subaru ',
            'Suzuki ',
            'Toyota',
            'Volkswagen',
            'Volvo',
        ];
        foreach ($names as $name) {
            Makes::create([
                'name' => $name,
            ]);
        }

        $models = [
            'F-150' => 'Ford',
            'CL' => 'Acura',
            'Integra' => 'Acura',
            'RL' => 'Acura',
            'TL' => 'Acura',
            'NSX' => 'Acura',
            'Accord' => 'Honda',
            'csx' => 'Acura',
            'Corolla' => 'Toyota',
            'All' => 'Audi',
            'Avalon' => 'Toyota',
            'RAV4' => 'Toyota',
            'LS500' => 'Lexus',
            'UX200' => 'Lexus',
            'Bronco' => 'Ford',
            'Edge' => 'Ford',
            'Mach E Mustang' => 'Ford',
            'Rogue' => 'Nissan',
            'Sentra' => 'Nissan',
            'Pathfinder' => 'Nissan',
            'Outlander' => 'Mitsubishi',
            'Jetta' => 'Volkswagen',
            '4Runner' => 'Toyota',
            'Sequoia' => 'Toyota',
            'Sienna' => 'Toyota',
            'GS300' => 'Lexus',
            'IS300' => 'Lexus',
            'SC300' => 'Lexus',
            '9-3 Spare' => 'Saab',
            '9-3 AKL' => 'Saab',
            '9-5 Spare' => 'Saab',
            '9-5 AKL' => 'Saab',
            'A4' => 'Audi',
            'A5' => 'Audi',
            'S4' => 'Audi',
            'S5' => 'Audi',
            'TT' => 'Audi',
            '3 Series' => 'BMW',
            'Civic ' => 'Honda',
            'CR-V' => 'Honda',
            'Odyssey' => 'Honda',
            'Pilot' => 'Honda',
            'Element' => 'Honda',
            'Fit' => 'Honda',
            'Insight' => 'Honda',
            'Ridgeline' => 'Honda',
            'MDX' => 'Acura',
            'Transit connect ' => 'Ford',
            'Romeo Stelvio ' => 'Alfa',
            'Romeo Giulia' => 'Alfa',
            'Romeo Mito' => 'Alfa',
            'Romeo Giulietta ' => 'Alfa',
            'Jimmy S-15 ' => 'GMC',
            'J30 -  Spare ' => 'Infiniti',
            'Prelude' => 'Honda',
            'Camry' => 'Toyota',
            'Highlander' => 'Toyota',
            'Landcruiser' => 'Toyota',
            'MR2' => 'Toyota',
            'Prius' => 'Toyota',
            'Solara' => 'Toyota',
            'ES300' => 'Lexus',
            'ES330' => 'Lexus',
            'GS400' => 'Lexus',
            'GS430' => 'Lexus',
            'GX470' => 'Lexus',
            'LS400' => 'Lexus',
            'LS430' => 'Lexus',
            'LX470' => 'Lexus',
            'RX300' => 'Lexus',
            'RX330' => 'Lexus',
            'SC400' => 'Lexus',
            'SC430' => 'Lexus',
            'Sprinter' => 'Mercedes',
            'X1' => 'BMW',
            'X2' => 'BMW',
            'X5' => 'BMW',
            'X6' => 'BMW',
            '4 Series' => 'BMW',
            'FourTwo' => 'Smart',
            'All' => 'Bentley',
            'All' => 'Maserati',
            'All' => 'Fiat',
            'All' => 'Mini',
            'ALL' => 'Volvo',
            'Q5' => 'Audi',
            'Q7' => 'Audi',
            'A3' => 'Audi',
            'A6' => 'Audi',
            'A7' => 'Audi',
            'A8' => 'Audi',
            'Crown Victoria' => 'Ford',
            'E-Series' => 'Ford',
            'Econoline' => 'Ford',
            'Escape' => 'Ford',
            'Escort' => 'Ford',
            'Expedition' => 'Ford',
            'Explorer' => 'Ford',
            'F-250' => 'Ford',
            'F-350' => 'Ford',
            'Fiesta' => 'Ford',
            'Flex' => 'Ford',
            'Focus' => 'Ford',
            'Fusion' => 'Ford',
            'Mustang' => 'Ford',
            'Ranger' => 'Ford',
            'Raptor' => 'Ford',
            'Taurus' => 'Ford',
            'Transit' => 'Ford',
            'ILX' => 'Acura',
            'RDX' => 'Acura',
            'RLX' => 'Acura',
            'SLX' => 'Acura',
            'TLX' => 'Acura',
            'TSX' => 'Acura',
            'ZDX' => 'Acura',
            'EL' => 'Acura',
            'CLX' => 'Acura',
            'RSK' => 'Acura',
            'Allure' => 'Buick',
            'Apollo' => 'Buick',
            'Avenir' => 'Buick',
            'Casada' => 'Buick',
            'Centurion' => 'Buick',
            'Century' => 'Buick',
            'Electra' => 'Buick',
            'Enclave' => 'Buick',
            'Encore' => 'Buick',
            'Envision' => 'Buick',
            'Estate' => 'Buick',
            'La Sabre' => 'Buick',
            'LaCrosse' => 'Buick',
            'LeSabre' => 'Buick',
            'Lucerne' => 'Buick',
            'Park Avenue' => 'Buick',
            'Rainier' => 'Buick',
            'Reatta' => 'Buick',
            'Regal' => 'Buick',
            'Rendezvous' => 'Buick',
            'Riviera' => 'Buick',
            'Roadmaster' => 'Buick',
            'Signia' => 'Buick',
            'Skyhawk' => 'Buick',
            'Skylark' => 'Buick',
            'Somerset' => 'Buick',
            'Terraza' => 'Buick',
            'Verano' => 'Buick',
            'Wildcat' => 'Buick',
            'Cascada' => 'Buick',
            'Allante' => 'Cadillac',
            'ATS' => 'Cadillac',
            'Brougham' => 'Cadillac',
            'BRX' => 'Cadillac',
            'Calais' => 'Cadillac',
            'Catera' => 'Cadillac',
            'Cimarron' => 'Cadillac',
            'CT4' => 'Cadillac',
            'CT5' => 'Cadillac',
            'CT6' => 'Cadillac',
            'CTS' => 'Cadillac',
            'Deville' => 'Cadillac',
            'DTS' => 'Cadillac',
            'Eldorado' => 'Cadillac',
            'ELR' => 'Cadillac',
            'Escalade' => 'Cadillac',
            'Fleetwood' => 'Cadillac',
            'Seville' => 'Cadillac',
            'SRX' => 'Cadillac',
            'STS' => 'Cadillac',
            'XLR' => 'Cadillac',
            'XT3' => 'Cadillac',
            'XT4' => 'Cadillac',
            'XT5' => 'Cadillac',
            'XT6' => 'Cadillac',
            'XTS' => 'Cadillac',
            'Astro' => 'Chevrolet',
            'Avalanche' => 'Chevrolet',
            'Aveo' => 'Chevrolet',
            'Beretta' => 'Chevrolet',
            'Blazer' => 'Chevrolet',
            'Bolt' => 'Chevrolet',
            'Camaro' => 'Chevrolet',
            'Caprice' => 'Chevrolet',
            'Captiva' => 'Chevrolet',
            'Cavalier' => 'Chevrolet',
            'Celebrity' => 'Chevrolet',
            'Chevelle' => 'Chevrolet',
            'Chevette' => 'Chevrolet',
            'Citation' => 'Chevrolet',
            'City Express' => 'Chevrolet',
            'Cobalt' => 'Chevrolet',
            'Colorado' => 'Chevrolet',
            'Corsica' => 'Chevrolet',
            'Corvette' => 'Chevrolet',
            'Cruze' => 'Chevrolet',
            'Edita' => 'Chevrolet',
            'El Camino' => 'Chevrolet',
            'Epica' => 'Chevrolet',
            'Equinox' => 'Chevrolet',
            'Eurosport' => 'Chevrolet',
            'Express' => 'Chevrolet',
            'HHR' => 'Chevrolet',
            'Impala' => 'Chevrolet',
            'Kodiak' => 'Chevrolet',
            'Lumina' => 'Chevrolet',
            'Malibu' => 'Chevrolet',
            'Monte Carlo' => 'Chevrolet',
            'Monza' => 'Chevrolet',
            'Nova' => 'Chevrolet',
            'Optra' => 'Chevrolet',
            'Prizm' => 'Chevrolet',
            'S10' => 'Chevrolet',
            'Silverado' => 'Chevrolet',
            'Sonic' => 'Chevrolet',
            'Spark' => 'Chevrolet',
            'SS' => 'Chevrolet',
            'SSR' => 'Chevrolet',
            'Suburban' => 'Chevrolet',
            'Tahoe' => 'Chevrolet',
            'Trailblazer' => 'Chevrolet',
            'Traverse' => 'Chevrolet',
            'Trax' => 'Chevrolet',
            'Uplander' => 'Chevrolet',
            'Vega' => 'Chevrolet',
            'Venture' => 'Chevrolet',
            'Vivant' => 'Chevrolet',
            'Volt' => 'Chevrolet',
            '200' => 'Chrysler',
            '300' => 'Chrysler',
            '300M' => 'Chrysler',
            '5th Avenue' => 'Chrysler',
            'Aspen' => 'Chrysler',
            'Caravelle' => 'Chrysler',
            'Cirrus' => 'Chrysler',
            'Concorde' => 'Chrysler',
            'Dakota' => 'Chrysler',
            'Daytona' => 'Chrysler',
            'Diplomat' => 'Chrysler',
            'Expo' => 'Chrysler',
            'Grand Voyager' => 'Chrysler',
            'Imperial' => 'Chrysler',
            'LeBaron' => 'Chrysler',
            'LHS' => 'Chrysler',
            'Neon' => 'Chrysler',
            'New Yorker' => 'Chrysler',
            'Pacifica' => 'Chrysler',
            'Prowler' => 'Chrysler',
            'PT Cruiser' => 'Chrysler',
            'Sebring' => 'Chrysler',
            'Spirit' => 'Chrysler',
            'Stratus' => 'Chrysler',
            'Town & Country' => 'Chrysler',
            'Voyager' => 'Chrysler',
            'Avenger' => 'Dodge',
            'C/V' => 'Dodge',
            'Caliber' => 'Dodge',
            'Caravan' => 'Dodge',
            'Challenger' => 'Dodge',
            'Charger' => 'Dodge',
            'Dakota' => 'Dodge',
            'Dart' => 'Dodge',
            'Daytona' => 'Dodge',
            'Durango' => 'Dodge',
            'Dynasty' => 'Dodge',
            'Intrepid' => 'Dodge',
            'Journey' => 'Dodge',
            'Magnum' => 'Dodge',
            'Neon' => 'Dodge',
            'Nitro' => 'Dodge',
            'Omni' => 'Dodge',
            'Ram' => 'Dodge',
            'Shadow' => 'Dodge',
            'Spirit' => 'Dodge',
            'Stealth' => 'Dodge',
            'Stratus' => 'Dodge',
            'Trail' => 'Dodge',
            'Viper' => 'Dodge',
            'Acadia' => 'GMC',
            'Bravada' => 'GMC',
            'C5' => 'GMC',
            'C6' => 'GMC',
            'C7' => 'GMC',
            'Caballero' => 'GMC',
            'Canyon' => 'GMC',
            'Envoy' => 'GMC',
            'Jimmy' => 'GMC',
            'Safari' => 'GMC',
            'Savana' => 'GMC',
            'Sierra' => 'GMC',
            'Sonoma' => 'GMC',
            'Terrain' => 'GMC',
            'Tiltmaster' => 'GMC',
            'TopKick' => 'GMC',
            'Yukon' => 'GMC',
            '599' => 'Honda',
            '919' => 'Honda',
            'Bali' => 'Honda',
            'Big Ruckus' => 'Honda',
            'CBF' => 'Honda',
            'CBR' => 'Honda',
            'Clarity' => 'Honda',
            'CR-Z' => 'Honda',
            'Crosstour' => 'Honda',
            'CRX' => 'Honda',
            'Del Sol' => 'Honda',
            'DN-01' => 'Honda',
            'Firestorm' => 'Honda',
            'Forza' => 'Honda',
            'Hornet' => 'Honda',
            'HRV' => 'Honda',
            'Interceptor' => 'Honda',
            'NTV' => 'Honda',
            'NX' => 'Honda',
            'Passport' => 'Honda',
            'S2000' => 'Honda',
            'SFX' => 'Honda',
            'SH' => 'Honda',
            'Silverwing' => 'Honda',
            'ST' => 'Honda',
            'Super Blackbird' => 'Honda',
            'Superhawk' => 'Honda',
            'VFR' => 'Honda',
            'VTR' => 'Honda',
            'HR-V' => 'Honda',
            'H1' => 'Hummer',
            'H2' => 'Hummer',
            'H3' => 'Hummer',
            'Accent' => 'Hyundai',
            'Azera' => 'Hyundai',
            'Borrego' => 'Hyundai',
            'Elantra' => 'Hyundai',
            'Entourage' => 'Hyundai',
            'Equus' => 'Hyundai',
            'Forte' => 'Hyundai',
            'Genesis' => 'Hyundai',
            'Ioniq' => 'Hyundai',
            'Kona' => 'Hyundai',
            'Nexo' => 'Hyundai',
            'Palisade' => 'Hyundai',
            'Santa Fe' => 'Hyundai',
            'Sonata' => 'Hyundai',
            'Sportage' => 'Hyundai',
            'Tiburon' => 'Hyundai',
            'Tucson' => 'Hyundai',
            'Veloster' => 'Hyundai',
            'Venue' => 'Hyundai',
            'Veracruz' => 'Hyundai',
            'XG300' => 'Hyundai',
            'XG350' => 'Hyundai',
            '200SX' => 'Infiniti',
            '240SX' => 'Infiniti',
            'EX35' => 'Infiniti',
            'EX37' => 'Infiniti',
            'FX35' => 'Infiniti',
            'FX37' => 'Infiniti',
            'FX45' => 'Infiniti',
            'FX50' => 'Infiniti',
            'G20' => 'Infiniti',
            'G25' => 'Infiniti',
            'G35' => 'Infiniti',
            'G37' => 'Infiniti',
            'I30' => 'Infiniti',
            'I35' => 'Infiniti',
            'JX' => 'Infiniti',
            'JX35' => 'Infiniti',
            'M30' => 'Infiniti',
            'M35' => 'Infiniti',
            'M37' => 'Infiniti',
            'M45' => 'Infiniti',
            'M56' => 'Infiniti',
            'Q40' => 'Infiniti',
            'Q45' => 'Infiniti',
            'Q50' => 'Infiniti',
            'Q60' => 'Infiniti',
            'Q70' => 'Infiniti',
            'QX30' => 'Infiniti',
            'QX4' => 'Infiniti',
            'QX50' => 'Infiniti',
            'QX56' => 'Infiniti',
            'QX60' => 'Infiniti',
            'QX70' => 'Infiniti',
            'QX80' => 'Infiniti',
            'J30' => 'Infiniti',
            'Cherokee' => 'Jeep',
            'Comanche' => 'Jeep',
            'Commander' => 'Jeep',
            'Compass' => 'Jeep',
            'Gladiator' => 'Jeep',
            'Grand Cherokee' => 'Jeep',
            'Grand Wagoneer' => 'Jeep',
            'Laredo' => 'Jeep',
            'Liberty' => 'Jeep',
            'Patriot' => 'Jeep',
            'Renegade' => 'Jeep',
            'Rubicon' => 'Jeep',
            'Trailhawk' => 'Jeep',
            'Wagoneer' => 'Jeep',
            'Wrangler' => 'Jeep',
            'Amanti' => 'Kia',
            'Borrego' => 'Kia',
            'Cadenza' => 'Kia',
            'Carnival' => 'Kia',
            'EV6' => 'Kia',
            'Forte' => 'Kia',
            'K5' => 'Kia',
            'K900' => 'Kia',
            'Magentis' => 'Kia',
            'Niro' => 'Kia',
            'Optima' => 'Kia',
            'Rio' => 'Kia',
            'Rondo' => 'Kia',
            'Sedona' => 'Kia',
            'Seltos' => 'Kia',
            'Sephia' => 'Kia',
            'Sorento' => 'Kia',
            'Soul' => 'Kia',
            'Spectra' => 'Kia',
            'Sportage' => 'Kia',
            'Stinger' => 'Kia',
            'Telluride' => 'Kia',
            'CT200H' => 'Lexus',
            'ES250' => 'Lexus',
            'ES350' => 'Lexus',
            'GS-F' => 'Lexus',
            'GS200T' => 'Lexus',
            'GS350' => 'Lexus',
            'GS450h' => 'Lexus',
            'GS460' => 'Lexus',
            'GS470' => 'Lexus',
            'GX460' => 'Lexus',
            'HS250' => 'Lexus',
            'HS250h' => 'Lexus',
            'IS C' => 'Lexus',
            'IS200' => 'Lexus',
            'IS200T' => 'Lexus',
            'IS250' => 'Lexus',
            'IS350' => 'Lexus',
            'ISF' => 'Lexus',
            'LC' => 'Lexus',
            'LC500' => 'Lexus',
            'LS460' => 'Lexus',
            'LS500h' => 'Lexus',
            'LS600h' => 'Lexus',
            'LX450' => 'Lexus',
            'LX460' => 'Lexus',
            'LX570' => 'Lexus',
            'LX600' => 'Lexus',
            'NX' => 'Lexus',
            'NX200T' => 'Lexus',
            'NX300' => 'Lexus',
            'NX300h' => 'Lexus',
            'RC200T' => 'Lexus',
            'RC300' => 'Lexus',
            'RC350' => 'Lexus',
            'RCF' => 'Lexus',
            'RX350' => 'Lexus',
            'RX350L' => 'Lexus',
            'RX400h' => 'Lexus',
            'RX450h' => 'Lexus',
            'RX450L' => 'Lexus',
            'RC400' => 'Lexus',
            'UX' => 'Lexus',
            'UX250h' => 'Lexus',
            'ES350h' => 'Lexus',
            'RX450hL' => 'Lexus',
            'Aviator' => 'Lincoln',
            'B - Series' => 'Lincoln',
            'Blackwood' => 'Lincoln',
            'Continental' => 'Lincoln',
            'Corsair' => 'Lincoln',
            'LS' => 'Lincoln',
            'LS6' => 'Lincoln',
            'LS8' => 'Lincoln',
            'Lt' => 'Lincoln',
            'Mark III' => 'Lincoln',
            'Mark IV' => 'Lincoln',
            'Mark LT' => 'Lincoln',
            'Mark V' => 'Lincoln',
            'Mark VI' => 'Lincoln',
            'Mark VII' => 'Lincoln',
            'Mark VIII' => 'Lincoln',
            'MKC' => 'Lincoln',
            'MKS' => 'Lincoln',
            'MKT' => 'Lincoln',
            'MKX' => 'Lincoln',
            'MKZ' => 'Lincoln',
            'Nautilus' => 'Lincoln',
            'Navigator' => 'Lincoln',
            'Towncar' => 'Lincoln',
            'Versailles' => 'Lincoln',
            'Zephyr' => 'Lincoln',
            'B Series' => 'Lincoln',
            '2' => 'Mazda',
            '3' => 'Mazda',
            '323' => 'Mazda',
            '5' => 'Mazda',
            '6' => 'Mazda',
            '6 Speed' => 'Mazda',
            '626' => 'Mazda',
            '808' => 'Mazda',
            '929' => 'Mazda',
            'B - Series Pickup' => 'Mazda',
            'CX-3' => 'Mazda',
            'CX-30' => 'Mazda',
            'CX-5' => 'Mazda',
            'CX-7' => 'Mazda',
            'CX-9' => 'Mazda',
            'GLC' => 'Mazda',
            'LX' => 'Mazda',
            'Mazdaspeed3' => 'Mazda',
            'Miata' => 'Mazda',
            'Miata MX-5' => 'Mazda',
            'Millenia' => 'Mazda',
            'MP3' => 'Mazda',
            'MPV' => 'Mazda',
            'MX-3' => 'Mazda',
            'MX-6' => 'Mazda',
            'Navajo' => 'Mazda',
            'Probe' => 'Mazda',
            'Protege' => 'Mazda',
            'RX-2' => 'Mazda',
            'RX-3' => 'Mazda',
            'RX-4' => 'Mazda',
            'RX-7' => 'Mazda',
            'RX-8' => 'Mazda',
            'Speed 3' => 'Mazda',
            'Tribute' => 'Mazda',
            'B Series Pickup' => 'Mazda',
            'Mazdaspeed 3' => 'Mazda',
            'Bobcat' => 'Mercury',
            'Capri' => 'Mercury',
            'Comet' => 'Mercury',
            'Cougar' => 'Mercury',
            'Grand Marquis' => 'Mercury',
            'Ln-7' => 'Mercury',
            'Lynx' => 'Mercury',
            'Marauder' => 'Mercury',
            'Mercury' => 'Mercury',
            'Meteor' => 'Mercury',
            'Milan' => 'Mercury',
            'Monarch' => 'Mercury',
            'Montego' => 'Mercury',
            'Monterey' => 'Mercury',
            'Mountaineer' => 'Mercury',
            'Mystique' => 'Mercury',
            'Sable' => 'Mercury',
            'Sable GS' => 'Mercury',
            'Topaz' => 'Mercury',
            'Tracer' => 'Mercury',
            'Villager' => 'Mercury',
            '3000GT' => 'Mitsubishi',
            'ASX' => 'Mitsubishi',
            'Avenger' => 'Mitsubishi',
            'Colt' => 'Mitsubishi',
            'Diamante' => 'Mitsubishi',
            'Eagle Talon' => 'Mitsubishi',
            'Eclipse' => 'Mitsubishi',
            'Endeavor' => 'Mitsubishi',
            'Expo' => 'Mitsubishi',
            'Fuso' => 'Mitsubishi',
            'Galant' => 'Mitsubishi',
            'Hino' => 'Mitsubishi',
            'i-MiEV' => 'Mitsubishi',
            'Lancer' => 'Mitsubishi',
            'Lancer EVO' => 'Mitsubishi',
            'Laser' => 'Mitsubishi',
            'Mirage' => 'Mitsubishi',
            'Mirage G4' => 'Mitsubishi',
            'Montero' => 'Mitsubishi',
            'Montero Sport' => 'Mitsubishi',
            'Outlander Sport' => 'Mitsubishi',
            'Raider' => 'Mitsubishi',
            'Sebring Coupe' => 'Mitsubishi',
            'RVR' => 'Mitsubishi',
            'Spyder' => 'Mitsubishi',
            'Stealth' => 'Mitsubishi',
            'Summit' => 'Mitsubishi',
            '200SX' => 'Nissan',
            '240SX' => 'Nissan',
            '350z' => 'Nissan',
            '370z' => 'Nissan',
            '720' => 'Nissan',
            'Altima' => 'Nissan',
            'Armada' => 'Nissan',
            'Axxes' => 'Nissan',
            'Axxess' => 'Nissan',
            'Cube' => 'Nissan',
            'Frontier' => 'Nissan',
            'GT-R' => 'Nissan',
            'Juke' => 'Nissan',
            'Juke S' => 'Nissan',
            'Kicks' => 'Nissan',
            'Leaf' => 'Nissan',
            'Maxima' => 'Nissan',
            'Micra' => 'Nissan',
            'Murano' => 'Nissan',
            'Note' => 'Nissan',
            'NV' => 'Nissan',
            'NV1500' => 'Nissan',
            'NV200' => 'Nissan',
            'NV2500' => 'Nissan',
            'NV3500' => 'Nissan',
            'NX' => 'Nissan',
            'Primera' => 'Nissan',
            'Pulsar' => 'Nissan',
            'Quest' => 'Nissan',
            'SE-R' => 'Nissan',
            'Stanza' => 'Nissan',
            'Titan' => 'Nissan',
            'Versa' => 'Nissan',
            'Versa Note' => 'Nissan',
            'Xterra' => 'Nissan',
            'Xtrail' => 'Nissan',
            '88' => 'Oldsmobile',
            '98' => 'Oldsmobile',
            'Achieva' => 'Oldsmobile',
            'Alero' => 'Oldsmobile',
            'Aurora' => 'Oldsmobile',
            'Bravada' => 'Oldsmobile',
            'Ciera' => 'Oldsmobile',
            'Custom Cruiser' => 'Oldsmobile',
            'Customer Cruiser Wagon' => 'Oldsmobile',
            'Custom Cruiser Wagon' => 'Oldsmobile',
            'Cutlass' => 'Oldsmobile',
            'Cutlass Ciera' => 'Oldsmobile',
            'Cutlass Ciera Wagon' => 'Oldsmobile',
            'Cutlass Supreme' => 'Oldsmobile',
            'Cutlass Wagon' => 'Oldsmobile',
            'Delta 88' => 'Oldsmobile',
            'F-85' => 'Oldsmobile',
            'Firenza' => 'Oldsmobile',
            'Intrigue' => 'Oldsmobile',
            'LSS' => 'Oldsmobile',
            'Omega' => 'Oldsmobile',
            'Regency' => 'Oldsmobile',
            'Silhouette' => 'Oldsmobile',
            'Starfire' => 'Oldsmobile',
            'Toronado' => 'Oldsmobile',
            'Vista Cruiser' => 'Oldsmobile',
            '1000' => 'Pontiac',
            '6000' => 'Pontiac',
            'Acadian' => 'Pontiac',
            'Astre' => 'Pontiac',
            'Aztec' => 'Pontiac',
            'Aztek' => 'Pontiac',
            'Bonneville' => 'Pontiac',
            'Catalina' => 'Pontiac',
            'Executive' => 'Pontiac',
            'Fiero' => 'Pontiac',
            'Firebird' => 'Pontiac',
            'G3' => 'Pontiac',
            'G5' => 'Pontiac',
            'G6' => 'Pontiac',
            'Grand Am' => 'Pontiac',
            'Grand Prix' => 'Pontiac',
            'Grandville' => 'Pontiac',
            'GTO' => 'Pontiac',
            'J2000' => 'Pontiac',
            'Laurentian' => 'Pontiac',
            'Le Mans' => 'Pontiac',
            'Montana' => 'Pontiac',
            'Parisienne' => 'Pontiac',
            'Phoenix' => 'Pontiac',
            'Pursuit' => 'Pontiac',
            'Safari' => 'Pontiac',
            'Solstice' => 'Pontiac',
            'Sunbird' => 'Pontiac',
            'Sunfire' => 'Pontiac',
            'SV6' => 'Pontiac',
            'T1000' => 'Pontiac',
            'Tempest' => 'Pontiac',
            'Torrent' => 'Pontiac',
            'Trans Am' => 'Pontiac',
            'Trans Sport' => 'Pontiac',
            'Ventura' => 'Pontiac',
            'Vibe' => 'Pontiac',
            'Wave' => 'Pontiac',
            'G8' => 'Pontiac',
            'Alcyone SVX' => 'Subaru',
            'Ascent' => 'Subaru',
            'Baja' => 'Subaru',
            'Brat' => 'Subaru',
            'BRZ' => 'Subaru',
            'Crosstrek' => 'Subaru',
            'DL' => 'Subaru',
            'Forester' => 'Subaru',
            'GL' => 'Subaru',
            'I35' => 'Subaru',
            'Impreza' => 'Subaru',
            'Justy' => 'Subaru',
            'Legacy' => 'Subaru',
            'Leone' => 'Subaru',
            'Loyale' => 'Subaru',
            'Outback' => 'Subaru',
            'STi' => 'Subaru',
            'Tribeca' => 'Subaru',
            'WRX' => 'Subaru',
            'XT-6' => 'Subaru',
            'XV Crosstrek' => 'Subaru',
            'Address' => 'Suzuki',
            'Aerio' => 'Suzuki',
            'Bandit' => 'Suzuki',
            'Boulevard' => 'Suzuki',
            'Burgman' => 'Suzuki',
            'DR' => 'Suzuki',
            'Equator' => 'Suzuki',
            'Esteem' => 'Suzuki',
            'Forenza' => 'Suzuki',
            'Grand Vitara' => 'Suzuki',
            'GS' => 'Suzuki',
            'GSF' => 'Suzuki',
            'GSX' => 'Suzuki',
            'GSXR' => 'Suzuki',
            'Hayabusa' => 'Suzuki',
            'Katana' => 'Suzuki',
            'Kizashi' => 'Suzuki',
            'Marauder' => 'Suzuki',
            'Reno' => 'Suzuki',
            'SV' => 'Suzuki',
            'Swift' => 'Suzuki',
            'SX4' => 'Suzuki',
            'TL' => 'Suzuki',
            'TU' => 'Suzuki',
            'V Storm' => 'Suzuki',
            'Verona' => 'Suzuki',
            'Vitara' => 'Suzuki',
            'Volusia' => 'Suzuki',
            'VS' => 'Suzuki',
            'VX' => 'Suzuki',
            'XL-7' => 'Suzuki',
            '86' => 'Toyota',
            'C-HR' => 'Toyota',
            'Celica' => 'Toyota',
            'Cressida' => 'Toyota',
            'Echo' => 'Toyota',
            'FJ Cruiser' => 'Toyota',
            'Hilux' => 'Toyota',
            'Land Cruiser' => 'Toyota',
            'Matrix' => 'Toyota',
            'MIRAI' => 'Toyota',
            'Paseo' => 'Toyota',
            'Plaz' => 'Toyota',
            'Previa' => 'Toyota',
            'Prime' => 'Toyota',
            'Starlet' => 'Toyota',
            'Supra' => 'Toyota',
            'T100' => 'Toyota',
            'Tacoma' => 'Toyota',
            'Tercel' => 'Toyota',
            'Tundra' => 'Toyota',
            'Venza' => 'Toyota',
            'Yaris' => 'Toyota',
            'CH-R' => 'Toyota',
            'XC90' => 'Volvo',
            'R8' => 'Audi',
            'RS4' => 'Audi',
            'Q3' => 'Audi',
            'ML' => 'Mercedes',
            'SL-Class' => 'Mercedes',
            'SLK' => 'Mercedes',
            'S-Class' => 'Mercedes',
            'G-class' => 'Mercedes',
            'Crossfire' => 'Chrysler',
            'A-Class' => 'Mercedes',
            'Vaneo' => 'Mercedes',
            'Sprinter' => 'Dodge',
            'B-Class' => 'Mercedes',
            'C-Class' => 'Mercedes',
            'E-Class' => 'Mercedes',
            'CLK' => 'Mercedes',
            'R-Series' => 'Mercedes',
            'Range Rover Evoque' => 'Land Rover',
            'Range Rover Sport' => 'Land Rover',
            'Discovery (Full size )' => 'Land Rover',
            'Discovery (Sport ) ' => 'Land Rover',
            'Velar' => 'Land Rover',
            'LR2' => 'Land Rover',
            'LR3' => 'Land Rover',
            'Range Rover' => 'Land Rover',
            'Cooper ' => 'Mini',
            'Cooper Countryman' => 'Mini',
            'Cooper Paceman' => 'Mini',
            'Toureg ' => 'Volkswagen',
            'Beetle' => 'Volkswagen',
            'CC' => 'Volkswagen',
            'EOS' => 'Volkswagen',
            'Golf' => 'Volkswagen',
            'GTI' => 'Volkswagen',
            'Passat' => 'Volkswagen',
            'Tiguan' => 'Volkswagen',
            'SportWagen' => 'Volkswagen',
            '1 Series' => 'BMW',
            '5 Series ' => 'BMW',
            '6 Series' => 'BMW',
            'Z4' => 'BMW',
            '911' => 'Porsche',
            'Boxter' => 'Porsche',
            'Cayenne' => 'Porsche',
            'Cayman' => 'Porsche',
            'Macan' => 'Porsche',
            'Panamera' => 'Porsche',
            'Q2L' => 'Audi',
            'NX350H' => 'Lexus',
            '300 Series' => 'Mercedes',
            'Atlas' => 'Volkswagen',
            'XF' => 'Jaguar',
            'XJ8' => 'Jaguar',
            'XK' => 'Jaguar',
            'XK8' => 'Jaguar',
            'XKR' => 'Jaguar',
            'F-450' => 'Ford',
            'F-550' => 'Ford',
            'S-Type' => 'Jaguar',
            'X-Type' => 'Jaguar',
            'XJ' => 'Jaguar',
            'Rabbit' => 'Volkswagen',
            'City Golf' => 'Volkswagen',
            '7 Series' => 'BMW',
            'Z3' => 'BMW',
            'Z8' => 'BMW',
            'CL-class' => 'Mercedes',
            'X3' => 'BMW',
            'X7' => 'BMW',
            'X4' => 'BMW',
            'M3' => 'BMW',
            'M5' => 'BMW',
            '2 Series' => 'BMW',
            'F-Pace' => 'Jaguar',
            'F-Type' => 'Jaguar',
            'XE' => 'Jaguar',
            'LR4' => 'Land Rover',
            'E-Pace' => 'Jaguar',
            'I-Pace' => 'Jaguar',
            '190 Series' => 'Mercedes',
            'STI' => 'Subaru',
            'Qashqai' => 'Nissan',
            'Carrera' => 'Porsche',
            'RSX' => 'Acura',
            '993 Turbo Coupe' => 'Porsche',
            '3 Hatchback (5-door )' => 'Mazda',
            'F-150 Lightning' => 'Ford',
            'S3' => 'Audi',
            'S6' => 'Audi',
            'S8' => 'Audi',
            'S60' => 'Volvo',
            'S80' => 'Volvo',
            'V40' => 'Volvo',
            'V60' => 'Volvo',
            'V70' => 'Volvo',
            'XC60' => 'Volvo',
            'XC70' => 'Volvo',
            'S90' => 'Volvo',
            'V60' => 'Volvo',
            'V90' => 'Volvo',
            'XC40' => 'Volvo',
            'XC60' => 'Volvo',
            'Breeze' => 'Plymouth',
            '9-2X' => 'Saab',
            '458 Italia' => 'Ferrari',
            '458' => 'Ferrari',
            'California' => 'Ferrari',
            'FF' => 'Ferrari',
            'F430' => 'Ferrari',
            'Lesabre' => 'Buick',
            'DeVille' => 'Cadillac',
            'Astro Van' => 'Chevrolet',
            'Eighty-eight' => 'Oldsmobile',
            'Ninety-eight' => 'Oldsmobile',
            'Maverick' => 'Ford',
            'Monte' => 'Chevrolet',
            'Denali' => 'GMC',
            'Aura' => 'Saturn',
            'Monte' => 'Chevrolet',
            'Denali' => 'GMC',
            'Monte' => 'Chevrolet',
            'Denali' => 'GMC',
            'Ion' => 'Saturn',
            'Outlook' => 'Saturn',
            'Sky' => 'Saturn',
            '124 Spider' => 'Fiat',
            'iA' => 'Scion',
            'FR-S' => 'Scion',
            'iM' => 'Scion',
            'TC' => 'Scion',
            'xD' => 'Scion',
            'IQ' => 'Scion',
            'tC' => 'Scion',
            'xB' => 'Scion',
            'XB' => 'Scion',
            'iQ' => 'Scion',
            'Allroad' => 'Audi',
            'Sportwagen' => 'Volkswagen',
            'Mariner' => 'Mercury',
            'Grand' => 'Mercury',
            'Town' => 'Lincoln',
            'Mark' => 'Lincoln',
            'Thunderbird' => 'Ford',
            'Five' => 'Ford',
            'Crown' => 'Ford',
            'Grand caravan' => 'Dodge',
            'Routan' => 'Volkswagen',
            'Fortwo' => 'Smart',
            'Forfour' => 'Smart',
            'Ninja' => 'Kawasaki',
            'Z1000' => 'Kawasaki',
            'Z750S' => 'Kawasaki',
            'ZZR1200' => 'Kawasaki',
            'ZZR1400' => 'Kawasaki',
            'Cabriolet' => 'Audi',
            'RS6' => 'Audi',
            'Ecosport' => 'Ford',
            'F-600' => 'Ford',
            'C70' => 'Volvo',
            'C30' => 'Volvo',
            'S40' => 'Volvo',
            'V50' => 'Volvo',
            'Cascadia' => 'Freightliner',
            'Columbia' => 'Freightliner',
            'Century Class' => 'Freightliner',
            'M2 106' => 'Freightliner',
            '122SD' => 'Freightliner',
            'C-Max' => 'Ford',
            'F350' => 'Ford',
            'Relay' => 'Saturn',
            'Concours' => 'Cadillac',
            'Eighty' => 'Oldsmobile',
            'Ninety' => 'Oldsmobile',
            'GTA' => 'Pontiac',
            'ES300h' => 'Lexus',
            'W4' => 'Chevrolet',
            'Ascender' => 'Isuzu',
            'FSR' => 'Isuzu',
            'Hombre' => 'Isuzu',
            'Pickup' => 'Isuzu',
            '9-7' => 'Saab',
            '9-7X' => 'Saab',
            'I-280' => 'Isuzu',
            'Granada' => 'Ford',
            'LTD' => 'Ford',
            'Pinto' => 'Ford',
            'Torino' => 'Ford',
            'F500-F900,' => 'Ford',
            'SX400' => 'Lexus',
            'Orlando' => 'Chevrolet',
            'Promaster' => 'Dodge',
            'Promaster City' => 'Dodge',
            'Pro master' => 'Ram',
            'Station' => 'Plymouth',
            'Horizon' => 'Plymouth',
            'Sundance' => 'Plymouth',
            'M4' => 'BMW',
        ];
        foreach ($models as $x => $model) {
            $data = Makes::where('name', $model)->first();
            if (!is_null($data)) {
                $make_id = $data->id;
                Models::create([
                    'name' => $x,
                    'make_id' => $make_id,
                ]);
            }
        }
    }
}
