<?php

namespace App\DataFixtures;

use App\Entity\Plato;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PlatoFixture extends Fixture
{
    protected $client;
    public function __construct(HttpClientInterface $client)
    {
       $this -> client=$client;     
    }

    public function load(ObjectManager $manager): void
    {

    //Código para llamar a una API

       /*$faker = Factory::create();
       for ($i=0; $i<10; $i++){
        $plato = new Plato();
        $plato->setNombre($faker->word());
        $plato->setDescripcion($faker->text(100));
        $numPlato = $faker -> numberBetween(1,9);
        $plato->setImagen("https://conelmorrofino.com/wp-content/uploads/2020/06/El-mejor-sushi-de-Madrid-portada.jpg");
        $plato->setPrecio($numPlato);
        $manager->persist($plato);
       }
       for ($i=0; $i<10; $i++){
        $numPlato = $faker -> numberBetween(1,9);
        $response = $this->client->request(
            'GET',
            "https://pokeapi.co/api/v2/pokemon/$numPlato/"
        );
        $contenido = $response->toArray();
        $plato = new Plato();
        $plato->setNombre($contenido['name']);
        $plato->setDescripcion($faker->text(100));
        $plato->setImagen("https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/dream-world/$numPlato.svg");
        $plato->setPrecio($numPlato);
        $manager->persist($plato);
       }*/


        $manager->flush();
    }
}


