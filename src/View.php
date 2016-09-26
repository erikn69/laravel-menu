<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Support\Traits\Macroable;
use Spatie\HtmlElement\Attributes;
use Spatie\Menu\Activatable;
use Spatie\Menu\HasParentAttributes;
use Spatie\Menu\Item;
use Spatie\Menu\Traits\Activatable as ActivatableTrait;
use Spatie\Menu\Traits\HasParentAttributes as HasParentAttributesTrait;

class View implements Item, Activatable, HasParentAttributes
{
    use ActivatableTrait, Macroable, HasParentAttributesTrait;

    /** @var string */
    protected $name;

    /** @var array */
    protected $data;

    /** @var bool */
    protected $active = false;

    public function __construct(string $name, array $data = [])
    {
        $this->name = $name;
        $this->data = $data;
        $this->parentAttributes = new Attributes();
    }

    /**
     * @param string $name
     * @param array $data
     *
     * @return static
     */
    public static function create(string $name, array $data = [])
    {
        return new static($name, $data);
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return view($this->name)
            ->with($this->data + ['active' => $this->isActive()])
            ->render();
    }
}