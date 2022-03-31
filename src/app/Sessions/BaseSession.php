<?php
namespace App\Sessions;

/**
 * TemplateSample
 */
class BaseSession
{
    protected $name;

    public function put(?array $data = null, ?string $child = null)
    {
        return session()->put($this->setName($child), $data);
    }

    public function get(?string $child = null)
    {
        return session($this->setName($child), null);
    }

    public function forget(?string $child = null)
    {
        return session()->forget($this->setName($child));
    }

    public function has(?string $child = null)
    {
        return session()->has($this->setName($child));
    }

    public function exists(?string $child = null)
    {
        return session()->exists($this->setName($child));
    }

    protected function setName(?string $child = null)
    {
        return is_null($child)? $this->name : "{$this->name}.{$child}";
    }

}
