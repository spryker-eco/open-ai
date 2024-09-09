<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Client\OpenAi;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use SprykerEco\Client\OpenAi\Dependency\External\OpenAiToOpenAiPhpClientAdapter;

class OpenAiDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_OPEN_AI_PHP = 'CLIENT_OPEN_AI_PHP';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);
        $container = $this->addOpenAiPhpClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addOpenAiPhpClient(Container $container): Container
    {
        $container->set(static::CLIENT_OPEN_AI_PHP, function () {
            return new OpenAiToOpenAiPhpClientAdapter();
        });

        return $container;
    }
}
