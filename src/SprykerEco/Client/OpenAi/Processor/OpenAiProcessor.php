<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Client\OpenAi\Processor;

use Exception;
use Generated\Shared\Transfer\OpenAiChatRequestTransfer;
use Generated\Shared\Transfer\OpenAiChatResponseTransfer;
use SprykerEco\Client\OpenAi\Dependency\External\OpenAiToOpenAiPhpClientInterface;
use SprykerEco\Client\OpenAi\Mapper\OpenAiMapperInterface;
use SprykerEco\Client\OpenAi\OpenAiConfig;

class OpenAiProcessor implements OpenAiProcessorInterface
{
    /**
     * @var \SprykerEco\Client\OpenAi\OpenAiConfig
     */
    protected OpenAiConfig $openAiConfig;

    /**
     * @var \SprykerEco\Client\OpenAi\Mapper\OpenAiMapperInterface
     */
    protected OpenAiMapperInterface $openAiMapper;

    /**
     * @var \SprykerEco\Client\OpenAi\Dependency\External\OpenAiToOpenAiPhpClientInterface
     */
    protected OpenAiToOpenAiPhpClientInterface $openAiPhpClient;

    /**
     * @param \SprykerEco\Client\OpenAi\OpenAiConfig $openAiConfig
     * @param \SprykerEco\Client\OpenAi\Mapper\OpenAiMapperInterface $openAiMapper
     * @param \SprykerEco\Client\OpenAi\Dependency\External\OpenAiToOpenAiPhpClientInterface $openAiPhpClient
     */
    public function __construct(
        OpenAiConfig $openAiConfig,
        OpenAiMapperInterface $openAiMapper,
        OpenAiToOpenAiPhpClientInterface $openAiPhpClient
    ) {
        $this->openAiConfig = $openAiConfig;
        $this->openAiMapper = $openAiMapper;
        $this->openAiPhpClient = $openAiPhpClient;
    }

    /**
     * @param \Generated\Shared\Transfer\OpenAiChatRequestTransfer $openAiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OpenAiChatResponseTransfer
     */
    public function chat(OpenAiChatRequestTransfer $openAiRequestTransfer): OpenAiChatResponseTransfer
    {
        try {
            $responseData = $this->openAiPhpClient
                ->createOpenAiClient($this->openAiConfig->getOpenAiApiToken())
                ->chat()
                ->create($this->openAiMapper->mapRequestToPromptParameters($openAiRequestTransfer))
                ->toArray();
        } catch (Exception $errorException) {
            return $this->openAiMapper->mapErrorToResponseTransfer($errorException->getMessage());
        }

        return $this->openAiMapper->mapResponseDataToResponseTransfer($responseData);
    }
}
