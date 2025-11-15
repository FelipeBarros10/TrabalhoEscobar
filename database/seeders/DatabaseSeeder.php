<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehiclePhoto;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $admin = User::updateOrCreate(
            ['email' => 'admin@concessionaria.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );
        // DB::transaction(function () {


        //     $brandsData = [
        //         [
        //             'name' => 'Toyota',
        //             'country' => 'Japão',
        //             'models' => ['Corolla', 'Hilux', 'RAV4'],
        //         ],
        //         [
        //             'name' => 'Honda',
        //             'country' => 'Japão',
        //             'models' => ['Civic', 'HR-V', 'City'],
        //         ],
        //         [
        //             'name' => 'Ford',
        //             'country' => 'Estados Unidos',
        //             'models' => ['Mustang', 'Ranger', 'Bronco'],
        //         ],
        //     ];

        //     $brands = collect($brandsData)->mapWithKeys(function ($brandData) {
        //         $brand = Brand::updateOrCreate(
        //             ['name' => $brandData['name']],
        //             ['country' => $brandData['country']]
        //         );

        //         $models = collect($brandData['models'])->map(function ($modelName) use ($brand) {
        //             return VehicleModel::updateOrCreate(
        //                 [
        //                     'brand_id' => $brand->id,
        //                     'name' => $modelName,
        //                 ]
        //             );
        //         });

        //         return [$brand->name => ['brand' => $brand, 'models' => $models]];
        //     });

        //     $colors = collect([
        //         ['name' => 'Branco Pérola', 'hex_code' => '#f2f2f2'],
        //         ['name' => 'Preto Ônix', 'hex_code' => '#111111'],
        //         ['name' => 'Vermelho Rubi', 'hex_code' => '#b11215'],
        //         ['name' => 'Azul Metálico', 'hex_code' => '#1e4c96'],
        //     ])->map(function ($colorData) {
        //         return Color::updateOrCreate(
        //             ['name' => $colorData['name']],
        //             ['hex_code' => $colorData['hex_code']]
        //         );
        //     })->keyBy('name');

        //     $vehicleDefinitions = [
        //         [
        //             'brand' => 'Toyota',
        //             'model' => 'Corolla',
        //             'color' => 'Azul Metálico',
        //             'year' => 2022,
        //             'mileage' => 18000,
        //             'price' => 118900.00,
        //             'description' => 'Sedan médio com pacote completo de segurança Toyota Safety Sense, multimídia com Android Auto/Apple CarPlay e motorização híbrida.',
        //             'photos' => [
        //                 'https://s2-autoesporte.glbimg.com/jOP4z8l0luBM_LZAi-yspAVkafg=/0x0:2200x1600/888x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_cf9d035bf26b4646b105bd958f32089d/internal_photos/bs/2021/q/9/kuBBhASjiPov0txZpMVw/corollaxeifrente.jpg',
        //                 'https://allthecars.wordpress.com/wp-content/uploads/2021/02/toyota-corolla-2022.jpg',
        //                 'https://www.motoragora.com.br/wp-content/uploads/2021/07/Thiago-Carros.jpg'
        //             ],
        //         ],
        //         [
        //             'brand' => 'Honda',
        //             'model' => 'Civic',
        //             'color' => 'Preto Ônix',
        //             'year' => 2021,
        //             'mileage' => 24000,
        //             'price' => 112500.00,
        //             'description' => 'Honda Civic Touring com teto solar, pacote Honda Sensing e excelente equilíbrio entre performance e conforto.',
        //             'photos' => [
        //                 'https://s2-autoesporte.glbimg.com/m93iqgyBjaBW4MrO1-S5sWDox9E=/0x0:1200x674/888x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_cf9d035bf26b4646b105bd958f32089d/internal_photos/bs/2020/q/H/lq6JycR7Sr0A52DGB4MQ/honda-sivic-sport.jpeg',
        //                 'https://www.rbsdirect.com.br/imagesrc/27456338.jpg?w=700',
        //                 'https://www.encontracarros.com.br/wp-content/uploads/2021/01/honda-civic-sport-2021-1200x838.jpg'
        //             ],
        //         ],
        //         [
        //             'brand' => 'Ford',
        //             'model' => 'Mustang',
        //             'color' => 'Vermelho Rubi',
        //             'year' => 2020,
        //             'mileage' => 12500,
        //             'price' => 365000.00,
        //             'description' => 'Muscle car icônico com motor V8 5.0, pacote Performance e visual agressivo. Revisões em dia e único dono.',
        //             'photos' => [
        //                 'https://i.pinimg.com/736x/e5/04/5a/e5045a3240f0b31e5b3b2f52c4e042ae.jpg',
        //                 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRb2Ws2OeO9UXhUiwe39YW5pDz4Mo5JaZvTKg&s',
        //                 'https://i.pinimg.com/236x/52/a4/02/52a402552cd9900d5aa237c370d2550f.jpg'
        //             ],
        //         ],

        //     ];

        //     foreach ($vehicleDefinitions as $definition) {
        //         $brandData = $brands->get($definition['brand']);
        //         $brand = $brandData['brand'];
        //         $model = $brandData['models']->firstWhere('name', $definition['model']);
        //         $color = $colors->get($definition['color']);

        //         $vehicle = Vehicle::updateOrCreate(
        //             [
        //                 'brand_id' => $brand->id,
        //                 'vehicle_model_id' => $model->id,
        //                 'color_id' => $color->id,
        //                 'year' => $definition['year'],
        //                 'mileage' => $definition['mileage'],
        //             ],
        //             [
        //                 'price' => $definition['price'],
        //                 'main_image_url' => $definition['photos'][0],
        //                 'description' => $definition['description'],
        //                 'created_by' => $admin->id,
        //             ]
        //         );

        //         $vehicle->photos()->delete();
        //         foreach ($definition['photos'] as $index => $url) {
        //             VehiclePhoto::create([
        //                 'vehicle_id' => $vehicle->id,
        //                 'url' => $url,
        //                 'is_primary' => $index === 0,
        //             ]);
        //         }
        //     }
        // });
    }
}
