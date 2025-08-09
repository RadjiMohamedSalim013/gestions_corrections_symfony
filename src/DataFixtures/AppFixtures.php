<?php

namespace App\DataFixtures;

use App\Entity\Etablissement;
use App\Entity\Examen;
use App\Entity\Epreuve;
use App\Entity\Professeur;
use App\Entity\Correction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR'); // Faker en français

        //  créer 5 établissements
        $etablissements = [];
        for ($i = 0; $i < 5; $i++) {
            $etab = new Etablissement();
            $etab->setNom($faker->unique()->company);
            $etab->setVille($faker->city);
            $manager->persist($etab);
            $etablissements[] = $etab;
        }

        //  créer 3 examens
        $examens = [];
        for ($i = 0; $i < 3; $i++) {
            $examen = new Examen();
            $examen->setNom($faker->sentence(3));
            $manager->persist($examen);
            $examens[] = $examen;
        }

        // créer 10 épreuves liées aux examens
        $epreuves = [];
        for ($i = 0; $i < 10; $i++) {
            $epreuve = new Epreuve();
            $epreuve->setNom($faker->word);
            $epreuve->setType($faker->randomElement(['écrit', 'oral']));
            $epreuve->setExamen($faker->randomElement($examens));
            $manager->persist($epreuve);
            $epreuves[] = $epreuve;
        }

        // créer 8 professeurs liés aux établissements
        $professeurs = [];
        for ($i = 0; $i < 8; $i++) {
            $prof = new Professeur();
            $prof->setNom($faker->lastName);
            $prof->setPrenom($faker->firstName);
            $prof->setGrade($faker->randomElement(['Maître', 'Professeur', 'Assistant']));
            $prof->setEtablissement($faker->randomElement($etablissements));
            $manager->persist($prof);
            $professeurs[] = $prof;
        }

        // créer 15 corrections liées aux professeurs et épreuves
        for ($i = 0; $i < 15; $i++) {
            $correction = new Correction();
            $correction->setProfesseur($faker->randomElement($professeurs));
            $correction->setEpreuve($faker->randomElement($epreuves));
            $correction->setDate($faker->dateTimeBetween('-1 year', 'now'));
            $correction->setNbrCopie($faker->numberBetween(10, 100));
            $manager->persist($correction);
        }

        $manager->flush();
    }
}
