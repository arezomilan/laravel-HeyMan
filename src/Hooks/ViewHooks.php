<?php

namespace Imanghafoori\HeyMan\Hooks;

trait ViewHooks
{
    public function whenYouSeeViewFile(...$view)
    {
        $view = $this->normalizeView($view);
        return $this->authorize($view);
    }

    public function whenViewMake(...$args)
    {
        return $this->whenYouSeeViewFile(...$args);
    }

    /**
     * @param $views
     * @return array
     */
    private function normalizeView(array $views): array
    {
        $views = $this->normalizeInput($views);
        $mapper = function ($view) {
            return 'creating: '.$view;
        };

        return array_map($mapper, $views);
    }
}