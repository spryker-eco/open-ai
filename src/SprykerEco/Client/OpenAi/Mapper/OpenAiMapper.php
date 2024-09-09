<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Client\OpenAi\Mapper;

use Generated\Shared\Transfer\OpenAiChatRequestTransfer;
use Generated\Shared\Transfer\OpenAiChatResponseTransfer;
use SprykerEco\Client\OpenAi\OpenAiConfig;

class OpenAiMapper implements OpenAiMapperInterface
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
     * @var string
     */
    protected const OPENAI_RESPONSE_KEY_CHOICES = 'choices';

    /**
     * @var string
     */
    protected const OPENAI_RESPONSE_KEY_MESSAGE = 'message';

    /**
     * @var string
     */
    protected const OPENAI_RESPONSE_KEY_CONTENT = 'content';

    /**
     * @var \SprykerEco\Client\OpenAi\OpenAiConfig
     */
    protected OpenAiConfig $openAiConfig;

    /**
     * @param \SprykerEco\Client\OpenAi\OpenAiConfig $openAiConfig
     */
    public function __construct(OpenAiConfig $openAiConfig)
    {
        $this->openAiConfig = $openAiConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\OpenAiChatRequestTransfer $openAiChatRequestTransfer
     *
     * @return array<string, mixed>
     */
    public function mapRequestToPromptParameters(OpenAiChatRequestTransfer $openAiChatRequestTransfer): array
    {
        return [
            static::OPENAI_MESSAGE_MODEL_KEY => $openAiChatRequestTransfer->getModel() ?? $this->openAiConfig->getDefaultOpenAiEngine(),
            static::OPENAI_MESSAGE_MESSAGES_KEY => [
                [
                    static::OPENAI_MESSAGE_ROLE_KEY => $openAiChatRequestTransfer->getUser() ?? static::OPENAI_MESSAGE_ROLE_USER_VALUE,
                    static::OPENAI_MESSAGE_CONTENT_KEY => $openAiChatRequestTransfer->getMessage() ?? $openAiChatRequestTransfer->getPromptData(),
                ],
            ],
        ];
    }

    /**
     * @param array<string, mixed> $responseData
     *
     * @return \Generated\Shared\Transfer\OpenAiChatResponseTransfer
     */
    public function mapResponseDataToResponseTransfer(array $responseData): OpenAiChatResponseTransfer
    {
        $responseTransfer = new OpenAiChatResponseTransfer();
        if (!isset($responseData[static::OPENAI_RESPONSE_KEY_CHOICES][0])) {
            return $responseTransfer;
        }

        $messageContent = $responseData[static::OPENAI_RESPONSE_KEY_CHOICES][0][static::OPENAI_RESPONSE_KEY_MESSAGE][static::OPENAI_RESPONSE_KEY_CONTENT] ?? null;

        return $responseTransfer->setMessage($messageContent);
    }
}
