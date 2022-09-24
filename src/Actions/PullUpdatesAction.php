<?php
namespace Tj\Ghwebhook\Actions;

use Symfony\Component\Process\Process;
use Tj\Ghwebhook\Contracts\ActionExecutes;
use Tj\Ghwebhook\Contracts\ActionHandlerInterface;
use Tj\Ghwebhook\Contracts\ActionLog;
use Tj\Ghwebhook\LogType;

class PullUpdatesAction extends ActionExecutes implements ActionHandlerInterface
{
    protected bool $alreadyUpToDate = false;

    public function handle(): mixed
    {
        if (!$this->pullUpdates()) {
            return false;
        }
        if ($this->alreadyUpToDate) {
            new ActionLog(LogType::INFO, "Already up to date.");
        }
        return true;
    }

    protected function pullUpdates()
    {
        $base = base_path();
        $pull = new Process(['git', 'pull'],$base);
        $pull->run(function ($type, $buffer) {
            $this->actionLogs[] = $buffer;
            if($buffer == "Already up to date.\n") {
                $this->alreadyUpToDate = true;
            }
        });
        return $pull->isSuccessful();
    }
}
