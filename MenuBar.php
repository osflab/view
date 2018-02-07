<?php

/*
 * This file is part of the OpenStates Framework (osf) package.
 * (c) Guillaume Ponçon <guillaume.poncon@openstates.com>
 * For the full copyright and license information, please read the LICENSE file distributed with the project.
 */

namespace Osf\View;

use Osf\Container\OsfContainer as Container;
use Osf\Exception\ArchException;

/**
 * MenuBar management
 *
 * @author Guillaume Ponçon <guillaume.poncon@openstates.com>
 * @copyright OpenStates 2009
 * @version 2.0
 * @since NEA_PHP-1.0
 * @package osf
 * @subpackage view
 */
class MenuBar
{
    const DEFAULT_IMAGE = 'default.png';

    private $title;
    private $items;

    public function __construct($title = null)
    {
        $this->title = (string) $title;
    }

    public function addSeparator($title)
    {
        $this->items[] = array('separator' => $title);
    }

    public function addItem($title, $urlOrAction, $image = null, $description = null)
    {
        if (is_array($urlOrAction)) {
            if (!array_key_exists('action', $urlOrAction)) {
                throw new ArchException('Key action must exists for item control');
            }
            if (array_key_exists('controller', $urlOrAction)) {
                $controller = (string) $urlOrAction['controller'];
            } else {
                $controller = Container::getRequest()->getController();
            }
            $url = Container::getRouter()->buildUri(array(), $controller, $urlOrAction['action']);
        } elseif (preg_match('/^[a-zA-Z_-]{2,25}$/', $urlOrAction)) {
            $controller = Container::getRequest()->getController();
            $url = Container::getRouter()->buildUri(array(), $controller, $urlOrAction);
        } else {
            $url = $urlOrAction;
        }
        $item = array();
        $item['name'] = (string) $title;
        $item['url'] = (string) $url;
        $item['image'] = $image ? (string) $image : 'unknown.png';
        if ($description) {
            $item['description'] = (string) $description;
        }
        $this->items[] = $item;
    }

    public function getItems()
    {
        return $this->items;
    }
}
