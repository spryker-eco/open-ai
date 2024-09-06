<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\OpenAi;

use OpenAI;
use OpenAI\Client;
use Spryker\Client\Kernel\AbstractFactory;
use SprykerEco\Client\OpenAi\Chat\Mapper\ChatMapper;
use SprykerEco\Client\OpenAi\Chat\Mapper\ChatMapperInterface;
use SprykerEco\Client\OpenAi\Chat\OpenAiChat;
use SprykerEco\Client\OpenAi\Chat\OpenAiChatInterface;

/**
 * @method \SprykerEco\Client\OpenAi\OpenAiConfig getConfig()
 */
class OpenAiFactory extends AbstractFactory
{
    /**
     * @return \SprykerEco\Client\OpenAi\Chat\OpenAiChatInterface
     */
    public function createOpenAiChat(): OpenAiChatInterface
    {
        return new OpenAiChat($this->createOpenAiClient(), $this->createChatMapper());
    }

    /**
     * @return \SprykerEco\Client\OpenAi\Chat\Mapper\ChatMapperInterface
     */
    public function createChatMapper(): ChatMapperInterface
    {
        return new ChatMapper($this->getConfig());
    }

    /**
     * @return \OpenAI\Client
     */
    public function createOpenAiClient(): Client
    {
        return OpenAi::client(
            $this->getConfig()->getOpenAiApiToken(),
        );
    }
}
