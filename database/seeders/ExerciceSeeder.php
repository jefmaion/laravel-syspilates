<?php

namespace Database\Seeders;

use App\Models\Exercice;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class ExerciceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exercices = [
            ['name' => 'Boomerang', 'description' => ''],
            ['name' => 'Control Balance', 'description' => ''],
            ['name' => 'CorkScrew', 'description' => ''],
            ['name' => 'Double Leg Kick', 'description' => ''],
            ['name' => 'Double Leg Stretch', 'description' => ''],
            ['name' => 'Hip twist', 'description' => ''],
            ['name' => 'Hundred', 'description' => ''],
            ['name' => 'JackKnife', 'description' => ''],
            ['name' => 'Kneeling Side Kick', 'description' => ''],
            ['name' => 'LEG PULL BACK', 'description' => ''],
            ['name' => 'LEG PULL FRONT', 'description' => ''],
            ['name' => 'Leg Pulls', 'description' => ''],
            ['name' => 'Neck PulL', 'description' => ''],
            ['name' => 'One Leg Circle', 'description' => ''],
            ['name' => 'One Leg Kick', 'description' => ''],
            ['name' => 'One Leg Stretch', 'description' => ''],
            ['name' => 'Push up', 'description' => ''],
            ['name' => 'Rocker With Open Legs', 'description' => ''],
            ['name' => 'Rocking', 'description' => ''],
            ['name' => 'Roll Over', 'description' => ''],
            ['name' => 'Roll up', 'description' => ''],
            ['name' => 'Rolling Back', 'description' => ''],
            ['name' => 'Saw', 'description' => ''],
            ['name' => 'Scissors e bicycle', 'description' => ''],
            ['name' => 'Seal and Crab', 'description' => ''],
            ['name' => 'Shoulder brigde', 'description' => ''],
            ['name' => 'Side BenD', 'description' => ''],
            ['name' => 'Side Kick', 'description' => ''],
            ['name' => 'Spine Stretch', 'description' => ''],
            ['name' => 'Spine Twist', 'description' => ''],
            ['name' => 'SPINE TWIST MAT PILATES', 'description' => ''],
            ['name' => 'Swan DivE', 'description' => ''],
            ['name' => 'Swimming', 'description' => ''],
            ['name' => 'Teaser', 'description' => ''],
            ['name' => 'Cadillac', 'description' => ''],
            ['name' => 'Reformer', 'description' => ''],
            ['name' => 'Chair', 'description' => ''],
            ['name' => 'Barrel', 'description' => ''],
        ];

        foreach(Tenant::all() as $tenant) {
            foreach($exercices as $ex) {

                $ex['tenant_id'] = $tenant->id;

                Exercice::create($ex);
            }
        }
    }
}
