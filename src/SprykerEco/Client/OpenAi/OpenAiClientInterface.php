<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\OpenAi;

use Generated\Shared\Transfer\OpenAiChatRequestTransfer;
use Generated\Shared\Transfer\OpenAiChatResponseTransfer;

/**
 * @api
 *
 * @method \SprykerEco\Client\OpenAi\OpenAiFactory getFactory()
 */
interface OpenAiClientInterface
{
    /**
     * Specification:
     * - Sends a message to ChatGPT engine.
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
