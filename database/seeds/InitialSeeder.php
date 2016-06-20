<?php

use Illuminate\Database\Seeder;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Organizador::class, 2)->create()->each(function($o)
        {
            for ($i=0; $i<=mt_rand(1,3); $i++)
            {
                $o->eventos()->save(factory(App\Models\Evento::class)->make())->each(function ($e)
                {
                    for ($j=0; $j<=mt_rand(1, $e->lotacao_maxima); $j++)
                    {
                        $e->ingressos()->save(factory(App\Models\Ingresso::class)->make());
                    }
                });
            }
        });
    }
}
