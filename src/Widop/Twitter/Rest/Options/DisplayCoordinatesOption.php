<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Options;

/**
 * Display coordinates option.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DisplayCoordinatesOption extends AbstractBooleanOption
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'display_coordinates';
    }
}
