<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\RoomType;
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
        $this->_loadRoomType($manager);
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

    private function _getCategoryData(): array
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

    private function _loadRoomType(ObjectManager $manager): void
    {
        foreach ($this->_getRoomTypeData() as [$typeName, $description]) {
            $roomType = new RoomType();
            $roomType->setTypeName($typeName);
            $roomType->setDescription($description);

            $manager->persist($roomType);
        }

        $manager->flush();
    }

    private function _getRoomTypeData(): array
    {
        // $data = [$typeName, $description];
        return [
            ["Single", "A room assigned to one person. May have one or more beds."],
            ["Double", "A room assigned to two people. May have one or more beds."],
            ["Triple", "A room that can accommodate three persons and has been fitted with three twin beds, one double bed and one twin bed or two double beds."],
            ["Quad", "A room assigned to four people. May have two or more beds."],
            ["Queen", "A room with a queen-sized bed. May be occupied by one or more people."],
            ["King", "A room with a king-sized bed. May be occupied by one or more people."],
            ["Twin", "A room with two twin beds. May be occupied by one or more people."],
            ["Hollywood Twin Room", "A room that can accommodate two persons with two twin beds joined together by a common headboard. Most of the budget hotels tend to provide many of these room settings which cater both couples and parties in two."],
            ["Double-double", "A Room with two double ( or perhaps queen) beds. And can accommodate two to four persons with two twin, double or queen-size beds."],
            ["Studio", "A room with a studio bed- a couch which can be converted into a bed. May also have an additional bed."],
        ];
    }
}
