<?php
namespace App\Service;

class UserService
{
    public $user_id = 3;

    public function getInfoById (int $id)
    {
        $faker = \Faker\Factory::create();
        $faker = new \Faker\Generator();
        $faker->addProvider(new \Faker\Provider\zh_CN\Person($faker));
        $faker->addProvider(new \Faker\Provider\zh_CN\Address($faker));
        return [
            'name' => $faker->name,
            'address' => $faker->address,
            'id'   => $id,
        ];
    }

}