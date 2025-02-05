<?php

namespace Ensi\LaravelElasticQuery\Filtering\Criterias;

use Ensi\LaravelElasticQuery\Contracts\Criteria;
use Illuminate\Contracts\Support\Arrayable;
use Webmozart\Assert\Assert;

class GeoDistance implements Criteria
{
    private array $values;
    private string $distance;

    public function __construct(private string $field, string $distance, array|Arrayable $values)
    {
        Assert::stringNotEmpty(trim($field));
        Assert::stringNotEmpty(trim($distance));

        $this->values = $values instanceof Arrayable ? $values->toArray() : $values;
        $this->distance = $distance;
    }

    public function toDSL(): array
    {
        return ['geo_distance' => [$this->field => $this->values, 'distance' => $this->distance]];
    }
}
