<?php
/**
 * Akeeba Engine
 *
 * @package   akeebaengine
 * @copyright Copyright (c)2006-2023 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Engine\Base\Exceptions;

defined('AKEEBAENGINE') || die();

use RuntimeException;

/**
 * An exception which leads to an error (and complete halt) in the backup process
 */
class ErrorException extends RuntimeException
{

}
