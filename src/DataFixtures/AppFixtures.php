<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        // $manager->flush();

        $this->_loadCategory($manager);
    }

    private function _loadCategory(ObjectManager $manager): void
    {
        foreach ($this->_getCategoryData() as [$categoryName]) {
            $cat = new Category();
            $cat->setCategoryName($categoryName);

            $manager->persist($cat);
        }

        $manager->flush();
    }

    private function _getCategoryData()
    {
        // $data = [$categoryName];
        return [
            ['Chain hotels'],
            ['Motels'],
            ['Resorts'],
            ['Inns'],
            ['All-suites'],
            ['Conference/convention center hotels'],
            ['Extended stay hotels'],
            ['Boutique hotels'],
            ['Bunkhouses'],
            ['Bed and breakfasts'],
            ['Eco hotels'],
            ['Casino hotels'],
            ['Pop-up hotels'],
            ['Pet-friendly hotels'],
            ['Roadhouses'],
            ['Gastro hotels'],
            ['Micro hotels'],
            ['Transit hotels'],
            ['Heritage hotels'],
            ['Hostels'],
            ['Unique concept hotels'],
        ];
    }
}
