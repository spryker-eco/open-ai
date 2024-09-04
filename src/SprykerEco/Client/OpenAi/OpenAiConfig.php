<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\OpenAi;

use Spryker\Client\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\OpenAi\OpenAiConstants;

class OpenAiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    protected const OPENAI_ENGINE = 'gpt-3.5-turbo';

    /**
     * @api
     *
     * @return string
     */
    public function getOpenAiEngine(): string
    {
        return static::OPENAI_ENGINE;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getOpenAiApiToken(): string
    {
        return $this->get(OpenAiConstants::API_TOKEN);
    }
}
