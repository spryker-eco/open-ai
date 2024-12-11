<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\OpenAi\Dependency\External;

use OpenAI;
use OpenAI\Client;

class OpenAiToOpenAiPhpClientAdapter implements OpenAiToOpenAiPhpClientInterface
{
    /**
     * @param string $apiKey
     * @param string|null $organization
     *
     * @return \OpenAI\Client
     */
    public function createOpenAiClient(string $apiKey, ?string $organization = null): Client
    {
        return OpenAi::client($apiKey, $organization);
    }
}
