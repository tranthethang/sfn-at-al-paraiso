<?php

namespace App\Contract\Entity;

interface IReservation
{
    const GUEST = "guest";
    const START_DATE = "startDate";
    const END_DATE = "endDate";
    const DISCOUNT_PERCENT = "discountPercent";
    const TOTAL_PRICE = "totalPrice";
}