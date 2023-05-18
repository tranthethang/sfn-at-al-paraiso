<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Hotel;
use App\Entity\Room;
use App\Entity\RoomType;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const CATEGORY_REF = "CATEGORY_REF";
    const ROOM_TYPE_REF = "ROOM_TYPE_REF";
    const HOTEL_REF = "HOTEL_REF";

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        // $manager->flush();
        try {
            $this->_loadCategory($manager);
            $this->_loadRoomType($manager);
            $this->_loadHotel($manager);
            $this->_loadRoom($manager);
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
    }

    private function _loadCategory(ObjectManager $manager): void
    {
        foreach ($this->_getCategoryData() as [$categoryName]) {
            $cat = new Category();
            $cat->setCategoryName($categoryName);

            $manager->persist($cat);

            if (!$this->hasReference(self::CATEGORY_REF)) {
                $this->setReference(self::CATEGORY_REF, $cat);
            }
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

            if (!$this->hasReference(self::ROOM_TYPE_REF)) {
                $this->setReference(self::ROOM_TYPE_REF, $roomType);
            }
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

    private function _loadHotel(ObjectManager $manager): void
    {
        foreach ($this->_getHotelData() as [$hotelName, $description]) {
            $hotel = new Hotel();
            $hotel->setHotelName($hotelName);
            $hotel->setDescription($description);
            $hotel->setIsActive(true);

            if ($this->hasReference(self::CATEGORY_REF)) {
                $hotel->setCategory($this->getReference(self::CATEGORY_REF, Category::class));
            }

            $manager->persist($hotel);

            if (!$this->hasReference(self::HOTEL_REF)) {
                $this->setReference(self::HOTEL_REF, $hotel);
            }
        }

        $manager->flush();
    }

    private function _getHotelData(): array
    {
        // $data = [$hotelName, $description];
        return [
            ["Four Seasons Hotel", "The plans for Four Seasons’ return to Bangkok (a prior location closed in 2015) predate the body blow that travel took during the pandemic, but the Jean-Michel Gathy–designed reincarnation on the banks of the Chao Phraya feels tailored to Bangkok residents anyway. "],
            ["The Tasman", "Repurposed from two bordering-on-derelict buildings with a gleaming new-build addition, The Tasman has cemented Hobart as an up-and-coming travel destination."],
            ["Al Paraíso", "Al Paraíso is located in Tafí del Valle. This holiday home features a garden, barbecue facilities, free WiFi and free private parking."],
        ];
    }

    private function _loadRoom(ObjectManager $manager): void
    {
        foreach ($this->_getRoomData() as [$roomName, $currentPrice]) {
            $room = new Room();
            $room->setRoomName($roomName);
            $room->setCurrentPrice($currentPrice);
            $room->setDescription("");

            if ($this->hasReference(self::ROOM_TYPE_REF)) {
                $room->setRoomType($this->getReference(self::ROOM_TYPE_REF, RoomType::class));
            }

            if ($this->hasReference(self::HOTEL_REF)) {
                $room->setHotel($this->getReference(self::HOTEL_REF, Hotel::class));
            }

            $manager->persist($room);
        }

        $manager->flush();
    }

    private function _getRoomData(): array
    {
        $list = [];

        $maxFloor = 5;
        $maxRoomPerFloor = 4;

        for ($i = 1; $i <= $maxFloor; $i++) {
            for ($j = 1; $j <= $maxRoomPerFloor; $j++) {
                $list[] = [
                    sprintf("0%d0%d", $i, $j),
                    100 + (5 * $i)
                ];
            }
        }

        return $list;
    }
}
