<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Client\OpenAi;

use Generated\Shared\Transfer\OpenAiChatRequestTransfer;
use Generated\Shared\Transfer\OpenAiChatResponseTransfer;

interface OpenAiClientInterface
{
    /**
     * Specification:
     * - Sends a message to ChatGPT engine.
     * - Expects `OpenAiChatRequestTransfer` object with either `message` or `promptData` properties set.
     * - Returns `OpenAiChatResponseTransfer` object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OpenAiChatRequestTransfer $openAiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OpenAiChatResponseTransfer
     */
    public function chat(OpenAiChatRequestTransfer $openAiRequestTransfer): OpenAiChatResponseTransfer;
}
