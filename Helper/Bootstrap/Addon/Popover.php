<?php

/*
 * This file is part of the OpenStates Framework (osf) package.
 * (c) Guillaume Ponçon <guillaume.poncon@openstates.com>
 * For the full copyright and license information, please read the LICENSE file distributed with the project.
 */

namespace Osf\View\Helper\Bootstrap\Addon;

use Osf\View\Helper\Bootstrap\Tools\Checkers;
use Osf\View\Component;

/**
 * Popover addon (FR: bulle d'aide avec titre)
 *
 * @author Guillaume Ponçon <guillaume.poncon@openstates.com>
 * @copyright OpenStates
 * @version 1.0
 * @since OSF-2.0 - 2017
 * @package osf
 * @subpackage view
 */
trait Popover
{
    protected $popover;
    protected $popoverOptions = [];
    
    /**
     * FR: Bulle d'aide avec titre
     * @param string $title
     * @param string $txt
     * @param string $placement top, bottom, left, right
     * @param bool $html pour mettre du HTML plutôt que du texte
     * @param string $container 'body' ou nom de balise ou rattacher l'infobulle
     * @param int $delay délai de l'animation (ms) 
     * @return $this
     */
    public function setPopover(string $title, string $txt, $placement = null, $html = null, $container = null, $delay = null)
    {
        $this->popover = ['title' => $title, 'data-content' => $txt];
        $this->popoverOptions['title'] = $title;
        $placement !== null && Checkers::checkPlacement($placement);
        $placement !== null && $this->popoverOptions['data-placement'] = $placement;
        $html      !== null && $this->popoverOptions['data-html'] = (int) (bool) $html;
        $container !== null && $this->popoverOptions['data-container'] = (string) $container;
        $delay     !== null && $this->popoverOptions['data-delay'] = (int) $delay;
        return $this;
    }
    
    /**
     * FR: Renvoit les attributs et active les popovers au niveau jquery
     * @return array
     */
    public function getPopoverAttributes():array
    {
        if ($this->popover !== null) {
            Component::getJquery()->enablePopovers();
            $attrs = $this->popoverOptions;
            $attrs['data-toggle'] = 'popover';
            $attrs['title'] = $this->popover['title'];
            $attrs['data-content'] = $this->popover['data-content'];
            return $attrs;
        }
        return [];
    }
    
    protected function initPopover(array $vars)
    {
        $this->popover = null;
    }
}
