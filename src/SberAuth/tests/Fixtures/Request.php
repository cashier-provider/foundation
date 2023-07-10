<?php

/**
 * This file is part of the "cashier-provider/foundation" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2023 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/cashier-provider/foundation
 */

declare(strict_types=1);

namespace Tests\Fixtures;

use CashierProvider\Core\Http\Request as BaseRequest;

class Request extends BaseRequest
{
    /** @var string */
    protected $production_host = 'https://api.sberbank.ru';

    /** @var string */
    protected $dev_host = 'https://dev.api.sberbank.ru';

    public function getRawHeaders(): array
    {
        return ['Accept' => 'application/json'];
    }

    public function getRawBody(): array
    {
        return [
            'PaymentId' => $this->model->getPaymentId(),
            'Sum'       => $this->model->getSum(),
            'Currency'  => $this->model->getCurrency(),
            'CreatedAt' => $this->model->getCreatedAt(),
        ];
    }
}
