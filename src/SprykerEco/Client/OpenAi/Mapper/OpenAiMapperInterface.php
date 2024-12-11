<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
