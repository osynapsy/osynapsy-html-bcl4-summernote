<?php

/*
 * This file is part of the Osynapsy package.
 *
 * (c) Pietro Celeste <p.celeste@osynapsy.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Osynapsy\Bcl4\Summernote;

use Osynapsy\Bcl4\TextArea;

class Summernote extends TextArea
{
    public function __construct($name)
    {
        parent::__construct($name);
        $this->att('class','summernote');
        self::appendRequiredFileToPage($this);
    }

    public function setHeight(int $heightInPixel)
    {
        $this->att('data-height', $heightInPixel);
    }

    public static function appendRequiredFileToPage($object)
    {
        self::requireFile($object, 'assets/Lib/summernote-0.8.18/summernote-bs4.css', 'css');
        self::requireFile($object, 'assets/Lib/summernote-0.8.18/summernote-bs4.js', 'js');
        self::requireFile($object, 'assets/Lib/katex-0.9.0/style.min.css', 'css');
        self::requireFile($object, 'assets/Lib/katex-0.9.0/script.min.js', 'js');
        self::requireFile($object, 'assets/Lib/summernote-0.8.18/plugin/math/script.js', 'js');
        self::requireFile($object, 'assets/Bcl4/Summernote/script.js', 'js');
    }

    public function showFontButtons($superscript = false, $subscript = false, $strikethrough = false)
    {
        $buttons = [];
        if ($strikethrough === true) {
            $buttons[] = 'font-strikethrough';
        }
        if ($superscript === true) {
            $buttons[] = 'font-superscript';
        }
        if ($subscript === true) {
            $buttons[] = 'font-subscript';
        }
        $this->addButtonsToToolbar($buttons);
    }

    public function addButtonsToToolbar(array $newbuttons)
    {
        if (empty($newbuttons)) {
            return;
        }
        $oldbuttons = $this->getAttribute('data-toolbar-buttons') ? explode(',',  $this->getAttribute('data-toolbar-buttons')) : [];
        $buttons = array_merge($oldbuttons, $newbuttons);
        $this->att('data-toolbar-buttons', implode(',', $buttons));
    }
}
