<?php

namespace App\View\Composers;

use App\Dictionaries\BridgeConstants;
use Illuminate\View\View;

class BridgeConstantsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        foreach (BridgeConstants::get() as $name => $value) {
            $view->with($name, $value);
        }
    }
}
