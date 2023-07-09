<?php

/**
 * This file is part of the "cashier-provider/core" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2023 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/cashier-provider
 */

declare(strict_types=1);

namespace CashierProvider\Core\Exceptions;

use Exception;

class BaseException extends Exception
{
    protected int $statusCode = 500;

    protected string $reason;

    public function __construct(object|string $haystack, ?string $needle = null)
    {
        parent::__construct($this->reason($haystack, $needle), $this->statusCode);
    }

    protected function reason(string $haystack, string $needle): string
    {
        return sprintf($this->reason, $this->haystack($haystack), $needle);
    }

    protected function haystack(object|string $haystack): string
    {
        return is_object($haystack) ? get_class($haystack) : $haystack;
    }
}
