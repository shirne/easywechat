<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\Kernel\Support;

use ArrayAccess;
use ArrayIterator;
use EasyWeChat\Kernel\Contracts\Arrayable;
use IteratorAggregate;

/**
 * Class ArrayAccessible.
 *
 * @author overtrue <i@overtrue.me>
 */
class ArrayAccessible implements ArrayAccess, IteratorAggregate, Arrayable
{
    private $array;

    public function __construct(array $array = [])
    {
        $this->array = $array;
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->array);
    }

    public function offsetGet($offset): mixed
    {
        return $this->array[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if (null === $offset) {
            $this->array[] = $value;
        } else {
            $this->array[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->array[$offset]);
    }

    public function getIterator(): \Traversable
    {
        return new ArrayIterator($this->array);
    }

    public function toArray()
    {
        return $this->array;
    }
}
