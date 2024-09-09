<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Client\OpenAi\Dependency\External;

use OpenAI\Client;

interface OpenAiToOpenAiPhpClientInterface
{
    /**
     * @param string $apiKey
     * @param string|null $organization
     *
     * @return \OpenAI\Client
     */
    public function createOpenAiClient(string $apiKey, ?string $organization = null): Client;
}
