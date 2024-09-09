<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Client\OpenAi\Processor;

use Generated\Shared\Transfer\OpenAiChatRequestTransfer;
use Generated\Shared\Transfer\OpenAiChatResponseTransfer;

interface OpenAiProcessorInterface
{
    /**
     * @param \Generated\Shared\Transfer\OpenAiChatRequestTransfer $openAiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OpenAiChatResponseTransfer
     */
    public function chat(OpenAiChatRequestTransfer $openAiRequestTransfer): OpenAiChatResponseTransfer;
}
