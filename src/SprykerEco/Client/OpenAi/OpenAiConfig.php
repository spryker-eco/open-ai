<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Client\OpenAi;

use Spryker\Client\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\OpenAi\OpenAiConstants;

class OpenAiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    protected const DEFAULT_OPENAI_ENGINE = 'gpt-3.5-turbo';

    /**
     * @api
     *
     * @return string
     */
    public function getDefaultOpenAiEngine(): string
    {
        return static::DEFAULT_OPENAI_ENGINE;
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
