<?php

namespace Modules;

class Cache
{
	public function __construct(private readonly string $key)
	{
	}

	public function value()
	{
		return $this->key;
	}
}
