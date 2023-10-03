<?php

namespace Support\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait CamelCasing
{
    public bool $enforceCamelCase = true;

    public function __isset($key): bool
    {
        return parent::__isset($key) || parent::__isset($this->getSnakeKey($key));
    }

    public function __unset($key): void
    {
        parent::__unset($this->getSnakeKey($key));
    }

    protected function isGuardableColumn($key): bool
    {
        return parent::isGuardableColumn($this->getSnakeKey($key));
    }

    public function setAttribute($key, $value): void
    {
        parent::setAttribute($this->getSnakeKey($key), $value);
    }

    public function getAttribute($key): mixed
    {
        if (method_exists($this, $key)) {
            return $this->getRelationValue($key);
        }

    return parent::getAttribute($this->getSnakeKey($key));
    }

    public function attributesToArray(): array
    {
        return $this->toCamelCase(parent::attributesToArray());
    }

    public function relationsToArray(): array
    {
        return $this->toCamelCase(parent::relationsToArray());
    }

    public function getHidden(): array
    {
        return array_map(Str::class.'::snake', $this->hidden);
    }

    public function getDates(): array
    {
        $dates = parent::getDates();
        return array_map(Str::class.'::snake', $dates);
    }

    public function toCamelCase($attributes): array
    {
        $convertedAttributes = [];

        foreach ($attributes as $key => $value) {
            $key = $this->getTrueKey($key);
            $convertedAttributes[$key] = $value;
        }

    return $convertedAttributes;
    }

    public function toSnakeCase($attributes): array
    {
        $convertedAttributes = [];

        foreach ($attributes as $key => $value) {
            $convertedAttributes[$this->getSnakeKey($key)] = $value;
        }

    return $convertedAttributes;
    }

    public function getTrueKey($key): string
    {
        // If the key is a pivot key, leave it alone - this is required internal behaviour
    // of Eloquent for dealing with many:many relationships.
    if ($this->isCamelCase() && strpos($key, 'pivot_') === false) {
        $key = Str::camel($key);
    }

    return $key;
    }

    public function isCamelCase(): bool
    {
        return $this->enforceCamelCase or (isset($this->parent) && method_exists($this->parent, 'isCamelCase') && $this->parent->isCamelCase());
    }

    protected function getSnakeKey($key): string
    {
        return Str::snake($key);
    }

    public function getCasts(): array
    {
        return $this->toSnakeCase($this->casts);
    }
}
