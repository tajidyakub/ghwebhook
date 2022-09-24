<?php

namespace Tj\Ghwebhook\Actions;

use Symfony\Component\Process\Process;
use Tj\Ghwebhook\Contracts\ActionHandler;
use Tj\Ghwebhook\Contracts\ActionHandlerInterface;

class UpdatePackagesAction extends ActionHandler implements ActionHandlerInterface
{
    public function handle(): mixed
    {
        if (! $this->updatePackages()) {
            return false;
        }

        return true;
    }

    protected function updatePackages()
    {
        $update = new Process([], base_path());

        $update->run(function ($type, $buffer) {
            $this->actionLogs[] = $buffer;
        });

        return $update->isSuccessful();
    }
}
