<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Shared\OpenAi;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface OpenAiConstants
{
    /**
     * Specification:
     * - Specifies the OpenAI API token.
     *
     * @api
     *
     * @var string
     */
    public const API_TOKEN = 'OPEN_AI:API_TOKEN';
}
