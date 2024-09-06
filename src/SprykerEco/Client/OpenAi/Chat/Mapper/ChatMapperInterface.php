<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\OpenAi\Chat\Mapper;

use Generated\Shared\Transfer\OpenAiChatRequestTransfer;
use Generated\Shared\Transfer\OpenAiChatResponseTransfer;

interface ChatMapperInterface
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
}
