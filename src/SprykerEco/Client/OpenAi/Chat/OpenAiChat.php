<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\OpenAi\Chat;

use Generated\Shared\Transfer\OpenAiChatRequestTransfer;
use Generated\Shared\Transfer\OpenAiChatResponseTransfer;
use OpenAI\Client;
use SprykerEco\Client\OpenAi\Chat\Mapper\ChatMapperInterface;

class OpenAiChat implements OpenAiChatInterface
{
    /**
     * @var \OpenAI\Client
     */
    protected Client $openAiClient;

    /**
     * @var \SprykerEco\Client\OpenAi\Chat\Mapper\ChatMapperInterface
     */
    protected ChatMapperInterface $chatMapper;

    /**
     * @param \OpenAI\Client $openAiClient
     * @param \SprykerEco\Client\OpenAi\Chat\Mapper\ChatMapperInterface $chatMapper
     */
    public function __construct(Client $openAiClient, ChatMapperInterface $chatMapper)
    {
        $this->openAiClient = $openAiClient;
        $this->chatMapper = $chatMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\OpenAiChatRequestTransfer $openAiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OpenAiChatResponseTransfer
     */
    public function chat(OpenAiChatRequestTransfer $openAiRequestTransfer): OpenAiChatResponseTransfer
    {
        $promptRequest = $this->chatMapper->mapRequestToPromptParameters($openAiRequestTransfer);
        $createResponse = $this->openAiClient->chat()->create($promptRequest);

        return $this->chatMapper->mapResponseDataToResponseTransfer($createResponse->toArray());
    }
}
