<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Religion;
use App\Models\Church;
use App\Models\Service;
use App\Models\Photo;
use App\Models\Event;
use App\Models\Facility;
use App\Models\Plan;
use App\Models\Role;
use App\Models\ServiceLanguage;
use App\Models\Subscription;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Criando roles primeiro para evitar problemas de chave estrangeira
        Role::factory(50)->create();

        // Criar facilidades
        Facility::factory(10)->create();

        // Cria idiomas de serviços
        ServiceLanguage::factory()->count(5)->create();

        // Criando users e assinaturas
        User::factory(50)->create()->each(function ($user) {
            // Supondo que cada usuário possa ter uma assinatura
            Subscription::factory()->create(['user_id' => $user->id]);

            // Atribuindo roles aleatórias a cada usuário
            // Isso pressupõe que a model User tenha o método roles() configurado para a relação
            $roles = Role::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $user->roles()->attach($roles);
        });

        // Criando registros para as demais tabelas
        Religion::factory(50)->create();

        Church::factory(50)->create()->each(function ($church) {
            // Cada igreja pode ter múltiplos serviços, fotos e eventos
            Service::factory(rand(1, 5))->create(['church_id' => $church->id]);
            Photo::factory(rand(1, 10))->create(['church_id' => $church->id]);
            Event::factory(rand(1, 3))->create(['church_id' => $church->id]);
            // Anexar entre 1 a 3 facilidades aleatórias por igreja
            $facilities = Facility::inRandomOrder()->take(1, 3)->pluck('id');
            $church->facilities()->attach($facilities);
        });

        Service::all()->each(function ($service) {
            $service->language()->associate(ServiceLanguage::inRandomOrder()->first()->id);
            $service->save();
        });

        Plan::factory(50)->create();
    }
}
