<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\OpenAi\Chat;

use Generated\Shared\Transfer\OpenAiChatResponseTransfer;
use OpenAI\Client;
use OpenAI\Responses\Chat\CreateResponse;
use SprykerEco\Client\OpenAi\OpenAiConfig;

class OpenAiChat implements OpenAiChatInterface
{
    /**
     * @var string
     */
    protected const OPENAI_MESSAGE_ROLE_KEY = 'role';

    /**
     * @var string
     */
    protected const OPENAI_MESSAGE_MODEL_KEY = 'model';

    /**
     * @var string
     */
    protected const OPENAI_MESSAGE_MESSAGES_KEY = 'messages';

    /**
     * @var string
     */
    protected const OPENAI_MESSAGE_CONTENT_KEY = 'content';

    /**
     * @var string
     */
    protected const OPENAI_MESSAGE_ROLE_USER_VALUE = 'user';

    /**
     * @var \OpenAI\Client
     */
    protected Client $openAiClient;

    /**
     * @var \SprykerEco\Client\OpenAi\OpenAiConfig
     */
    protected OpenAiConfig $config;

    /**
     * @param \OpenAI\Client $openAiClient
     * @param \SprykerEco\Client\OpenAi\OpenAiConfig $config
     */
    public function __construct(Client $openAiClient, OpenAiConfig $config)
    {
        $this->openAiClient = $openAiClient;
        $this->config = $config;
    }

    /**
     * @param string $message
     *
     * @return \Generated\Shared\Transfer\OpenAiChatResponseTransfer
     */
    public function chat(string $message): OpenAiChatResponseTransfer
    {
        $createResponse = $this->openAiClient->chat()->create(
            $this->buildPromptRequest($message),
        );

        return $this->buildOpenAiChatResponse($createResponse);
    }

    /**
     * @param string $message
     *
     * @return array<string, mixed>
     */
    protected function buildPromptRequest(string $message): array
    {
        return [
            static::OPENAI_MESSAGE_MODEL_KEY => $this->config->getOpenAiEngine(),
            static::OPENAI_MESSAGE_MESSAGES_KEY => [
                [
                    static::OPENAI_MESSAGE_ROLE_KEY => static::OPENAI_MESSAGE_ROLE_USER_VALUE,
                    static::OPENAI_MESSAGE_CONTENT_KEY => $message,
                ],
            ],
        ];
    }

    /**
     * @param \OpenAI\Responses\Chat\CreateResponse $createResponse
     *
     * @return \Generated\Shared\Transfer\OpenAiChatResponseTransfer
     */
    protected function buildOpenAiChatResponse(CreateResponse $createResponse): OpenAiChatResponseTransfer
    {
        $responseTransfer = new OpenAiChatResponseTransfer();
        if (!$createResponse->choices) {
            return $responseTransfer;
        }

        return $responseTransfer->setMessage(
            $createResponse->choices[0]->message->content,
        );
    }
}
