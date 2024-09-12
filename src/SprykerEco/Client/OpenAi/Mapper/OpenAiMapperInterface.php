<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Client\OpenAi\Mapper;

use Generated\Shared\Transfer\OpenAiChatRequestTransfer;
use Generated\Shared\Transfer\OpenAiChatResponseTransfer;

interface OpenAiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\OpenAiChatRequestTransfer $openAiChatRequestTransfer
     *
     * @return array<string, mixed>
     */
    public function mapRequestToPromptParameters(OpenAiChatRequestTransfer $openAiChatRequestTransfer): array;

    /**
     * @param array<string, mixed> $responseData
     *
     * @return \Generated\Shared\Transfer\OpenAiChatResponseTransfer
     */
    public function mapResponseDataToResponseTransfer(array $responseData): OpenAiChatResponseTransfer;

    /**
     * @param string $errorMessage
     *
     * @return \Generated\Shared\Transfer\OpenAiChatResponseTransfer
     */
    public function mapErrorToResponseTransfer(string $errorMessage): OpenAiChatResponseTransfer;
}
