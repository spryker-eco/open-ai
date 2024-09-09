<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Client\OpenAi;

use Spryker\Client\Kernel\AbstractFactory;
use SprykerEco\Client\OpenAi\Dependency\External\OpenAiToOpenAiPhpClientInterface;
use SprykerEco\Client\OpenAi\Mapper\OpenAiMapper;
use SprykerEco\Client\OpenAi\Mapper\OpenAiMapperInterface;
use SprykerEco\Client\OpenAi\Processor\OpenAiProcessor;
use SprykerEco\Client\OpenAi\Processor\OpenAiProcessorInterface;

/**
 * @method \SprykerEco\Client\OpenAi\OpenAiConfig getConfig()
 */
class OpenAiFactory extends AbstractFactory
{
    /**
     * @return \SprykerEco\Client\OpenAi\Processor\OpenAiProcessorInterface
     */
    public function createOpenAiProcessor(): OpenAiProcessorInterface
    {
        return new OpenAiProcessor(
            $this->getConfig(),
            $this->createOpenAiMapper(),
            $this->getOpenAiPhpClient(),
        );
    }

    /**
     * @return \SprykerEco\Client\OpenAi\Mapper\OpenAiMapperInterface
     */
    public function createOpenAiMapper(): OpenAiMapperInterface
    {
        return new OpenAiMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Client\OpenAi\Dependency\External\OpenAiToOpenAiPhpClientInterface
     */
    public function getOpenAiPhpClient(): OpenAiToOpenAiPhpClientInterface
    {
        return $this->getProvidedDependency(OpenAiDependencyProvider::CLIENT_OPEN_AI_PHP);
    }
}
