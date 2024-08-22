<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\text;
use function Laravel\Prompts\progress;
use function Laravel\Prompts\info;
use App\Models\Visits;

class CreateVisitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:visit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para crear visita';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = text(
            label: 'Digite nombre del cliente',
            required: true,
            validate: fn (string $value) => match (true) {
                strlen($value) < 3 => 'El nombre debe tener mínimo 3 caracteres.',
                strlen($value) > 150 => 'El nombre NO puede superar 150 caracteres.',
                default => null
            }
        );

        $email = text(
            label: 'Digite el email del cliente',
            validate: fn (string $value) => match (true) {
                strlen($value) < 12 => 'El email debe tener mínimo 12 caracteres.',
                strlen($value) > 150 => 'El email NO puede superar 150 caracteres.',
                filter_var($value, FILTER_VALIDATE_EMAIL) === false => 'El email es inválido.',
                default => null
            },
            required: true
        );

        $latitude = text(
            label: 'Digite la coordenada de latitud del cliente',
            validate: fn (float $value) => match (true) {
                strlen($value) < 1 => 'La coordenada de latitud debe tener mínimo 1 caracter.',
                strlen($value) > 10 => 'La coordenada de latitud NO puede superar 9 caracteres.',
                $this->validate_range($value,'latitud') === false => 'La coordenada ingresada es inválida.',
                default => null
            },
            required: true
        );

        $longitude = text(
            label: 'Digite la coordenada de longitud del cliente',
            validate: fn (float $value) => match (true) {
                strlen($value) < 1 => 'La coordenada de longitud debe tener mínimo 1 caracter.',
                strlen($value) > 11 => 'La coordenada de longitud NO puede superar 10 caracteres.',
                $this->validate_range($value,'longitud') === false => 'La coordenada ingresada es inválida.',
                default => null
            },
            required: true
        );

        $progress = progress(label: 'Creando visita...', steps: 1);

        try {
            $progress->start();

            $visita = new Visits();
            $visita->name = $name;           
            $visita->email = $email;
            $visita->latitude = $latitude;
            $visita->longitude = $longitude;
            $visita->save();

            $progress->advance();
            $progress->finish();
            info('Visita creada exitosamente.');
        } catch (Exception $e) {
            $progress->finish();
            info('Creación de registro fallida');
            info($e->getMessage());
        }
        
    }

    public function validate_range($number,$type) {
        if ($type === 'latitud') {
            $min_range = -90;
            $max_range = 90;
        } else if ($type === 'longitud') {
            $min_range = -180;
            $max_range = 180;
        }

        if (
            is_numeric($number) &&
            bccomp($number, $min_range) === 1 &&
            bccomp($number, $max_range) === -1
        ) {
            return true;
        }
            return false;
    }
}