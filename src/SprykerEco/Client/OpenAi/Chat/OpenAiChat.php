<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\OpenAi\Chat;

use Generated\Shared\Transfer\OpenAiChatRequestTransfer;
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
     * @param \Generated\Shared\Transfer\OpenAiChatRequestTransfer $openAiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OpenAiChatResponseTransfer
     */
    public function chat(OpenAiChatRequestTransfer $openAiRequestTransfer): OpenAiChatResponseTransfer
    {
        $createResponse = $this->openAiClient->chat()->create(
            $this->buildPromptRequest($openAiRequestTransfer),
        );

        return $this->buildOpenAiChatResponse($createResponse);
    }

    /**
     * @param \Generated\Shared\Transfer\OpenAiChatRequestTransfer $openAiRequestTransfer
     *
     * @return array<string, mixed>
     */
    protected function buildPromptRequest(OpenAiChatRequestTransfer $openAiRequestTransfer): array
    {
        $model = $openAiRequestTransfer->getModel() ?? $this->config->getDefaultOpenAiEngine();
        $user = $openAiRequestTransfer->getUser() ?? static::OPENAI_MESSAGE_ROLE_USER_VALUE;
        $content = $openAiRequestTransfer->getMessage() ?? $openAiRequestTransfer->getPromptData();

        return [
            static::OPENAI_MESSAGE_MODEL_KEY => $model,
            static::OPENAI_MESSAGE_MESSAGES_KEY => [
                [
                    static::OPENAI_MESSAGE_ROLE_KEY => $user,
                    static::OPENAI_MESSAGE_CONTENT_KEY => $content,
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
