<?php

/**
 * This file is part of the "cashbox/foundation" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2023 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/cashbox-laravel/foundation
 */

declare(strict_types=1);

namespace CashierProvider\Core\Data\Config;

use CashierProvider\Core\Data\Casts\NumberCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class RefundData extends Data
{
    public bool $enabled;

    #[WithCast(NumberCast::class, min: 0, max: 600)]
    public int $delay;
}
