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
 * @see https://cashbox.city
 */

declare(strict_types=1);

namespace Cashbox\Tinkoff\QrCode\Http\Requests;

use Cashbox\Core\Http\Request;

abstract class BaseRequest extends Request
{
    protected string $productionHost = 'https://securepay.tinkoff.ru';

    protected function clientId(): string
    {
        return $this->resource->config->credentials->clientId;
    }

    protected function clientSecret(): string
    {
        return $this->resource->config->credentials->clientSecret;
    }
}
