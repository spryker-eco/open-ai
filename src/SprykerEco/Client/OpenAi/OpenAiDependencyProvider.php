<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\OpenAi;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use SprykerEco\Client\OpenAi\Dependency\External\OpenAiToOpenAiPhpClientAdapter;

/**
 * @method \SprykerEco\Client\OpenAi\OpenAiConfig getConfig()
 */
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
