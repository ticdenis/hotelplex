<?php

declare(strict_types=1);

namespace HotelPlex\Domain\ValueObject;

class AmountValueObject extends ArrayValueObject
{
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_USD = 'USD';

    /**
     * @param string $currency
     * @param float $price
     */
    public function __construct(string $currency, float $price)
    {
        parent::__construct([
            'currency' => $currency,
            'price' => $price
        ]);
    }

    /**
     * @param float $price
     * @return self
     */
    public static function ofEUR(float $price): self
    {
        $class = get_called_class();
        return new $class(self::CURRENCY_EUR, $price);
    }

    /**
     * @param float $price
     * @return AmountValueObject
     */
    public static function ofUSD(float $price): self
    {
        $class = get_called_class();
        return new $class(self::CURRENCY_USD, $price);
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->value['currency'];
    }

    /**
     * @return float
     */
    public function price(): float
    {
        return $this->value['price'];
    }

    /**
     * @param AmountValueObject $other
     * @return bool
     */
    public function equalsTo(ValueObject $other): bool
    {
        return $this->currency() === $other->currency() && $this->price() === $other->price();
    }
}
