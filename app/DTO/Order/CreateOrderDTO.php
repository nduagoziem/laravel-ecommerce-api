<?php

namespace App\DTO\Order;

final class CreateOrderDTO
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $phone_number;
    public string $address;
    public string $country;
    public ?string $apartment_name;
    public string $state;
    public ?int $postal_code;
    public string $city;

    public function __construct(string $first_name, string $last_name, string $email, string $phone_number, string $address, string $country, string $apartment_name, string $state, int $postal_code, string $city)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->address = $address;
        $this->country = $country;
        $this->apartment_name = $apartment_name;
        $this->state = $state;
        $this->postal_code = $postal_code;
        $this->city = $city;
    }
}
