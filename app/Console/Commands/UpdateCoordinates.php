<?php

namespace App\Console\Commands;

use App\Models\Church;
use Illuminate\Console\Command;

class UpdateCoordinates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-coordinates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'atualiza as coordenadas de igrejas e endereços com valores aleatórios pré-definidos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $coordinates = [
            ['latitude' => 51.509865, 'longitude' => -0.118092], // Londres
            ['latitude' => 53.483959, 'longitude' => -2.244644], // Manchester
            ['latitude' => 55.953251, 'longitude' => -3.188267], // Edimburgo
            ['latitude' => 52.486243, 'longitude' => -1.890401], // Birmingham
            ['latitude' => 54.978252, 'longitude' => -1.617439], // Newcastle
            ['latitude' => 53.799692, 'longitude' => -1.549103], // Leeds
            ['latitude' => 53.408371, 'longitude' => -2.991573], // Liverpool
            ['latitude' => 52.630886, 'longitude' => 1.297355], // Norwich
            ['latitude' => 51.454514, 'longitude' => -2.587910], // Bristol
            ['latitude' => 50.718412, 'longitude' => -3.533899], // Exeter
            ['latitude' => 51.752022, 'longitude' => -1.257677], // Oxford
            ['latitude' => 52.922530, 'longitude' => -1.474619], // Derby
            ['latitude' => 53.230688, 'longitude' => -0.540579], // Lincoln
            ['latitude' => 51.375801, 'longitude' => -2.359904], // Bath
            ['latitude' => 57.149717, 'longitude' => -2.094278], // Aberdeen
            ['latitude' => 54.597285, 'longitude' => -5.930120], // Belfast
            ['latitude' => 52.205337, 'longitude' => 0.121817], // Cambridge
            ['latitude' => 50.822530, 'longitude' => -0.137163], // Brighton
            ['latitude' => 51.481583, 'longitude' => -3.179090], // Cardiff
            ['latitude' => 53.959965, 'longitude' => -1.087298], // York
            ['latitude' => 52.954783, 'longitude' => -1.158109], // Nottingham
            ['latitude' => 53.381129, 'longitude' => -1.470085], // Sheffield
            ['latitude' => 52.486243, 'longitude' => -1.890401], // Birmingham
            ['latitude' => 53.390044, 'longitude' => -2.596950], // Chester
            ['latitude' => 53.645708, 'longitude' => -1.785355], // Huddersfield
            ['latitude' => 52.678419, 'longitude' => -2.445258], // Telford
            ['latitude' => 53.763201, 'longitude' => -2.703090], // Preston
            ['latitude' => 53.993959, 'longitude' => -1.541622], // Harrogate
            ['latitude' => 51.068785, 'longitude' => -1.794472], // Salisbury
            ['latitude' => 55.864237, 'longitude' => -4.251806], // Glasgow
            ['latitude' => 52.630886, 'longitude' => 1.297355], // Norwich
            ['latitude' => 50.909700, 'longitude' => -1.404351], // Southampton
            ['latitude' => 53.002668, 'longitude' => -2.179404], // Stoke-on-Trent
            ['latitude' => 52.707302, 'longitude' => -2.755327], // Shrewsbury
            ['latitude' => 53.763201, 'longitude' => -2.706914], // Blackburn
            ['latitude' => 52.922530, 'longitude' => -1.474619], // Derby
            ['latitude' => 51.454513, 'longitude' => -2.587910], // Bristol
            ['latitude' => 55.953252, 'longitude' => -3.188267], // Edinburgh
            ['latitude' => 53.408371, 'longitude' => -2.991573], // Liverpool
            ['latitude' => 54.978252, 'longitude' => -1.617439], // Newcastle upon Tyne
            ['latitude' => 53.800755, 'longitude' => -1.549077], // Leeds
        ];

        Church::all()->each(function ($church) use ($coordinates) {
            $randomCoordinates = $coordinates[array_rand($coordinates)];
            $church->update([
                'latitude' => $randomCoordinates['latitude'],
                'longitude' => $randomCoordinates['longitude'],
            ]);

            // Se existir um relacionamento direto de Church para Address, atualize também
            $church->address()->update([
                'latitude' => $randomCoordinates['latitude'],
                'longitude' => $randomCoordinates['longitude'],
            ]);
        });
    }
}
