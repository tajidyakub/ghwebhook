<?php
namespace Tj\Ghwebhook\Concerns;

trait InteractsWithArray
{
    public function toArray(): array
    {
        $ref = new \ReflectionClass($this);
        $arr = [];
        $props = $ref->getProperties();

        foreach ($props as $prop) {
            if ($prop->isPublic()) {
                $arr[$prop->name] = $this->{$prop->name};
            }
        }
        return $arr;
    }
}
