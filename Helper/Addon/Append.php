<?php

/*
 * This file is part of the OpenStates Framework (osf) package.
 * (c) Guillaume Ponçon <guillaume.poncon@openstates.com>
 * For the full copyright and license information, please read the LICENSE file distributed with the project.
 */

namespace Osf\View\Helper\Addon;

use Osf\Stream\Text as T;

/**
 * FR: Contenu à mettre après l'élément. S'il y a un conteneur, on reste dedans.
 *
 * @author Guillaume Ponçon <guillaume.poncon@openstates.com>
 * @copyright OpenStates
 * @version 1.0
 * @since OSF-2.0 - 2017
 * @package osf
 * @subpackage view
 */
trait Append
{
    protected $appendContent;
    
    /**
     * @param string|null $content
     * @return $this
     */
    public function setAppend($content)
    {
        $this->appendContent = T::strOrNull($content);
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getAppend()
    {
        return $this->appendContent;
    }
    
    /**
     * @return string|null
     */
    public function hasAppend()
    {
        return $this->appendContent !== null;
    }
    
    protected function initAppend(array $vars)
    {
        $this->appendContent = array_key_exists('appendContent', $vars) ? $vars['appendContent'] : null;
    }
}
